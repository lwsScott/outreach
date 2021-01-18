<?php
require "/home/stjamesk/dotcom/creds/creds.php";
include_once "common.php";
// if record is set in the $_GET array, then delete the row
if (isset($_GET['recordId'])) {
    $recordId = $_GET['recordId'];
    // construct a new Common() class
    $common = new Common();
    // delete the row
    $delete = $common->deleteRecordById($conn, $recordId);
    // if delete works, redirect page back to control page
    if ($delete) {
        echo '<script>window.location.href="https://stjameskent.org/outreach/intake/control.php";</script>';
    }
}
