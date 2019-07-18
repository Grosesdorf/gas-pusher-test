<?php

namespace Model\Temperature;

use DateTime;
use Model\Model;
use PDO;

include_once 'Model.php';

class Temperature extends Model
{
    private $table_name = 'pusher_test.temperature';

    public function store($value)
    {
        $valueTemperature = $value=htmlspecialchars(strip_tags($value));

        $dt = new DateTime();
        $created_at = $dt->format('Y-m-d H:i:s');

        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET value=:value, created_at=:created_at";

        // prepare query
        $stmt = $this->db->prepare($query);

        // bind values
        $stmt->bindParam(":value", $valueTemperature);
        $stmt->bindParam(":created_at", $created_at);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function show(){

            // query to read single record
            $query = "SELECT value FROM " . $this->table_name . ' ORDER BY created_at DESC LIMIT 1';

            // prepare query statement
            $stmt = $this->db->prepare($query);

            // execute query
            $stmt->execute();

            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row['value'];
    }
}