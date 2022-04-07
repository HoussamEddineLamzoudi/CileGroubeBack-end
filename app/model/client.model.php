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
}
