<?php


namespace app\admin\controller;


use think\Controller;

class Common extends Controller
{

    public $admPath;

    public function _initialize()
    {

        $system = get_system();
        $this->assign('system', $system);

        $this->assign('pubPath', '/ecms/server/layuimini/');
        $this->admPath = explode("\\", __CLASS__)[1];
        $this->assign('admPath', $this->admPath);



        $server_ip = get_system('server_ip');
        $this->assign('server_ip', $server_ip);
    }

}