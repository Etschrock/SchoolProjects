<?php

/**
 * Author: Daniel Neri
 * Date: 11-28-2016
 * Description: This script writes a new user information into the database
 */
//retrieve user inputs from the form
if (!filter_has_var(INPUT + POST, 'full_name') ||
        !filter_has_var(INPUT + POST, 'full_name') ||
        !filter_has_var(INPUT + POST, 'full_name') ||
        !filter_has_var(INPUT + POST, 'full_name')) {
    $error = "The service is currently unavailable. Please try again later.";
    header("Location: error.php?m=$error");
    die();
}


//include code from header.php and database.phps
require_once('includes/database.php');

//retrieve, sanitize, and escape user's input from a form
$user_name = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_STRING)));
$full_name = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING)));
$user_email = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL)));
$phone = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'phone', FILTER_DEFAULT)));
$password = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)));


$role = 2;  //regular user
//insert statement. The id field is an auto field.
$sql = "INSERT INTO users VALUES (NULL, '$user_name', '$full_name', '$user_email', '$phone', '$role', '$password')";

//execut the insert query
$query = @$conn->query($sql);

//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $error = $conn->error;
    $error = "Insertion failed with: ($errno) $error.";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

$conn->close();

//start session if it has not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//create session variables
$_SESSION['login'] = $user_name;
$_SESSION['name'] = $full_name;
$_SESSION['role'] = 2;

//set login status to 3 since this is a new user.
$_SESSION['login_status'] = 3;

//redirect the user to the loginform.php page
header("Location: loginform.php");
