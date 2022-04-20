<?php
class client
{
  private $db;

  public function __construct()
  {
    $this->db = new database;
  }

  public function add_client($data)
  {
    $this->db->query("INSERT INTO Clients (first_name, last_name, age, profession, ref) VALUES(:first_name, :last_name, :age, :profession, :ref)");

    $this->db->bind(':first_name', $data['first_name']);
    $this->db->bind(':last_name', $data['last_name']);
    $this->db->bind(':age', $data['age']);
    $this->db->bind(':profession', $data['profession']);
    $this->db->bind(':ref', $data['key']);

    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function checkKey($ref)
  {
    $this->db->query('select * from Clients where ref = :ref');
    $this->db->execute(['ref' => $ref]);
    return $this->db->fetch(PDO::FETCH_ASSOC);
  }

  function getRdvs(string $ref)
  {
    $query = "select Rdvs.id, Rdvs.day, Crenaus.value as crenau, Rdvs.subject from Rdvs join Crenaus on Crenaus.id = Rdvs.crenau_id where client_id = (select id from Clients where ref = :ref)";
    $params = array('ref' => $ref);
    $this->db->query($query);
    $this->db->execute($params);
    return $this->db->fetchAll(PDO::FETCH_ASSOC);
  }

  function getAll()
  {
    $query = "select * from Clients";
    $this->db->query($query);
    $this->db->execute();
    return $this->db->fetchAll(PDO::FETCH_ASSOC);
  }

  function update(string $column, string $value, string $id)
  {
    $query = "update Clients set " . $column . " = :value where id = :id";
    $params = array('value' => $value, 'id' => $id);
    $this->db->query($query);
    $this->db->execute($params);
  }

  function delete(string $id)
  {
    $query = 'delete from Clients where id = :id';
    $params = array('id' => $id);
    $this->db->query($query);
    $this->db->execute($params);
  }
}
