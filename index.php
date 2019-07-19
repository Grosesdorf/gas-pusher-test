<?php

use Controller\Temperature\TemperatureController;

include_once 'TemperatureController.php';

    $t = new TemperatureController();
    $temperature = $t->index();
?>

<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
Current temperature : <span id='temp_value'><?php echo $temperature?></span>
  </p>

<!--  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>-->
  <script src="asset/js/jquery-3.4.1.min.js"></script>
<!--  <script src="https://js.pusher.com/4.4/pusher.min.js"></script>-->
  <script src="asset/js/pusher.min.js"></script>
  <script src="asset/js/main.js"></script>
</body>