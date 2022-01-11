<?php

use think\Db;

function get_system($name = null)
{

    if (!empty($name)) {
        $newres = db('system')->where('key', $name)->value('value');
    } else {
        $res = db('system')->select();
        foreach ($res as $r) {
            $newres[$r['key']] = $r['value'];
        }
    }
    return $newres;
}

function topString($level)
{
    $str = '';
    for ($i = 0; $i < $level; $i++) {
        $str .= '|----';
    }
    return $str;
}





