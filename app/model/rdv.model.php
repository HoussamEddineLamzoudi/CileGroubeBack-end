<?php
class rdv
{
  private $db;
  function __construct()
  {
    $this->db = new database;
  }
  public function create($data)
  {
    $query = 'insert into Rdvs (day, crenau_id, subject, client_id) values(:day, :crenau_id, :sujet, (select id from Clients where ref = :ref))';
    $params = array(
      'day' => $data['day'],
      'crenau_id' => $data['crenau_id'],
      'sujet' => $data['subject'],
      'ref' => $data['ref']
    );

    $this->db->query($query);
    $this->db->execute($params);
  }

  function update(string $column, string $value, string $id)
  {
    $query = 'update Rdvs set ' . $column . ' = :value where id = :id';
    $params = array('value' => $value, 'id' => $id);
    $this->db->query($query);
    $this->db->execute($params);
    return $this->db->fetchAll(PDO::FETCH_ASSOC);
  }

  function delete(string $id)
  {
    $query = "delete from Rdvs where id = :id";
    $params = array('id' => $id);
    $this->db->query($query);
    $this->db->execute($params);
  }
}
