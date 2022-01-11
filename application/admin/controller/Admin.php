<?php


namespace app\admin\controller;

use think\Db;

class Admin extends Baseadmin
{
    public function repass()
    {
        return view();
    }

    public function repasssave()
    {
        $name = request()->param('name');
        $pass = request()->param('pass');
        $repass = request()->param('repass');
        $i = request()->param('i');

        $info = Db::name('admin')->where('id', $i)->find();
        if (empty($info)) {
            $this->error('用户不存在');
        }
        if (!password_verify($repass, $info['pass'])) {
            $this->error('原密码错误');
        }

        $data = ['name' => $name, 'pass' => password_hash($pass, PASSWORD_BCRYPT)];
        if (Db::name('admin')->where('id', $i)->update($data)) {
            session('server', null);
            $this->success('修改成功');
        } else {
            session('server', null);
            $this->error('修改失败');
        }

    }

    public function out()
    {
        session('server', null);
        $this->redirect($this->admPath . '/login/login');
    }
}