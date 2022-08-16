<?php

/*
    Asatru PHP - routes configuration file

    Add here all your needed routes.

    Schema:
        [<url>, <method>, controller_file@controller_method]
    Example:
        [/my/route, get, mycontroller@index]
        [/my/route/with/{param1}/and/{param2}, get, mycontroller@another]
    Explanation:
        Will call index() in app\controller\mycontroller.php if request is 'get'
        Every route with $ prefix is a special route
*/

return [
    array('/', 'GET', 'index@index'),
    array('/generator', 'GET', 'index@generator'),
	array('/api/query/app', 'GET', 'api@queryAppInfo'),
    array('/api/query/server', 'GET', 'api@queryServerInfo'),
    array('/api/query/user', 'GET', 'api@queryUserInfo'),
    array('/api/resource/query', 'GET', 'api@queryResource'),
    array('$404', 'ANY', 'error404@index')
];
