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
    $this->db->bind(":email", $email);
    $this->db->execute();
    if ($this->db->rowCount()) return true;
    else return false;
  }

  public function login($email, $psw)
  {

    $this->db->query("SELECT * FROM admin WHERE email=:email");
    $this->db->bind(":email", $email);

    $row = $this->db->fetch();


    $_psw = $row->motPasse;


    if ($psw === $_psw) {

      return $row;
    } else {

      return false;
    }
  }
}
