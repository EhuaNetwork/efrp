<?php


namespace app\index\mod;

use  think\Db;

class System
{
    static $table='system';
    static function get_system($name=null){

        if (!empty($name)) {
            $newres = Db::name(self::$table)->where('key', $name)->value('value');
        } else {
            $res = Db::name(self::$table)->select();
            foreach ($res as $r) {
                $newres[$r['key']] = $r['value'];
            }
        }
      return $newres;
    }
}