<?php

$input_json = file_get_contents('php://input');
$input = json_decode($input_json);
var_dump($input);

?>