<?php
class admin
{
  private $db;

  public function __construct()
  {
    $this->db = new database;
  }

  public function getAdminByEmail($email)
  {
    $this->db->query("SELECT * from admin WHERE email=:email");
    $this->db->execute(['email' => $email]);
    if ($this->db->rowCount()) return true;
    else return false;
  }

  public function login($email, $psw)
  {
    $this->db->query("SELECT * FROM admin WHERE email=:email");
    $this->db->execute(["email" => $email]);
    $row = $this->db->fetch();
    $_psw = $row->motPasse;
    return $psw == $_psw;
  }
}
