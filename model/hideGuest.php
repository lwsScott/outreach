<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/../config.php";

    try {
        // instantiate a PDO object
        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }

    // Define the query
    $sql = "UPDATE Guests
            SET hidden = 'y'
            WHERE ClientId = :id";

    // Prepare the statement
    $statement = $dbh->prepare($sql);

    // Bind the parameters
    $statement->bindParam(':id', $_POST['id'], PDO::PARAM_INT);

    //execute the query
    $statement->execute();