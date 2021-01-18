<?php
// Return the value of teh completed row to determine if the row should be checked
require("/home/stjamesk/dotcom/creds/creds.php");
$id = $_POST['id'];
$query = "SELECT completed FROM `outreach_form` WHERE id=".$id;
$success = mysqli_query($conn, $query);
// If not successful, echo out an error message
if (!$success) {
    echo "$query";
    echo "<br><h4 class='text-center'>Something went wrong...</h4>";
// Else echo out the fetched value for the completed row
} else {
    $row = $success->fetch_assoc();
    echo $row['completed'];
}