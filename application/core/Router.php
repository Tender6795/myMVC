<?php
//http://mvc/index.php/account/login
namespace application\core;
use application\core\View;
class Router {
  protected $routes=[];
protected $params=[];

  function __construct()
  {
    $arr=require 'application/config/routes.php';
    foreach ($arr as $key => $value) {
    $this-> add($key,$value);
    }
  }

//Добавление маршрута
  public function add($route,$params){
     $route='#^'.$route.'$#'; //преврашаем в регулярку
     $this->routes[$route]= $params;
  }
//Проверка маршрута
  public function match(){
$url=trim($_SERVER['REQUEST_URI'],'/');  //нашли url и удалили лиший слеш
//$url=str_replace("index.php/","",$url);  //костыль чтоб избавиться от index.php/
//echo $url."<br>";
foreach ($this->routes as $route => $params) {

  if(preg_match($route,$url,$matches)){
$this->params=$params;

return true;
    }
  }
  return false;
}
//Запуск
  public function run(){
    if($this->match()){
    $path='application\controllers\\'.ucfirst( $this->params['controller']).'Controller';  //ucfirst делает первую букву большой
    if(class_exists($path)){   //Проверка на существование
$action=$this->params['action'].'Action';
if(method_exists($path,$action)){
$controller =new $path($this->params);
$controller->$action();

}
else{
  View::errorCode(404);
}
    }
    else{
        View::errorCode(404);
    }
    }
else{
    View::errorCode(404);
}
  }
}
