<?php

namespace Model\Temperature;

use DateTime;
use Model\Model;
use PDO;

include_once 'Model.php';

class Temperature extends Model
{
    private $table_name = 'pusher_test.temperature';
    private $stmt = '';

    public function store($value)
    {
        $valueTemperature = $value=htmlspecialchars(strip_tags($value));

        $this->db->beginTransaction();
        $this->db->exec('LOCK TABLES ' . $this->table_name);

        $querySelect = "SELECT value FROM " . $this->table_name . ' ORDER BY created_at DESC LIMIT 1';

        $this->stmt = $this->db->prepare($querySelect);
        $this->stmt->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['value'] != $valueTemperature)
        {
            $dt = new DateTime();
            $created_at = $dt->format('Y-m-d H:i:s');

            $queryInsert = "INSERT INTO " . $this->table_name . " SET value=:value, created_at=:created_at";

            $this->stmt = $this->db->prepare($queryInsert);
            $this->stmt->bindParam(":value", $valueTemperature);
            $this->stmt->bindParam(":created_at", $created_at);
            $this->stmt->execute();
        }
        else
        {
            $this->stmt = false;
        }

        $this->db->commit();
        $this->db->exec('UNLOCK TABLES');

        return $this->stmt = true ? true : false;
    }

    public function show(){

            // query to read single record
            $query = "SELECT value FROM " . $this->table_name . ' ORDER BY created_at DESC LIMIT 1';

            // prepare query statement
            $this->stmt = $this->db->prepare($query);

            // execute query
            $this->stmt->execute();

            // get retrieved row
            $row = $this->stmt->fetch(PDO::FETCH_ASSOC);

            return $row['value'];
    }
}