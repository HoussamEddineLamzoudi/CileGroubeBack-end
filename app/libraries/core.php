<?php

class core
{
  protected $controller = 'pages';
  protected $method = 'index';
  protected $param = [];

  public function __construct()
  {
    $url = $this->getUrl();

    if (isset($url[0])) {
      if (file_exists('../app/controller/' . $url[0] . '.controller.php')) {
        // print_r($url);
        $this->controller = $url[0];
      }
    }

    require_once '../app/controller/' . $this->controller . '.controller.php';

    $this->controller = new $this->controller;

    if (isset($url[1])) {
      if (method_exists($this->controller, $url[1])) {
        $this->method = $url[1];
      }
    }

    $this->param = array_slice($url, 2);

    call_user_func_array([$this->controller, $this->method], $this->param);
  }


  public function getUrl()
  {

    if (isset($_GET['url'])) {
      $url = $_GET['url'];
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = rtrim($url, '/');
      $url = explode('/', $url);

      return $url;
    } else {
      $url = $_SERVER['REQUEST_URI'];
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = trim($url, '/');
      $url = explode('/', $url);
      return $url;
    }
  }
}
