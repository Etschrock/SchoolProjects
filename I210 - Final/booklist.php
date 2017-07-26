<?php
require('includes/header.php');
require ('includes/database.php');

//SELECT statement
$sql = "SELECT posting_id, title, author, price, status FROM books, statuses WHERE books.status_id = statuses.status_id";


$query = @$conn->query($sql);

if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    require_once ('includes/footer.php');
    exit;
}
?>
<div class="tableContain">
<br>
<h2 class="tableHeading">Book List</h2>
<br>

<table id="bookListTable">
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Status</th>
        <th>Price</th>
    </tr>

    <!-- add PHP code here to list all books from the "books" table -->
    <?php
    while ($row = $query->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a href='bookdetails.php?id=", $row['posting_id'], "'>", $row['title'], "</a></td>";
        echo "<td>", $row['author'], "</td>";
        echo "<td>", $row['status'], "</td>";
        echo "<td>", $row['price'], "</td>";
        echo "</tr>";
    }
    ?>
</table>
</div>

<?php
require 'includes/footer.php';
