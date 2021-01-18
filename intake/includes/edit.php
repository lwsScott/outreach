<?php
require("/home/stjamesk/dotcom/creds/creds.php");
// Set the local variables to the values passed through $_POST
$id = $_POST['id'];
$text = $_POST['text'];
// Prevent SQL injection
$text = mysqli_real_escape_string($conn, $text);
// Perform the query to edit the text in the database to the specified row
$query = "UPDATE `outreach_form` SET `Note`='".$text."' WHERE id=".$id;
$success = mysqli_query($conn, $query);
// If unsuccessful, report to the window
if (!$success) {
    echo "$query";
    echo "<br><h4 class='text-center'>Something went wrong...</h4>";
}
