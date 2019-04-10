<?php
namespace application\controllers;
use application\core\Controller ;     //Подключили что б отнаследовать
class NewsController extends Controller {
  public function showAction(){
    echo 'Страница с новостью';
  }
}
