<?php
require_once $_SERVER['DOCUMENT_ROOT']."/../config.php";

// if record is set in the $_GET array, then delete the row
if (isset($_GET['recordId'])) {
    $recordId = $_GET['recordId'];
    $query = "DELETE FROM Guests WHERE ClientId='$recordId'";
    $result = $cnxn ->query($query) or die("Error in query3".$cnxn->error);
    // if delete works, redirect page back to control page
    if ($result) {
        //echo '<script>window.location.href="../control.php";</script>';
        echo '<script>window.location.href="../home";</script>';
    }
}
