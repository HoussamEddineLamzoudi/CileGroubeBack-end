<?php
class crenau
{
  private $db;
  public function __construct()
  {
    $this->db = new database;
  }
  function fetch_all()
  {
    $query = 'select id , value from Crenaus';
    $this->db->query($query);
    $this->db->execute();
    return $this->db->fetchAll(PDO::FETCH_ASSOC);
  }
  function fetch_taken(string $day)
  {
    $query = 'select Crenaus.id, Crenaus.value from Rdvs join Crenaus on Crenaus.id = Rdvs.crenau_id where Rdvs.day = :day';
    $params = array('day' => $day);
    $this->db->query($query);
    $this->db->execute($params);
    return $this->db->fetchAll(PDO::FETCH_ASSOC);
  }
}
