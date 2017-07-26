<?php
/** Author: your name
 *  Date: today's date
 *  Description: This PHP script retrieves all books from the books table
 *  in the databate. It then displays all book details in a HTML table.
 */
$page_title = "Book Details";
require_once ('includes/header.php');
require_once('includes/database.php');

//if book id cannot retrieved, terminate the script.
if (!filter_has_var(INPUT_GET, "id")) {
    $conn->close();
    require_once ('includes/footer.php');
    die("Your request cannot be processed since there was a problem retrieving book id.");
}

//retrieve book id from a query string variable.
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

//MySQL SELECT statement
$sql = "SELECT * FROM books, statuses WHERE books.status_id = statuses.status_id AND posting_id=$id";

//execute the query
$query = @$conn->query($sql);

//Handle errors
if (!$query) {
    $errno = $conn->errno;
    $error = $conn->error;
    $conn->close();
    require 'includes/footer.php';
    die("Selection failed: ($errno) $error.");
}

if (!$row = $query->fetch_assoc()) {
    $conn->close();
    require 'includes/footer.php';
    die("Book not found.");
}
?>
<br>
<h2 class="tableHeading">Book Details</h2>
<br>
<table id="bookdetails" class="bookdetails">
    <tr>
        <td class="col1">
            <img src="<?php echo $row['image'] ?>" alt="" style="width: 150px" />
        </td>
        <td class="col2">
            <h4>Title:</h4>
            <h4>Author:</h4>
            <h4>ISBN:</h4>
            <h4>Status:</h4>
            <h4>Price:</h4>
            <h4>Course:</h4>
        </td>
        <td class="col3">
            <p><?php echo $row['title'] ?></p>
            <p><?php echo $row['author'] ?></p>
            <p><?php echo $row['isbn'] ?></p>
            <p><?php echo $row['status'] ?></p>
            <p>$<?php echo $row['price'] ?></p>
            <p><?php echo $row['course'] ?></p>
        </td>
        <td class="col4">
            <a href="addtocart.php?id=<?php echo $row['posting_id'] ?>">
                <img src="www/img/addtocart_button.png" />
            </a>
        </td>
    </tr>
</table>
<script src="www/js/main.js"></script>
<p id="delete-buttons">
    <input type="button" value="  Delete Book  " onclick="confirm_deletion(<?php echo $id ?>)" >
</p>

<?php
require_once ('includes/footer.php');
