<?php


namespace app\index\mod;


use think\Db;

//栏目模块 数据库相关操作类
class Mod
{

    static $table = 'mod';

    /**
     * 获取下级列表
     * @param $id       当前id
     * @param bool $bool true获取所有下级
     * @return bool|false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    static function gettypelist($id, $bool = false)
    {
        if ($bool) {
            $ids = Db::name(self::$table)->where('upid_all', 'like', "%[$id]%")->order('top','desc')->select();

        } else {
            $ids = Db::name(self::$table)->where('upid', '=', $id)->order('top','desc')->select();

        }
        return $ids;
    }

    /**
     * 获取一级导航
     * @return bool|false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    static function getnavlist(){
        $ids = Db::name(self::$table)->where('upid', '=', 0)->where('is_nav',1)->order('top','desc')->select();
        return $ids;
    }

}