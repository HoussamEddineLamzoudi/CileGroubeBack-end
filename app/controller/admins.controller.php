<?php
class admins extends controller
{
  private $adminModel;

  public function __construct()
  {
    $this->adminModel = $this->model('admin');
  }

  public function login()
  {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') die(json_encode(['login' => false]));
    $info = json_decode(file_get_contents("php://input"));
    $data = [
      'email' => $info->email,
      'psw' => $info->password,
    ];
    if (!$this->adminModel->getAdminByEmail($data['email'])) die(json_encode(['login' => false]));
    if ($this->adminModel->login($data['email'], $data['psw']))
      echo json_encode(['login' => true]);
    else
      echo json_encode(['login' => false]);
  }
}
