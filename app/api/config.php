<?php
//配置文件
return [
    // 默认输出类型
    'default_return_type'    => 'json',
    // 默认AJAX 数据返回格式,可选json xml ...
    'default_ajax_return'    => 'json',
    //token时效
    'token_time'=>31536000*10,
    'cache' => [ // 缓存
        'token_expire' => 31536000*10, //1小时 =3600
        'type'   => 'File',
        'host'   => '127.0.0.1',
        'port'   => '6379',
        'path'   => ROOT_PATH."login".DS,
        // 缓存前缀
        'prefix' => '',
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ],
];