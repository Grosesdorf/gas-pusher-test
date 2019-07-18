<?php

use Controller\Temperature\TemperatureController;

/* AJAX check  */
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    if (isset($_POST['value']) && !empty($_POST['value']))
    {
        include_once '../TemperatureController.php';

        $t = new TemperatureController();
        $t->store($_POST['value']);

        echo $_POST['value'];
    }
    else
    {
        echo "I am empty!";
    }
}