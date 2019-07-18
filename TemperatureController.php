<?php

namespace Controller\Temperature;

use Model\Temperature\Temperature;

include_once 'Model/Temperature.php';

class TemperatureController
{
    public function index()
    {
        $t = new Temperature();

        return $t->show();
    }

    public function store($value)
    {
        $t = new Temperature();

        return $t->store($value);
    }
}


