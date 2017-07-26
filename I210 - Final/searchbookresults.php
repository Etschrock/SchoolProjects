<?php
/*
 * Author: Daniel Neri
 * Date: 11-28-2016
 * Name: searchbookresults.php
 * Description: This script searchs for books that match book titles in the database.
 */
$page_title = "Search book results";

require_once ('includes/header.php');
require_once('includes/database.php');

if (filter_has_var(INPUT_GET, "terms")) {
    $terms_str = filter_input(INPUT_GET, 'terms', FILTER_SANITIZE_STRING);
} else {
    echo "There was not search terms found.";
    include ('includes/footer.php');
    exit;
}

//explode the search terms into an array
$terms = explode(" ", $terms_str);

//select statement using pattern search. Multiple terms are concatnated in the loop.
$sql = "SELECT * FROM books, statuses WHERE books.status_id = statuses.status_id AND (0";
foreach ($terms as $term) {
    $sql .= " OR title LIKE '%$term%'";
}
$sql .= ")";

//execute the query
$query = $conn->query($sql);

//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg.";
    $conn->close();
    include ('includes/footer.php');
    exit;
}

echo "<h2>Books: $terms_str</h2>";

//display results in a table
if ($query->num_rows == 0) {
    echo "Your search <i>'$terms_str'</i> did not match any books in our inventory";
    include ('includes/footer.php');
    exit;
}
?>
<table id="booklist" class="booklist">
    <tr>
        <th>Title</th>
        <th class="col2">Author</th>
        <th class="col3">Status</th>
        <th class="col4">Price</th>
    </tr>

    <?php
    //insert a row into the table for each row of data
    while (($row = $query->fetch_assoc()) !== NULL) {
        echo "<tr>";
        echo "<td><a href='bookdetails.php?id=", $row['posting_id'], "'>", $row['title'], "</a></td>";
        echo "<td>", $row['author'], "</td>";
        echo "<td>", $row['status'], "</td>";
        echo "<td>", $row['price'], "</td>";
        echo "</tr>";
    }
    ?>
</table>

<?php
// clean up resultsets when we're done with them!
$query->close();

// close the connection.
$conn->close();

include ('includes/footer.php');
