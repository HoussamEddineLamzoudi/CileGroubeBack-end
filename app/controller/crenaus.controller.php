<?php
class crenaus extends controller
{
  private $model;
  public function __construct()
  {
    $this->model = $this->model('crenau');
  }

  public function get_crenaus($day)
  {
    if (empty($day)) die('no day provided !');
    $taken = $this->model->fetch_taken($day);
    $all = $this->model->fetch_all();
    $available = array();
    foreach ($all as $crenau) :
      $found  = false;
      foreach ($taken as $tk) :
        if ($tk['id'] == $crenau['id']) $found = true;
      endforeach;
      if (!$found) $available[] = $crenau;
    endforeach;
    $available = array('day' => $day, 'crenaus' => $available);
    echo json_encode($available);
  }
}
