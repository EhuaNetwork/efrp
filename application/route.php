<?php

if (!file_exists(ROOT_PATH . 'public' . DS . 'install' . DS . 'install.lock')) {
    header('location:/install');
    die;
}


return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];

