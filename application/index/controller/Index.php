<?php

namespace app\index\controller;
use think\Db;
use app\index\mod\Article;
use think\Request;

class Index extends Basehome
{
    public function index()
    {
        return view();
    }


}
