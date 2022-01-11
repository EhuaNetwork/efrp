<?php


namespace app\admin\controller;

//栏目管理
use Cassandra\DefaultSchema;
use Ehua\Tool\Tool;
use think\Db;

class Mod extends Baseadmin
{


    public function index()
    {
//        $data = Db::name('mod');
//        if (!empty($t)) {
//            $data = $data->where('type', $t);
//        }
//        if (!empty($key)) {
//            $data = $data->where('name', 'like', "%{$key}%");
//        }
//        $data = $data->order('top', 'desc')->field('id,upid,name')->select();
//        $res = json_encode(_classify_category(0, $data), 256);
//
//        $res = preg_replace("/\"upid\":0,/", '', $res);
//        $res = preg_replace("/name/", 'title', $res);
//        $data = preg_replace("/,\"children\":\[\]/", '', $res);
//
//        $this->assign('data', $data);
//
//        return view();
        $types = Db::name('mod')->order('top', '')->field('id,upid,name,top')->select();
        function sort($data, $pid = 0, $level = 0)
        {
            static $arr = array();
            foreach ($data as $k => $v) {
                if ($v['upid'] == $pid) {
                    $v['level'] = $level;
                    $arr[] = $v;
                    sort($data, $v['id'], $level + 1);
                }
            }
            return $arr;
        }

        $type2 = sort($types);
        $this->assign('data', $type2);
        return view();
    }

    //旧版创建弹出页面
    public function create($i = 0)
    {
        $this->assign('i', $i);

        if (request()->isPost()) {
            $id = request()->param('i');
            $upid_all = Db::name('mod')->where('id', $id)->value('upid_all');
            $data = [
                'name' => request()->param('name'),
                'upid' => request()->param('i'),
                'upid_all' => $upid_all . "[$id]",
                'top' => 0,
            ];
            db('mod')->insert($data);

            echo "<script> var index = parent.layer.getFrameIndex(window.name);
    parent.layer.close(index);  </script> ";
            $this->success('ok');

        } else {

            return view();
        }
    }


    public function edit_name()
    {
        if (request()->isPost()) {
            $id = request()->param('i');
            $name = request()->param('name');
            if (Db::name('mod')->where('id', $id)->update(['name' => $name])) {
                $this->success('ok');
            } else {
                $this->error('error');
            }
        }
    }

    public function edit_del()
    {
        if (request()->isPost()) {
            $id = request()->param('i');
            if (Db::name('mod')->where('id', $id)->delete()) {
                Db::name('article')->where('type', $id)->delete();
                $this->success('ok');
            } else {
                $this->error('error');
            }
        }
    }


    public function edit($i = 0)
    {
        $this->assign('i', $i);
        if (request()->isPost()) {
            $id = request()->param('i');

            $this_info = \db('mod')->where('id', $id)->find();
            $upid_all = \db('mod')->where('id', request()->param('upid'))->value('upid_all');

            $new_down_all = $upid_all . '[' . request()->param('upid') . ']';
            $re_down_all = $this_info['upid_all'] . '[' . $id . ']';
            $r = \db('mod')->where('upid_all', 'like', "%" . $re_down_all . "%")->select();
            foreach ($r as $y) {
                $y['upid_all'] = str_replace($this_info['upid_all'], $new_down_all, $y['upid_all']);
                \db('mod')->where('id', $y['id'])->update(['upid_all' => $y['upid_all']]);
            }
            $data = [
                'name' => request()->param('name'),
                'upid' => request()->param('upid'),
                'upid_all' => $new_down_all,
                'top' => request()->param('top'),
            ];
            if (Db::name('mod')->where('id', $id)->update($data)) {
                echo "<script> var index = parent.layer.getFrameIndex(window.name);
    parent.layer.close(index);  </script> ";
            } else {
                echo "<script> var index = parent.layer.getFrameIndex(window.name);
    parent.layer.close(index);  </script> ";
            }


        } else {


            $data = Db::name('mod')->where('id', $i)->find();
            $this->assign('data', $data);

            //todo 21.12.8更新
            $types = Db::name('mod')->order('top', '')->field('id,upid,name')->select();
            function sort($data, $pid = 0, $level = 0)
            {
                static $arr = array();
                foreach ($data as $k => $v) {
                    if ($v['upid'] == $pid) {
                        $v['level'] = $level;
                        $arr[] = $v;
                        sort($data, $v['id'], $level + 1);
                    }
                }
                return $arr;
            }

            $type2 = sort($types);
            $this->assign('type2', $type2);
            $this->assign('tt', $data['upid']);


            return view();
        }
    }


    public function settop($i = null, $t = null)
    {
        $arr = explode(',', $i);
        if (Db::name('mod')->whereIn('id', $arr)->update(['top' => $t])) {
            $this->success('设置完成');
        } else {
            $this->error('设置失败');
        }
    }
}