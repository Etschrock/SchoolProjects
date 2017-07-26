<?php
/*
 * Author: Daniel Neri
 * Date: 11-28-2016
 * Name: searchbooks.php
 * Description: This script displays a search form.
 */
$page_title = "Search book";

include ('includes/header.php');
?>
<br>
<h2 class="tableHeading">Search Books by Title</h2>
<br>
<p>Enter one or more words in book title.</p><br> 
<form action="searchbookresults.php" method="get">
    <input type="text" name="terms" size="40" required />&nbsp;&nbsp;
    <input type="submit" name="Submit" id="Submit" value="Search Book" />
</form>
<?php
include ('includes/footer.php');
