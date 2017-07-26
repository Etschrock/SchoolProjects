<?php

/*
 * Author: Daniel Neri
 * Date: 11/15/2016
 * File: insertbook.php
 * Description: This file inserts a new book into the database
 *
 */

$page_title = "IUPUI Student's Books Nook Add Book";
require_once 'includes/header.php';
require_once('includes/database.php');

//if the script did not received post data, display an error message and then terminite the script immediately
if (!filter_has_var(INPUT_POST, 'title') ||
        !filter_has_var(INPUT_POST, 'author') ||
        !filter_has_var(INPUT_POST, 'status') ||
        !filter_has_var(INPUT_POST, 'isbn') ||
        //!filter_has_var(INPUT_POST, 'publish_date') ||
        //!filter_has_var(INPUT_POST, 'publisher') ||
        !filter_has_var(INPUT_POST, 'price') ||
        !filter_has_var(INPUT_POST, 'image') ||
        !filter_has_var(INPUT_POST, 'course')) {
    //!filter_has_var(INPUT_POST, 'description')) {

    echo "There were problems retrieving book details. New book cannot be added.";
    require_once 'includes/footer.php';
    $conn->close();
    die();
}

//retrieve, sanitize, and escape user's input from form in addbook.php
$title = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING)));
$author = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING)));
$status = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING)));
$isbn = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'isbn', FILTER_SANITIZE_NUMBER_INT)));
//$publish_date = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'publish_date', FILTER_SANITIZE_STRING)));
//$publisher = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'publisher', FILTER_SANITIZE_STRING)));
$price = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING))); //allows decimals
$image = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
$course = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'course', FILTER_SANITIZE_STRING)));
//$description = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)));
//define the MySQL insert statement; order must match database colum fields 
$sql = "INSERT INTO books VALUES (NULL, '$title', '$isbn', '$author', '$course', '$price', '$status', '$image')";

//execute the query
$query = @$conn->query($sql);

//handle error
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Insertion failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    include 'includes/footer.php';
    exit;
}


//determine the id of the newly added book
$id = $conn->insert_id;

// close the connection.
$conn->close();

//display a confirmation message and a link to display details of the new book
echo "You have successfully inserted the new book into the database.";
echo "<p><a href='bookdetails.php?id=$id'>Book Details</a></p>";
require_once 'includes/footer.php';
