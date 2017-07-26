<?php
/** Author: Daniel Neri
 *  Date: 11-20-2016
 *  Description: This PHP script retrieves a user id from a url querystring.
 *  It then retrieves details of the specified user from the users table in the databate.
 *  At the end, it displays user details in a HTML table.
 */
$page_title = "Users details";

require_once ('includes/header.php');
require_once('includes/database.php');

//retrive user id from a query string
if (!filter_has_var(INPUT_GET, 'id')) {
    echo "Error: user id was not found.";
    require_once ('includes/footer.php');
    exit();
}
$user_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//Select statement
$sql = "SELECT * FROM users WHERE user_id=" . $user_id;

//execute the query
$query = $conn->query($sql);

//retrive results 
$row = $query->fetch_assoc();


//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    //include the footer
    require_once ('includes/footer.php');
    exit;
}
//display results in a table
?>
<br>
<h2 class="tableHeading">User Details</h2>
<br>
<table class="userlist">
    <tr>
        <th>User ID:</th>
        <td><?php echo $row['user_id'] ?></td>
    </tr>
    <tr>
        <th>Username:</th>
        <td><?php echo $row['user_name'] ?></td>
    </tr>
    <tr>
        <th>Full Name:</th>
        <td><?php echo $row['full_name'] ?></td>
    </tr>
    <tr>
        <th>Email Address:</th>
        <td><?php echo $row['user_email'] ?></td>
    </tr>
    <tr>
        <th>Phone Number:</th>
        <td><?php echo $row['user_phone'] ?></td>
    </tr>
</table>

<p>
    <button><a style="text-align: center" href="edituser.php?id=<?php echo $row['user_id'] ?>">Edit</a></button>&nbsp;&nbsp; 
    <button><a href="deleteuser.php?id=<?php echo $row['user_id'] ?>">Delete</a></button>
    <button><a href="userslist.php">Cancel</a></button>
</p>

<?php
// clean up resultsets when we're done with them!
$query->close();

// close the connection.
$conn->close();

//include the footer
require_once ('includes/footer.php');
?>