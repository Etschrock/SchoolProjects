<?php
require('includes/header.php');
require ('includes/database.php');

$sql = "select * from users";

$query = $conn->query($sql);

if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    require_once ('includes/footer.php');
    exit;
}
?>
<br>
<h2>User List</h2>
<br>

<table>
    <tr>
        <th>User ID</th>
        <th>Username</th>
        <th>Full Name</th>
        <th>Email Address</th>
        <th>User Phone Number</th>
    </tr>

    <?php
    //populates a table with the records
    while (($row = $query->fetch_assoc()) !== NULL) {
        echo "<tr>";
        echo "<td>", $row['user_id'], "</td>";
        echo "<td>", $row['user_name'], "</td>";
        echo "<td>", $row['full_name'], "</td>";
        echo "<td>", $row['user_email'], "</td>";
        echo "<td>", $row['user_phone'], "</td>";
        echo "</tr>";
    }
    ?>
</table>

<?php
require ('includes/footer.php');
?>
