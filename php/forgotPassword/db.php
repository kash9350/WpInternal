<?php

$servername = "localhost";
$username = "wpRootDatabase";
$password = "orthrox";
$dbname = "whitepanda";


$connection = mysqli_connect($servername,$username,$password,$dbname) or die(mysqli_error($connection));
?>