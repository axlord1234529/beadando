<?php

session_start();

if(! isset($_SESSION['userid'])) $_SESSION['userid'] = 0;
if(! isset($_SESSION['userfirstname'])) $_SESSION['userfirstname'] = "";
if(! isset($_SESSION['userlastname'])) $_SESSION['userlastname'] = "";

include(SERVER_ROOT . 'includes/database.inc.php');
include(SERVER_ROOT . 'includes/menu.inc.php');
include (SERVER_ROOT . 'includes/auto_loader.inc.php');

$page = "nyitolap";
$vars = array();
$request = $_SERVER['QUERY_STRING'];

if($request != "")
{
    $params = explode('/', $request);
    $page = array_shift($params);
    $vars += $_POST;

    if(array_key_exists($page, Menu::$menu) && count($params))
    {
        foreach($params as $p)
        {
            $vars[] = $p;
        }
    }
}

$controllerName =$page;
$controllerFile = SERVER_ROOT.'controllers/'.$controllerName.'.php';

if(! file_exists($controllerFile))
{
    $controllerName = "error404";
    $controllerFile = SERVER_ROOT.'controllers/error404.php';
}

include_once ($controllerFile);
$controllerClass = ucfirst($controllerName).'_Controller';
if(class_exists($controllerClass))
{
    $controller = new $controllerClass;
}
else
{
    die('class does not exists!');
}

$controller -> main($vars);


