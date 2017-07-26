<?php

//define parameters
$host = "localhost";
$login = "phpuser";
$password = "phpuser";
$database = "i210_finalproject";

//connects to the mysql database
$conn = @new mysqli($host, $login, $password, $database);

//this will handle connection errors
if ($conn->connect_errno) {
    $errno = $conn->connect_errno;
    $errmsg = $conn->connect_error;
    die("Connection to database failed: ($errno) $errmsg.");
}