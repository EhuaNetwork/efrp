<?php


namespace app\index\mod;


use think\Db;

//文章模块 数据库相关操作类
class Article
{
    /**
     * 获取指定模块id下的文章，含子分类的文章
     * @param $id   分类id号
     */
    static $table='article';
    static function getmodlist($id, $limit)
    {

        $ids = Mod::gettypelist($id, true);
        $ids = array_column($ids, 'id');
        array_push($ids, $id);
        $res = Db::name(self::$table)->join('mod','mod.id='.config('database.prefix').self::$table.'.type')
            ->whereIn(config('database.prefix').self::$table.'.type', $ids)
            ->order('top', 'desc')
            ->order('update_time', 'desc')
            ->limit($limit[0], $limit[1])
            ->field(config('database.prefix').self::$table.'.*,mod.m,mod.c,mod.a')
            ->select();
        return $res;
    }

    /**
     * 获取指定id的文章
     * @param $id   分类id号
     */
    static function getartist($ids, $limit)
    {
        $res = Db::name(self::$table)
            ->whereIn('id', $ids)
            ->order('update_time', 'desc')
            ->limit($limit[0], $limit[1])
            ->select();
        return $res;
    }



}