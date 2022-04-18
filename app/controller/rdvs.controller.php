<?php
class rdvs extends controller
{
  private  $rdvModel;
  public function __construct()
  {
    $this->rdvModel = $this->model('rdv');
  }

  function fetch_by_ref(bool $history = false)
  {
    if (!$this->ref) die('no ref provided');
    else echo json_encode($this->rdvModel->fetch_by_ref($this->ref, $history));
  }

  function create()
  {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['day'], $data['crenau_id'], $data['subject'], $data['ref'])) die('not enough data');
    try {
      $this->rdvModel->create($data);
      echo json_encode(['created' => true]);
    } catch (Exception $e) {
      echo json_encode($e);
      echo json_encode(['created' => false]);
    }
  }

  function update()
  {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['id'])) die("no enough data");
    try {
      foreach ($data as $key => $value) :
        if ($key != 'id') $this->rdvModel->update($key, $value, $data['id']);
      endforeach;
      echo json_encode(['updated' => true]);
    } catch (Throwable $e) {
      die(json_encode($e));
    }
  }

  function delete()
  {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['id'])) die('no enough data');
    try {
      $this->rdvModel->delete($data['id']);
      echo json_encode(['deleted' => true]);
    } catch (Throwable $e) {
      die(json_encode($e));
    }
  }
}
