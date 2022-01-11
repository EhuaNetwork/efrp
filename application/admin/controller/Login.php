<?php


namespace app\admin\controller;

use think\Db;

use think\Controller;

class Login extends Controller
{
    public $admPath;
    public function _initialize()
    {
        $this->admPath=explode("\\",__CLASS__)[1];
        $this->assign('admPath', $this->admPath);

        $system = get_system();
        $this->assign('system', $system);
    }

    public function login()
    {
        return view();
    }

    public function loginauth($username = null, $password = null)
    {
        if (empty($username) || empty($password)) {
            return json(['code' => -1, 'msg' => '信息不完整', 'data' => []]);
        }

        $info = Db::name('admin')->where('name', $username)->find();
        if (empty($info)) {
            return json(['code' => -1, 'msg' => '账号或密码错误', 'data' => []]);
        }


        if (!password_verify($password, $info['pass'])) {
            return json(['code' => -1, 'msg' => '账号或密码错误', 'data' => []]);
        }

        unset($info['pass']);
        Db::name('admin')->where('id', $info['id'])->update(['ip' => request()->ip()]);
        session('server', $info);
        return json(['code' => 1, 'msg' => '登录成功', 'data' => []]);

    }

}