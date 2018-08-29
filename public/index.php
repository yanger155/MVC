<?php
// 入口文件放在public中
// 定义一个根目录常量
define('Root',dirname(__FILE__).'/../');




// 路由功能:要去加载控制器文件中的类
// 自动加载
function autoload($class)
{
    $path = str_replace('\\','/',$class);
    require(Root.$path.'.php');
}
spl_autoload_regist('autoload');
// $index = new controller\IndexController;




// 加载视图
function view($viewFileName,$data = [])
{
    extra($data);
    // 把一个数组展成多个变量，比如有一个数组$data=['name'=>'tom',当展开时extract($data),就相当于把数组中每个键取出来单独定义成变量：$name='tom';,这样就可以直接使用$name变量了
    $path = str_replace('.','/',$viewFileName).'.html';

    require(Root.'views/'.$path);
}




// 根据URL-任务分发
if(isset($_SERVER['PATH_INFO']) )
// $_SERVER['PATH_INFO]:用来获取当前的URL字符串，比如当我们访问http://xxx/user/face?id=1时，$_SERVER['PATH_INFO']得到的是/user/face
{
    $pathinfo = $_SERVER['PATH_INFO'];
    $pathinfo = explode('/',$pathinfo);
    // 根据 / 转成数组

    $controller = ucfirst($pathinfo[1]).'Controller';
    $action = $pathInfo[2];

}else{
    $controller = 'IndexController';
    $action = 'index';

}
$fullController = 'controllers\\'.$controller;

// new对象，调用类方法
$_C = new $fullController;
$_C->$action();





