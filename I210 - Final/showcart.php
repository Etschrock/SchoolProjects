<?php
/*
 * Author: Daniel Neri
 * Date: 11-28-2016
 * File: bookdetails.php
 * Description: this script displays details of a particular book.
 *
 */

$page_title = "Shopping Cart";
require_once ('includes/header.php');
require_once('includes/database.php');
?>
<br>
<h2 class="tableHeading">My Shopping Cart</h2>
<br>
<?php
if (!isset($_SESSION['cart']) || !$_SESSION['cart']) {
    echo "Your shopping cart is empty.<br><br>";
    include ('includes/footer.php');
    exit();
}

//proceed since the cart is not empty
$cart = $_SESSION['cart'];
?>
<table class="booklist">
    <tr>
        <th style="width: 500px">Title</th>
        <th style="width: 60px">Price</th>
        <th style="width: 60px">Quantity</th>
        <th style="width: 60px">Total</th>
    </tr>
    <?php
    //insert code to display the shopping cart content
    //select statement
    $sql = "SELECT posting_id, title, price FROM books WHERE 0";

    foreach (array_keys($cart) as $id) {
        $sql .= " OR posting_id=$id";
    }

    //execute the query
    $query = $conn->query($sql);

    //fetch books and display them in a table
    while ($row = $query->fetch_assoc()) {
        $id = $row ['posting_id'];
        $title = $row ['title'];
        $price = $row ['price'];
        $qty = $cart [$id];
        $total = $qty * $price;
        echo "<tr>",
        "<td><a href='bookdetails.php?id=$id'>$title</a></td>",
        "<td>$$price</td>",
        "<td>$qty</td>",
        "<td>$$total</td>",
        "</tr>";
    }
    ?>
</table>
<br>
<div class="bookstore-button">
    <input type="button" value="Checkout" onclick="window.location.href = 'checkout.php'"/>
    <input type="button" value="Cancel" onclick="window.location.href = 'booklist.php'" />
</div>
<br><br>

<?php
include ('includes/footer.php');
