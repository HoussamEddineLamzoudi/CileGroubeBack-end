<?php

class controller
{
  public function model($model)
  {
    require_once '../app/model/' . $model . '.model.php';
    return new $model;
  }
}
