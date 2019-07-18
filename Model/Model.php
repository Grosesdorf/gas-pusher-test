<?php

namespace Model;

use Database\Database;

include_once 'Database.php';

class Model{
    public $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }
}
