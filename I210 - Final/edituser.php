<?php
/** Author: Daniel Neri
 *  Date: 11-20-2016
 *  Description: This PHP script retrieves a user id from a url querystring.
 *  It then retrieves details of the specified user from the users table in the databate.
 *  At the end, it displays user details in a HTML table.
 */
$page_title = "Edit user details";

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
<h2 class="bookListTable">Edit User Details</h2>
<br>
<form name="edituser" action="updateuser.php" method="get">
    <table class="userdetails">
        <tr>
            <th>User ID</th>
            <td><input name="user_id" value="<?php echo $row['user_id'] ?>" readonly="readonly" /></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><input name="user_name" value="<?php echo $row['user_name'] ?>" size="30" required /></td>
        </tr>
        <tr>
            <th>Full Name</th>
            <td><input name="full_name" value="<?php echo $row['full_name'] ?>" size="30" required /></td>
        </tr>
        <tr>
            <th>Email Address</th>
            <td><input type="email" name="user_email" value="<?php echo $row['user_email'] ?>" size="40" required /></td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td><input type="text" name="phone" value="<?php echo $row['user_phone'] ?>" required /></td>
        </tr>    
    </table>
</form>

<p>
    <br />
    <button><a href="javascript:document.edituser.submit()">Update</a></button>&nbsp;&nbsp;
    <button><a href="userdetails.php?id=<?php echo $row['user_id'] ?>">Cancel</a></button>
</p>

<?php
// clean up resultsets when we're done with them!
$query->close();

// close the connection.
$conn->close();

//include the footer
require_once ('includes/footer.php');
?>