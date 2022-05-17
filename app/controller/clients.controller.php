<?php
class clients extends controller
{
  private $clientModel;
  public function __construct()
  {
    $this->clientModel = $this->model('client');
  }

  public function addClient()
  {
    $info = json_decode(file_get_contents("php://input"));
    $key = $this->getKey($info->first_name, $info->last_name);
    $data = [
      'first_name' => $info->first_name,
      'last_name' => $info->last_name,
      'age' => $info->age,
      'profession' => $info->profession,
      'ref' => $key
    ];
    $client = $this->clientModel->add_client($data);
    if ($client) {
      $retourClient["seccess"] = true;
      $retourClient['key'] = $key;
      echo json_encode($retourClient);
      $_SESSION['ref'] = $key;
    } else {
      die("add_err");
    }
  }

  private function getKey($fName, $lName)
  {
    $arr1 = str_split($fName);
    $arr2 = str_split($lName);
    $key = $arr1[0] . $arr1[2] . rand(123, 999) . $arr2[0] . $arr2[2] . rand(123, 999);
    return $key;
  }

  function getRdvs(string $ref, string $history = '')
  {
    if (!$ref) die('please proved an id');
    try {
      $allRdvs = $this->clientModel->getRdvs($ref);
      $today = date('Y-m-d');
      $upcoming_rdvs = [];
      $past_rdvs = [];
      for ($i = 0; $i < count($allRdvs); $i++) {
        if ($allRdvs[$i]['day'] > $today) $upcoming_rdvs[] = $allRdvs[$i];
        else $past_rdvs[] = $allRdvs[$i];
      }
      if ($history == 'history')
        echo json_encode(['status' => 'success', 'data' => $past_rdvs]);
      else echo json_encode(['status' => 'success', 'data' => $upcoming_rdvs]);
    } catch (\Throwable $th) {
      echo 'error: ' . $th;
    }
  }

  function checkKey($key)
  {
    $check = $this->clientModel->checkKey($key);
    if ($check) {
      $_SESSION['ref'] = $key;
      echo '{"found":true}';
    } else echo '{"found":false}';
  }

  function getAll()
  {
    try {
      $res = $this->clientModel->getAll();
      echo json_encode(['status' => 'success', 'data' => $res]);
    } catch (Throwable $e) {
      die(json_encode($e));
    }
  }

  function update($id)
  {
    $data = json_decode(file_get_contents('php://input'), true);
    try {
      foreach ($data as $key => $value) :
        if ($key != 'id' && $key != 'ref') $this->clientModel->update($key, $value, $id);
      endforeach;
      echo json_encode(['updated' => true]);
    } catch (Throwable $e) {
      die(json_encode($e));
    }
  }

  function delete($id)
  {
    if (!$id) die('no enough data');
    try {
      $this->clientModel->delete($id);
      echo json_encode(['deleted' => true]);
    } catch (Throwable $e) {
      die(json_encode($e));
    }
  }
}
