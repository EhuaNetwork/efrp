<?php


namespace app\admin\controller;

use think\Db;
use think\Exception;
use think\exception\ErrorException;
use think\exception\TemplateNotFoundException;

class Index extends Baseadmin
{
    public function index()
    {
        return view();
    }

    public function run()
    {
        return view();
    }

    public function Pcheck()
    {
        $server_ip=get_system('server_ip');
        $server_port=get_system('server_port');

        //路径信息
        $ROOT = ROOT_PATH . 'public';
        $path = ROOT_PATH . 'application' . DS . 'data' . DS . 'core' . DS . 'frpc';
        $path2 = str_replace("\\", "\\\\", $path);
        $ROOT2 = str_replace("\\", "\\\\", $ROOT);

        //映射列表
       $list= \db('article')->select();




        //生成frp配置信息
        $frpTest = <<<eof
[common]
server_addr = $server_ip
server_port = $server_port

eof;
        foreach ($list as $dat){
            $name=md5($dat['id']);
            $local_ip=$dat['ip'];
            $local_port=$dat['port'];
            $remote_port=$dat['remote_port'];

            $str= <<<eof

[$name]
type = tcp
local_ip = $local_ip
local_port = $local_port
remote_port =  $remote_port

eof;

            $frpTest.=$str;
        }




        //生成 启动bat
        $cmdTest = <<<eof
        @echo off
set retime=60
:start
$path\\frpc.exe -c  $ROOT\\frpc\\frpc.ini
echo Error
echo --------------------------------------------
echo 连节点或登入失败-即将在%retime%秒后重新连
echo --------------------------------------------
    timeout /t %retime% 
goto start
eof;

        //生成 注册表配置协议
        $regTest = <<<eof
Windows Registry Editor Version 5.00

#协议名称为openExeTest
[HKEY_CLASSES_ROOT\openExeTest]
"URL Protocol"="$ROOT2\\\\frpc\\\\start.bat"
@="openExeTestProtocol"

[HKEY_CLASSES_ROOT\openExeTest\DefaultIcon]
@="$ROOT2\\\\frpc\\\\start.bat,1"

[HKEY_CLASSES_ROOT\openExeTest\shell]

[HKEY_CLASSES_ROOT\openExeTest\shell\open]

#调用URL协议时，打开的程序路径
[HKEY_CLASSES_ROOT\openExeTest\shell\open\command]
@="$ROOT2\\\\frpc\\\\start.bat"

eof;


        $cmd_fp = fopen($ROOT2.DS.'frpc/start.bat', 'wt');
        if (fwrite($cmd_fp, $cmdTest)
            === FALSE) {
            echo "不能写入到文件 $cmd_fp";
            exit;
        }


        $reg_fp = fopen($ROOT2.DS.'frpc/REG.reg', 'wt');
        if (fwrite($reg_fp, $regTest)
            === FALSE) {
            echo "不能写入到文件 $reg_fp";
            exit;
        }

        $ini_fp = fopen($ROOT2.DS.'frpc/frpc.ini', 'wt');
        if (fwrite($ini_fp, $frpTest)
            === FALSE) {
            echo "不能写入到文件 $ini_fp";
            exit;
        }


        $this->success('初始化成功','/admin/index/run.html');
    }


    public function controll()
    {
        $count['article'] = \db('article')->count();
        $this->assign('count', $count);
        return view();
    }

    public function addparam()
    {
        if (request()->isPost()) {
            $key = request()->param('key');
            $as = request()->param('as');
            $value = request()->param('value');
            if (Db::name('system')->insert(['key' => $key, 'as' => $as, 'value' => $value])) {
                echo "<script> var index = parent.layer.getFrameIndex(window.name);
    parent.layer.close(index);  </script> ";
            } else {
                echo "<script> var index = parent.layer.getFrameIndex(window.name);
    parent.layer.close(index);  </script> ";
            }
        } else {
            return view();
        }
    }


    public function del($i = null)
    {
        if (empty($i)) {
            $this->error('数据不存在');
        }
        $i = str_replace('.html', '', $i);
        if (Db::name('system')->where('key', $i)->delete()) {
            $this->success('删除完成');
        } else {
            $this->error('删除失败');
        }
    }

    public function load()
    {
        $sys = Db::name('system')->where('view', 1)->select();
        $this->assign('sys', $sys);
        return view();
    }

    public function save()
    {
        foreach (request()->param() as $k => $y) {
            if (!empty($y)) {
                Db::name('system')->where('key', $k)->update(['value' => $y]);
            }
        }
        $this->success('保存成功', 'load');
    }
}