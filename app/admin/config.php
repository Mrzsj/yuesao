<?php
/*
 * @Author: 傍晚升起的太阳
 * @QQ: 1250201168
 * @email: wuruiwm@qq.com
 * @Date: 2019-09-19 08:56:04
 * @LastEditors: 傍晚升起的太阳
 * @LastEditTime: 2019-10-15 17:05:56
 */
// +----------------------------------------------------------------------
// | Tplay [ WE ONLY DO WHAT IS NECESSARY ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017 http://tplay.pengyichen.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 听雨 < 389625819@qq.com >
// +----------------------------------------------------------------------


//配置文件
return [
	'view_replace_str' => [
		'__CSS__'      => '/static/admin/css',
		'__PUBLIC__'   => '/static/public',
		'__JS__'       => '/static/admin/js'
	],
	//是否开启管理员记录日志
	'admin_is_log'=>1,
    // 默认输出类型
    'default_return_type'    => 'html',
    // 默认AJAX 数据返回格式,可选json xml ...
    'default_ajax_return'    => 'json',
];