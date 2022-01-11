<?php


namespace app\index\controller;


use think\Controller;
use think\Db;

class Basehome extends Controller
{
    public $staticStatus = false;
    public $M;
    public $C;
    public $A;
    public $system;

    public function _initialize()
    {

        //获取公共数据
        $this->setCommon();
        $this->_init();
    }

    public function _init()
    {
        //注册加载方法 此处不写代码
    }

    public function setCommon()
    {

    }


}
