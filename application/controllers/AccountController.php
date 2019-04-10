<?php
namespace application\controllers;
use application\core\Controller ;     //Подключили что б отнаследовать
class AccountController extends Controller {
  public function loginAction(){
if(!empty($_POST)){
  exit(json_encode(["status"=>"success","message"=>123]));
}
  $this->view->render("Вход");
  }

  public function registerAction(){

  $this->view->render("Регистрация");
  }

}
