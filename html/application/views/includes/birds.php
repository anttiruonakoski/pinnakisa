<?php
$birdJson = file_get_contents("application/views/includes/birds.json");
$bird = json_decode($birdJson, TRUE);
?>