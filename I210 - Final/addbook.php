<?php
/*
 * Author: Daniel Neri
 * Date: 11-19-2016
 * File: addbook.php
 * Description: This script displays a form to accept a new book's details.
 * 
 */
$page_title = "IUPUI Student's Books Nook Add Book";
require_once 'includes/header.php';
?>
<br>
<h2 class="tableHeading">Add New Book</h2>
<br>
<form action="insertbook.php" method="post">
    <table id="addBookTable">
        <tr>
            <td style="text-align: left; width: 100px" class="tableHeader">Title: </td>
            <td><input name="title" type="text" size="50" required /></td>
        </tr>
        <tr>
            <td style="text-align: left" class="tableHeader">Author: </td>
            <td><input name="author" type="text" size="50" required /></td>
        </tr>
        <tr>
            <td style="text-align: left" class="tableHeader">Status:</td>
            <td>
                <select name="status">
                    <option value="1">For Sale</option>
                    <option value="2">Free</option>
                    <option value="3">Lending</option>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align: left" class="tableHeader">ISBN: </td>
            <td><input name="isbn" type="number" size="50" required /></td>
        </tr>
        <!--<tr>
            <td style="text-align: right">Publish date: </td>
            <td>
                <input name="publish_date" type="text" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required />
                <span style="font-size: small">YYYY-MM-DD</span>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">Publisher:</td>
            <td><input name="publisher" type="text" required /></td>
        </tr>-->
        <tr>
            <td style="text-align: left" class="tableHeader">Price*: </td>
            <td><input name="price" type="text" size="40" required />  *If free or lending type N/A</td>
        </tr>
        <tr>
            <td style="text-align: left" class="tableHeader">Image: </td>
            <td><input name="image" type="text" size="50" required /></td>
        </tr>
        <tr>
            <td style="text-align: left" class="tableHeader">Course: </td>
            <td><input name="course" type="text" size="50" required /></td>
        </tr>
       <!-- <tr>
            <td style="text-align: right; vertical-align: top">Description:</td>
            <td><textarea name="description" rows="6" cols="65"></textarea></td>
        </tr>-->
    </table>
    <div class="bookstore-button">
        <input type="submit" value="Add Book" />
        <input type="button" value="Cancel" onclick="window.location.href = 'booklist.php'" />
    </div>
</form>

<?php
require_once 'includes/footer.php';
