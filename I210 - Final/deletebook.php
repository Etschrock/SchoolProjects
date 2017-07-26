<?php

/*
 * Author: Daniel Neri
 * Date: 11-16-2016
 * File: deletebook.php
 * Description: retrieves book id and then deletes the book that contains that id
 *
 */
$page_title = "IUPUI Student's Books Nook Delete Book";
require_once 'includes/header.php';
require_once('includes/database.php');

//if there were problems retrieving book id, the script must end.
if (!filter_has_var(INPUT_GET, 'id')) {
    echo "Deletion cannot continue since there were problems retrieving book id";
    include ('includes/footer.php');
    exit;
}

//add your code here
//gets book's id from input and gets stored as a variable
$book_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//define the MySQL delete statement and deletes the book with such id
$sql = "DELETE FROM books WHERE posting_id = $book_id";

//execute the query
$query = @$conn->query($sql);

//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    exit;
}

//close database connection
$conn->close();

//display a confirmation message
echo "You have successfully deleted the book from the database.<br><br>";

require_once 'includes/footer.php';
