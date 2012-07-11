<?php

include('../../AuthClass.php');
$user = authenticateUser();
cmpUserAndId($user);
include('../AdminClass.php');
include('../top.php');
$uri = $_SERVER['REQUEST_URI'];
$pieces = explode("/", $uri);
//print_r($pieces);
//awdwad.php
$temp = explode(".", $pieces[3]);
include($temp[0] . "_c.php");
include('../../bottom.php');
?>
