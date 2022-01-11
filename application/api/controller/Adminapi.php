<?php


namespace app\api\controller;


use app\admin\controller\Common;
use think\Controller;

class Adminapi extends Common
{
    public function getmenu()
    {
        $admPath = $this->admPath;
        $data = [
            "homeInfo" => [
                "title" => "首页",
                "href" => url($admPath . '/index/controll')
            ],
            "logoInfo" => [
                "title" => "EFRP",
                "image" => "/favicon.ico",
                "href" => ""
            ],
            "menuInfo" => [
                [
                    "title" => "常规管理",
                    "icon" => "fa fa-address-book",
                    "href" => "",
                    "target" => "_self",
                    "child" => [
                        [
                            "title" => "站点设置",
                            "href" => "",
                            "icon" => "fa fa-home",
                            "target" => "_self",
                            "child" => [
                                [
                                    "title" => "网站设置",
                                    "href" => url($admPath . '/index/load'),
                                    "icon" => "fa fa-tachometer",
                                    "target" => "_self"
                                ],[
                                "title" => "启动服务",
                                "href" => url($admPath . '/index/run'),
                                "icon" => "fa fa-tachometer",
                                "target" => "_self"
                            ]
                            ]
                        ],
                        [
                            "title" => "映射管理",
                            "href" => "",
                            "icon" => "fa fa-home",
                            "target" => "_self",
                            "child" => [
                                [
                                    "title" => "映射列表",
                                    "href" => url($admPath . '/article/lists'),
                                    "icon" => "fa fa-tachometer",
                                    "target" => "_self"
                                ],
                                [
                                    "title" => "添加映射",
                                    "href" => url($admPath . '/article/create2'),
                                    "icon" => "fa fa-tachometer",
                                    "target" => "_self"
                                ]
                            ]
                        ],
                        [
                            "title" => "分类管理",
                            "href" => "",
                            "icon" => "fa fa-home",
                            "target" => "_self",
                            "child" => [
                                [
                                    "title" => "分类列表",
                                    "href" => url($admPath . '/mod/index'),
                                    "icon" => "fa fa-tachometer",
                                    "target" => "_self"
                                ],
                                [
                                    "title" => "分类栏目",
                                    "href" => url($admPath . '/mod/create'),
                                    "icon" => "fa fa-tachometer",
                                    "target" => "_self"
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "title" => "插件管理",
                    "icon" => "fa fa-lemon-o",
                    "href" => "#",
                    "target" => "_self",
                    "child" => [

                        [
                            "title" => "待更新",
                            "href" => url($admPath . '/index/controll2'),
                            "icon" => "fa fa-tachometer",
                            "target" => "_self"
                        ]

                    ]
                ],
                [
                    "title" => "其它管理",
                    "icon" => "fa fa-slideshare",
                    "href" => "#",
                    "target" => "_self",
                    "child" => [
                        [
                            "title" => "待更新",
                            "href" => url($admPath . '/index/controll3'),
                            "icon" => "fa fa-tachometer",
                            "target" => "_self"
                        ]
                    ]
                ]
            ]
        ];


        return json($data);
    }
}