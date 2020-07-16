<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "test";


$connection = mysqli_connect($host, $user, $password, $database);

if ($connection) {
    //echo "Connection was succesful"."<br>";
} else {
    echo "Connection was not succesful"."<br>";
}
