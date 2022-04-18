<?php

class database
{

  private $host = db_host;
  private $user = db_user;
  private $psw = db_psw;
  private $dbName = db_name;

  private $conn;
  private $stmt;

  public function __construct()
  {
    $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;

    try {
      $this->conn = new PDO($dns, $this->user, $this->psw);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  public function __destruct()
  {
    if ($this->stmt !== null) {
      $this->stmt = null;
    }
    if ($this->conn !== null) {
      $this->conn = null;
    }
  }

  public function query($sql)
  {
    $this->stmt = $this->conn->prepare($sql);
  }

  public function bind($param, $value, $type = null)
  {
    if (is_null($type)) {
      switch (true) {
        case is_int($value):
          $type = pdo::PARAM_INT;
          break;
        case is_bool($value):
          $type = pdo::PARAM_BOOL;
          break;
        case is_null($value):
          $type = pdo::PARAM_NULL;
          break;
        default:
          $type = pdo::PARAM_STR;
      }
    }

    $this->stmt->bindValue($param, $value, $type);
  }

  public function execute($params = [])
  {
    return $this->stmt->execute($params);
  }

  public function fetchAll($mode = PDO::FETCH_OBJ)
  {
    $this->stmt->execute();
    $results = $this->stmt->fetchAll($mode);
    return $results;
  }

  public function fetch($mode = PDO::FETCH_OBJ)
  {
    $this->stmt->execute();
    $result = $this->stmt->fetch($mode);
    return $result;
  }

  public function rowCount()
  {
    return $this->stmt->rowCount();
  }
}
