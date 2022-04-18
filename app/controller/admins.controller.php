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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      $info = json_decode(file_get_contents("php://input"));

      $data = [

        'email' => $info->adminEmail,
        'psw' => $info->adminPassword,
        'email_err' => '',
        'psw_err' => ''
      ];

      //check if email exist

      if (!$this->adminModel->getAdminByEmail($data['email'])) {
        $data['email_err'] = " L'adresse email est introuvable ";
      }



      if (empty($data['email_err']) && empty($data['psw_err'])) {

        $admin = $this->adminModel->login($data['email'], $data['psw']);

        if ($admin) {

          $retourAdmin['login'] = $admin->adminId;
          echo json_encode($retourAdmin);
        } else {


          $data['password_err'] = 'Mot de passe incorrect';
          $retourAdmin['login'] = 'error Login';
          echo json_encode($retourAdmin);
        }
      } else {

        $retourAdmin['login'] = 'error Login';
        echo json_encode($retourAdmin);
      }
    } else {

      // 0; Not loged yet 
      $retourAdmin['login'] = '0';
      echo json_encode($retourAdmin);
    }
  }
}
