<?php
// Sets the value in completed to on or off if the user clicks the checkboxes on the rows
require("/home/stjamesk/dotcom/creds/creds.php");
$id = $_POST['id'];
$checked = $_POST['checked'];
// Query to fetch the completed row
$query = "UPDATE `outreach_form` SET `completed`=".$checked." WHERE id=".$id;
$success = mysqli_query($conn, $query);
// If query was unsuccessful, print out an error message
if (!$success) {
    echo "$query";
    echo "<br><h4 class='text-center'>Something went wrong...</h4>";
}
