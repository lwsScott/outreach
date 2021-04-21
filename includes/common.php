<?php
require_once $_SERVER['DOCUMENT_ROOT']."/../config.php";
// This class is able to display all records and delete individual ones
class Common
{
    // this function returns all the records
    public function getAllRecords($conn) {
        $query = "SELECT * FROM Guests";
        $result = $conn->query($query) or die("Error in query1".$conn->error);
        return $result;
    }

    // this function deletes a record by id and removes any associated images
    public function deleteRecordById($conn,$recordId) {
        $query = "DELETE FROM Guests WHERE id='$recordId'";
        $result = $conn->query($query) or die("Error in query3".$conn->error);
        return $result;
    }
}