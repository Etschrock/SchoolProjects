<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$count = 0;

//retrieve cart content
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];

    if ($cart) {
        $count = array_sum($cart);
    }
}

//set shopping cart image
$shoppingcart_img = (!$count) ? "shoppingcart_empty.gif" : "shoppingcart_full.gif";

//variables for user's login, name, and role
$login = '';
$name = '';
$role = '';

//if the use has logged in, retrieve login, name, and role.
if (isset($_SESSION['login']) AND isset($_SESSION['name']) AND isset($_SESSION['role'])) {
    $login = $_SESSION['role'];
    $name = $_SESSION['name'];
    $role = $_SESSION['role'];
}
?>


<!DOCTYPE html>
<html>
    <head>
        <!--
            Author: Hannah Roper
            Date:   November 5, 2016
        -->

        <meta charset=utf-8" />
        <title>IUPUI Student Book Nook</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>

        <div id="wrapEverything">
            <div id="curdate">
                <?php
                date_default_timezone_set('America/New_York');
                echo date("l, F d, Y", time());
                if ($login) {
                    echo "<span style='color:red; margin-left:30px'>Welcome $name!</style>";
                }
                ?> 
            </div>
            <div id="page">

                <div class="topNaviagationLink"><a href="index.php">Home</a></div>
                <div class="topNaviagationLink"><a href="booklist.php">Book List</a></div>
                <div class="topNaviagationLink"><a href="addbook.php">Add Book(s)</a></div>
                <div class="topNaviagationLink"><a href="index.php">Contacts</a></div>

                <?php
                if ($role == 1) {
                    echo "<div class='topNaviagationLink'><a href='userslist.php'>User List</a></div>";
                }
                ?>

                <div class="topNaviagationLink"><a href="searchbooks.php">Search A Book</a></div>
                <?php
                if (empty($login)) {
                    echo "<div class='topNaviagationLink'><a href='loginform.php'>Login</a></div>";
                } else {
                    echo "<div class='topNaviagationLink'><a href='logout.php'>Logout</a></div>";
                }
                ?>

                <div class="topNaviagationLink"><a href="showcart.php">Cart (<?php echo $count ?>)</a>

                </div>
                <div id="mainPicture">
                    <div class="picture">
                        <div id="headerTitle" style="background-image: url(www/img/logo.png)"></div>
                        <div id="headerSubtext">IUPUI Student's Books Nook</div>
                    </div>
                </div>


