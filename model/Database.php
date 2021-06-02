<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 3/9/2018
 * Time: 11:31 AM
 */

require_once $_SERVER['DOCUMENT_ROOT']."/../config.php";

/**
 * Class Database, preforms sql statements to insert/delete/update/view
 */
class Database
{
    protected $dbh;
    public $id;
    /**
     * Database constructor. connects to the database
     */
    function __construct()
    {
        try {
            //Instantiate a database object
            $this->dbh = new PDO(DB_DSN, DB_USERNAME,
                DB_PASSWORD );
            //echo "Connected to database!!!";
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    /**
     * Inserts a new guest into the database
     * @param $first
     * @param $last
     * @param $birthdate
     * @param $phone
     * @param $email
     * @param $ethnicity
     * @param $street
     * @param $city
     * @param $zip
     * @param $license
     * @param $pse
     * @param $water
     * @param $income
     * @param $rent
     * @param $foodStamp
     * @param $addSupport
     * @param $mental
     * @param $physical
     * @param $senior
     * @param $veteran
     * @param $homeless
     * @param $notes
     *  @param $flag
     */
    function insertGuest($first, $last, $birthdate, $phone, $email, $ethnicity, $street, $city, $zip, $license, $pse, $water, $income, $rent, $foodStamp, $addSupport, $mental, $physical, $senior, $veteran, $homeless, $notes, $flag)
    {
        //1. Define the query
        $sql= "INSERT INTO Guests (first, last, birthdate, phone, email, ethnicity, street, city, zip, license, pse, water, income, rent, foodStamp, addSupport, mental, physical, senior, veteran, homeless, notes, flag)
						VALUES (:first, :last,:birthdate, :phone, :email, :ethnicity, :street, :city, :zip, :license, :pse, :water, :income, :rent, :foodStamp, :addSupport, :mental, :physical, :senior, :veteran, :homeless, :notes, :flag)";

        //2. Prepare the statement
        $statement = $this->dbh->prepare($sql);

        //3. Bind parameters
        $statement->bindParam(':first', $first, PDO::PARAM_STR);
        $statement->bindParam(':last', $last, PDO::PARAM_STR);
        $statement->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':ethnicity', $ethnicity, PDO::PARAM_STR);
        $statement->bindParam(':street', $street, PDO::PARAM_STR);
        $statement->bindParam(':city', $city, PDO::PARAM_STR);
        $statement->bindParam(':zip', $zip, PDO::PARAM_STR);
        $statement->bindParam(':license', $license, PDO::PARAM_STR);
        $statement->bindParam(':pse', $pse, PDO::PARAM_STR);
        $statement->bindParam(':water', $water, PDO::PARAM_STR);
        $statement->bindParam(':income', $income, PDO::PARAM_STR);
        $statement->bindParam(':rent', $rent, PDO::PARAM_STR);
        $statement->bindParam(':foodStamp', $foodStamp, PDO::PARAM_STR);
        $statement->bindParam(':addSupport', $addSupport, PDO::PARAM_STR);
        $statement->bindParam(':mental', $mental, PDO::PARAM_STR);
        $statement->bindParam(':physical', $physical, PDO::PARAM_STR);
        $statement->bindParam(':senior', $senior, PDO::PARAM_STR);
        $statement->bindParam(':veteran', $veteran, PDO::PARAM_STR);
        $statement->bindParam(':homeless', $homeless, PDO::PARAM_STR);
        $statement->bindParam(':notes', $notes, PDO::PARAM_STR);
        $statement->bindParam(':flag', $flag, PDO::PARAM_STR);

        //4. Execute the query
        $statement->execute();
        $this->setLastId($this->dbh->lastInsertId());
    }

    /**
     * getter for all the guests in the database
     * @return array of guests
     */
    function getGuests()
    {
        // Define the query
        $sql = "SELECT * FROM Guests ";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * check all the requests in the outreach_form database table
     * @return array of requests
     */
    function checkExists()
    {
        // Define the query
        $sql = "UPDATE outreach_form, Guests SET outreach_form.ClientId = Guests.ClientId WHERE Guests.first = outreach_form.FirstName AND last = outreach_form.LastName;";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getter for all the requests in the outreach_form database table
     * @return array of requests
     */
    function getRequests()
    {
        // Define the query
        $sql = "SELECT * FROM outreach_form ";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getter for all the needs in the database
     * @return array of needs
     */
    function getNeeds()
    {
        // Define the query
        $sql = "SELECT * FROM Guests LEFT JOIN Needs ON  Guests.ClientId = Needs.Guests_ClientId ORDER BY visitDate";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getter for a single guest to edit
     * @param $id, the guest id
     * @return array row, values of the guest
     */
    function getGuest($id)
    {
        // Define the query
        $sql = "SELECT * FROM Guests WHERE ClientID = $id";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * getter for a single guest to edit
     * @param $id, the guest id
     * @return array row, values of the guest
     */
    function getRequestDetails($id)
    {
        // Define the query
        $sql = "SELECT * FROM outreach_form WHERE id = $id";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * getter for a single guest to edit
     * @param $id, the guest id
     * @return array row, values of the guest
     */
    function markAssistanceComplete($id)
    {
        // Define the query
        $sql= "UPDATE outreach_form SET completed=1 WHERE id=$id";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * insert new into the household table/database
     * @param $name
     * @param $age
     * @param $gender
     */
    function insertHousehold($name, $age, $gender){
        $id = $this->getLastId();
        $sql= "INSERT INTO Household (name, age, gender,Guests_ClientId)
                VALUES (:name,:age,:gender,$id)";
        $statement = $this->dbh->prepare($sql);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':age', $age, PDO::PARAM_STR);
        $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
        $statement->execute();
    }

    /**
     * setter for the last id
     * @param $id
     */
    function setLastId($id){
        $this->id = $id;
    }

    /**
     * getter for the last id
     * @return int id
     */
    function getLastId(){
        return $this->id;
    }

    /**
     * insert new needs into the database
     * @param $resource
     * @param $amount
     * @param $voucher
     * @param $checkNum
     */
    function insertNeeds($resource, $date, $amount, $voucher, $checkNum){
        $id = $this->getLastId();
        $sql= "INSERT INTO Needs (resource, visitDate, amount, voucher, checkNum, Guests_ClientId)
                VALUES (:resource, :date , :amount, :voucher, :checkNum, $id)";
        $statement = $this->dbh->prepare($sql);
        $statement->bindParam(':resource', $resource, PDO::PARAM_STR);
        $statement->bindParam(':amount', $amount, PDO::PARAM_STR);
        $statement->bindParam(':voucher', $voucher, PDO::PARAM_STR);
        $statement->bindParam(':checkNum', $checkNum, PDO::PARAM_STR);
        $statement->bindParam(':date', $date, PDO::PARAM_STR);
        $statement->execute();
    }

    /**
     * getter for the households database table
     * @return array of household
     */
    function getHouseholds()
    {
        // Define the query
        $sql = "SELECT * FROM Guests LEFT JOIN Household ON  Guests.ClientId = Household.Guests_ClientId";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the user needs for a guest
     * @param $id the client id
     * @return array the needs
     */
    function getUserNeeds($id){
        $sql = "SELECT * FROM `Needs` WHERE `Guests_ClientId` = $id";
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * get the household members for a guest
     * @param $id the guest id
     * @return array the members
     */
    function getUserHousehold($id){
        $sql = "SELECT * FROM `Household` WHERE `Guests_ClientId` = $id";
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * edit needs, replaces the data if the exists, inserts if new
     * @param $id
     * @param $resource
     * @param $amount
     * @param $voucher
     * @param $checkNum
     * @param $date
     */
    function editNeeds($NeedsId, $GuestId ,$resource, $date, $amount, $voucher, $checkNum){
        if(is_null($NeedsId)){
            $sql= "INSERT INTO Needs (resource, visitDate, amount, voucher, checkNum, Guests_ClientId)
                VALUES (:resource, :date , :amount, :voucher, :checkNum, :Guests_ClientId)";
                $statement = $this->dbh->prepare($sql);
        }
        else{
            $sql= "UPDATE Needs SET resource=:resource, visitDate=:date, amount=:amount, voucher=:voucher, checkNum=:checkNum, Guests_ClientId=:Guests_ClientId WHERE NeedsId=:NeedsId";
            
            $statement = $this->dbh->prepare($sql);
            $statement->bindParam(':NeedsId', $NeedsId, PDO::PARAM_INT);
        }
        
        $statement->bindParam(':Guests_ClientId', $GuestId, PDO::PARAM_STR);
        $statement->bindParam(':resource', $resource, PDO::PARAM_STR);
        $statement->bindParam(':amount', $amount, PDO::PARAM_STR);
        $statement->bindParam(':voucher', $voucher, PDO::PARAM_STR);
        $statement->bindParam(':checkNum', $checkNum, PDO::PARAM_STR);
        $statement->bindParam(':date', $date, PDO::PARAM_STR);

        $statement->execute();
    }
    /**
     * edit households,  replaces the data if the exists, inserts if new
     * @param $id
     * @param $name
     * @param $age
     * @param $gender
     */
    function editHousehold($householdId, $id, $name, $age, $gender){

        if(is_null($householdId)){
            $sql= "INSERT INTO Household (name, age, gender, Guests_ClientId)
                    VALUES (:name, :age, :gender, :Guests_ClientId)";
            $statement = $this->dbh->prepare($sql);
        }
        else{
            $sql= "UPDATE Household SET name=:name, age=:age, gender=:gender, Guests_ClientId=:Guests_ClientId WHERE HouseholdId=:HouseholdId";
            
            $statement = $this->dbh->prepare($sql);
            $statement->bindParam(':HouseholdId', $householdId, PDO::PARAM_INT);
        }
        $statement->bindParam(':Guests_ClientId', $id, PDO::PARAM_INT);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':age', $age, PDO::PARAM_STR);
        $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
        $statement->execute();
    }
    /**
     * edit guest,  replaces the data if the exists, inserts if new
     * @param $id
     * @param $first
     * @param $last
     * @param $birthdate
     * @param $phone
     * @param $email
     * @param $ethnicity
     * @param $street
     * @param $city
     * @param $zip
     * @param $license
     * @param $pse
     * @param $water
     * @param $income
     * @param $rent
     * @param $foodStamp
     * @param $addSupport
     * @param $mental
     * @param $physical
     * @param $senior
     * @param $veteran
     * @param $homeless
     * @param $notes
     * @param $flag
     */
    function editGuest($id, $first, $last, $birthdate, $phone, $email, $ethnicity, $street, $city, $zip, $license,
                       $pse, $water, $income, $rent, $foodStamp, $addSupport, $mental, $physical, $senior, $veteran, $homeless, $notes, $flag){
        $sql= "UPDATE Guests SET first=:first, last=:last, birthdate=:birthdate, phone=:phone, email=:email, ethnicity=:ethnicity,
                  street=:street, city=:city, zip=:zip, license=:license, pse=:pse, water=:water, income=:income, rent=:rent,
                  foodStamp=:foodStamp, addSupport=:addSupport, mental=:mental, physical=:physical, senior=:senior, veteran=:veteran,
                  homeless=:homeless, notes=:notes, flag=:flag WHERE ClientId=:ClientId";
        $statement = $this->dbh->prepare($sql);
        //3. Bind parameters
        $statement->bindParam(':ClientId', $id, PDO::PARAM_INT);
        $statement->bindParam(':first', $first, PDO::PARAM_STR);
        $statement->bindParam(':last', $last, PDO::PARAM_STR);
        $statement->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':ethnicity', $ethnicity, PDO::PARAM_STR);
        $statement->bindParam(':street', $street, PDO::PARAM_STR);
        $statement->bindParam(':city', $city, PDO::PARAM_STR);
        $statement->bindParam(':zip', $zip, PDO::PARAM_STR);
        $statement->bindParam(':license', $license, PDO::PARAM_STR);
        $statement->bindParam(':pse', $pse, PDO::PARAM_STR);
        $statement->bindParam(':water', $water, PDO::PARAM_STR);
        $statement->bindParam(':income', $income, PDO::PARAM_STR);
        $statement->bindParam(':rent', $rent, PDO::PARAM_STR);
        $statement->bindParam(':foodStamp', $foodStamp, PDO::PARAM_STR);
        $statement->bindParam(':addSupport', $addSupport, PDO::PARAM_STR);
        $statement->bindParam(':mental', $mental, PDO::PARAM_STR);
        $statement->bindParam(':physical', $physical, PDO::PARAM_STR);
        $statement->bindParam(':senior', $senior, PDO::PARAM_STR);
        $statement->bindParam(':veteran', $veteran, PDO::PARAM_STR);
        $statement->bindParam(':homeless', $homeless, PDO::PARAM_STR);
        $statement->bindParam(':notes', $notes, PDO::PARAM_STR);
        $statement->bindParam(':flag', $flag, PDO::PARAM_STR);
        //4. Execute the query
        $statement->execute();
    }

    /**
     * getter method for thrift values
     * @param $start
     * @param $end
     * @return array
     */
    function getThrift($start, $end)
    {
        // Define the query
        $sql = "SELECT COUNT(amount), SUM(amount) FROM Needs
                        LEFT JOIN Guests ON Needs.Guests_ClientId = Guests.ClientId
                        WHERE visitDate BETWEEN '$start' AND '$end'
                        AND resource = 'thriftshop' AND hidden != 'y'";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        //echo"<pre>";var_dump($row);echo"</pre>";
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getter for the gas values
     * @param $start
     * @param $end
     * @return array
     */
    function getGas($start, $end)
    {
        // Define the query
        $sql = "SELECT COUNT(amount), SUM(amount) FROM Needs
                        LEFT JOIN Guests ON Needs.Guests_ClientId = Guests.ClientId
                        WHERE visitDate BETWEEN '$start' AND '$end'
                        AND resource = 'gas' AND hidden != 'y'";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        //echo"<pre>";var_dump($row);echo"</pre>";
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getter for the water values
     * @param $start
     * @param $end
     * @return array
     */
    function getWater($start, $end)
    {
        // Define the query
        $sql = "SELECT COUNT(amount), SUM(amount) FROM Needs
                        LEFT JOIN Guests ON Needs.Guests_ClientId = Guests.ClientId
                        WHERE visitDate BETWEEN '$start' AND '$end'
                        AND resource = 'water' AND hidden != 'y'";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        //echo"<pre>";var_dump($row);echo"</pre>";
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getter for the energy values
     * @param $start
     * @param $end
     * @return array
     */
    function getEnergy($start, $end)
    {
        // Define the query
        $sql = "SELECT COUNT(amount), SUM(amount) FROM Needs
                        LEFT JOIN Guests ON Needs.Guests_ClientId = Guests.ClientId
                        WHERE visitDate BETWEEN '$start' AND '$end'
                        AND resource = 'energybill' AND hidden != 'y'";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        //echo"<pre>";var_dump($row);echo"</pre>";
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getter for the food values
     * @param $start
     * @param $end
     * @return array
     */
    function getFood($start, $end)
    {
        // Define the query
        $sql = "SELECT COUNT(amount), SUM(amount) FROM Needs
                        LEFT JOIN Guests ON Needs.Guests_ClientId = Guests.ClientId
                        WHERE visitDate BETWEEN '$start' AND '$end'
                        AND resource = 'food' AND hidden != 'y'";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        //echo"<pre>";var_dump($row);echo"</pre>";
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getter for the dol values
     * @param $start
     * @param $end
     * @return array
     */
    function getDol($start, $end)
    {
        // Define the query
        $sql = "SELECT COUNT(amount), SUM(amount) FROM Needs
                        LEFT JOIN Guests ON Needs.Guests_ClientId = Guests.ClientId
                        WHERE visitDate BETWEEN '$start' AND '$end'
                        AND resource = 'dol' AND hidden != 'y'";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        //echo"<pre>";var_dump($row);echo"</pre>";
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getter for the other values
     * @param $start
     * @param $end
     * @return array
     */
    function getOther($start, $end)
    {
        // Define the query
        $sql = "SELECT COUNT(amount), SUM(amount) FROM Needs
                        LEFT JOIN Guests ON Needs.Guests_ClientId = Guests.ClientId
                        WHERE visitDate BETWEEN '$start' AND '$end'
                        AND resource = 'other' AND hidden != 'y'";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        //echo"<pre>";var_dump($row);echo"</pre>";
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getter for the other values
     * @param $start
     * @param $end
     * @return array
     */
    function getRent($start, $end)
    {
        // Define the query
        $sql = "SELECT COUNT(amount), SUM(amount) FROM Needs
                        LEFT JOIN Guests ON Needs.Guests_ClientId = Guests.ClientId
                        WHERE visitDate BETWEEN '$start' AND '$end'
                        AND resource = 'rent' AND hidden != 'y'";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        //echo"<pre>";var_dump($row);echo"</pre>";
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getter fo the total values
     * @param $start
     * @param $end
     * @return array
     */
    function getTotal($start, $end)
    {
        // Define the query
        $sql = "SELECT COUNT(amount), SUM(amount) FROM Needs
                        LEFT JOIN Guests ON Needs.Guests_ClientId = Guests.ClientId
                        WHERE visitDate BETWEEN '$start' AND '$end' AND hidden != 'y'";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        //echo"<pre>";var_dump($row);echo"</pre>";
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * returns user by the username
     * @param $username
     * @return bool
     */
    function getUser($username, $password)
    {
        $password = sha1($password);
        //Query the db
        $sql = "SELECT * FROM Users
                    WHERE username = :username AND password = :password";
        $statement = $this->dbh->prepare($sql);

        $statement->bindParam(":username", $username, PDO::PARAM_STR);
        $statement->bindParam(":password", $password, PDO::PARAM_STR);
        // Execute the statement
        $statement->execute();

        // Process the result
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * change password for the user
     * @param $username
     * @param $newPassword
     */
    function changePassword($username, $newPassword) {

        // encrypt password
        $newPassword = sha1($newPassword);

        $dbh = $this->dbh;
        // define the query
        $sql = "UPDATE Users
            SET password = :password
            WHERE username = :username";

        // Prepare the statement
        $statement = $dbh->prepare($sql);
        $statement->bindParam(":username", $username, PDO::PARAM_STR);
        $statement->bindParam(":password", $newPassword, PDO::PARAM_STR);

        // Execute the statement
        $statement->execute();
    }

    // make a temporary route to run this to add new users to the database

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    function newUser($username, $password) {
        $password = sha1($password);
        $dbh = $this->dbh;
        $sql = "INSERT INTO Users (username, password)
                VALUES (:username, :password)";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(":username", $username, 2);
        $statement->bindParam(":password", $password, 2);

        return $statement->execute();
    }

    /**
     * getter for the ethnicity
     * @return array
     */
    function getEthnicity()
    {
        // Define the query
        $sql = "select 'White' as Label, count(ethnicity) as Value from Guests 
					where ethnicity= 'white' AND hidden != 'y'
					union (
					select 'African (Native)' as Label, count(ethnicity) as Value from Guests 
					where ethnicity= 'african (native)' AND hidden != 'y')
                    union (
					select 'African American' as Label, count(ethnicity) as Value from Guests 
					where ethnicity= 'african american' AND hidden != 'y')
					union (
					select 'Latinx' as Label, count(ethnicity) as Value from Guests 
					where ethnicity= 'latinx' AND hidden != 'y')
					union (
					select 'Indigenous' as Label, count(ethnicity) as Value from Guests 
					where ethnicity= 'indigenous' AND hidden != 'y')
					union (
					select 'Asian' as Label, count(ethnicity) as Value from Guests 
					where ethnicity= 'asian' AND hidden != 'y')
					union (
					select 'Pacific Islander' as Label, count(ethnicity) as Value from Guests 
					where ethnicity= 'pacific islander' AND hidden != 'y')
					union (
					select 'Mixed' as Label, count(ethnicity) as Value from Guests 
					where ethnicity= 'mixed' AND hidden != 'y')
					union (
					select 'Not Provided' as Label, count(ethnicity) as Value from Guests 
					where (ethnicity= 'Prefer not to answer' AND hidden != 'y') OR (ethnicity = ''  AND hidden != 'y') )
					union (
					select 'Other' as Label, count(ethnicity) as Value from Guests 
					where ethnicity= 'other' AND hidden != 'y')";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        //echo"<pre>";var_dump($row);echo"</pre>";
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getter for the gender information
     * @return array
     */
    function getGender()
    {
        // Define the query
        $sql = "select 'Male' as Label, count(gender) as Value from Household
                    LEFT JOIN Guests ON Household.Guests_ClientId = Guests.ClientId
                    where gender= 'male' AND hidden != 'y'
					union (
					    select 'Female' as Label, count(gender) as Value from Household
					    LEFT JOIN Guests ON Household.Guests_ClientId = Guests.ClientId
                        where gender= 'female' AND hidden != 'y')	
                    union (
					    select 'Not Provided' as Label, count(gender) as Value from Household
					    LEFT JOIN Guests ON Household.Guests_ClientId = Guests.ClientId
                        where (gender= 'Prefer not to answer' AND hidden != 'y') OR (gender= '' AND hidden != 'y'))
                    union (
					    select 'Other' as Label, count(gender) as Value from Household
					    LEFT JOIN Guests ON Household.Guests_ClientId = Guests.ClientId
					    where (gender= 'other' AND hidden != 'y') OR (gender= 'Other' AND hidden != 'y'))";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        //echo"<pre>";var_dump($row);echo"</pre>";
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getter for the zip data
     * @return array
     */
    function getZips()
    {
        // Define the query
        $sql = "select '98058' as Label, count(zip) as Value from Guests 
					where zip= '98058' AND hidden != 'y' AND homeless != 'on'
					union (
					select '98042' as Label, count(zip) as Value from Guests 
					where zip= '98042' AND hidden != 'y' AND homeless != 'on')
					union (
					select '98032' as Label, count(zip) as Value from Guests 
					where zip= '98032' AND hidden != 'y' AND homeless != 'on') 
					union (
					select '98031' as Label, count(zip) as Value from Guests 
					where zip= '98031' AND hidden != 'y' AND homeless != 'on') 
					union (
					select '98030' as Label, count(zip) as Value from Guests 
					where zip= '98030' AND hidden != 'y' AND homeless != 'on')
					union (
					select 'Other' as Label, count(zip) as Value from Guests 
					where zip NOT IN ('98030', '98058', '98042', '98032', '98031') AND hidden != 'y' AND homeless != 'on')
					union (
					select 'Homeless' as Label, count(homeless) as Value from Guests 
					where homeless = 'on' AND hidden != 'y')";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        //echo"<pre>";var_dump($row);echo"</pre>";
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getter for the disabilities data
     * @return array
     */
    function getDisabilities()
    {
        // Define the query
        $sql = "select 'Mental' as Label, count(mental) as Value from Guests 
					where mental= 'on' AND hidden != 'y' AND physical != 'on'
					union (
					select 'Physical' as Label, count(physical) as Value from Guests 
					where physical= 'on' AND hidden != 'y' AND mental != 'on') 
					union (
					select 'Both' as Label, count(physical) as Value from Guests 
					where physical= 'on' AND mental = 'on' AND hidden != 'y')
					union (
					select 'Neither' as Label, count(physical) as Value from Guests 
					where physical = '0' AND mental = '0' AND hidden != 'y')";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        //echo"<pre>";var_dump($row);echo"</pre>";
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getter for the veterans data
     * @return array
     */
    function getVeterans()
    {
        // Define the query
        $sql = "select 'Veteran' as Label, count(veteran) as Value from Guests 
					where veteran= 'on' AND hidden != 'y'
					union (
					select 'Non-veteran' as Label, count(veteran) as Value from Guests 
					where veteran = '0' AND hidden != 'y')";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        //echo"<pre>";var_dump($row);echo"</pre>";
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getter for the veterans data
     * @return array
     */
    function getSeniors()
    {
        // Define the query
        $sql = "select 'Senior' as Label, count(senior) as Value from Guests 
					where senior= 'on' AND hidden != 'y'
					union (
					select 'Non-Senior' as Label, count(senior) as Value from Guests 
					where senior = '0' AND hidden != 'y')";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        //echo"<pre>";var_dump($row);echo"</pre>";
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Inserts strategy into the database
     * @param $tactic the tactic to add
     * @param $chooseTactic which tactic to add
     * @param $change the update or add
     */
    function addTask($task)
    {
        $clientName = $task->getClient();
        $taskDate = $task->getDate();
        $taskTime = $task->getTime();
        $resourceType = $task->getAssistance();
        $taskAmount = $task->getAmount();
        $paid = $task->getPaid();
        $userId = $_SESSION['userId'];
        //1. Define the query
        $sql = "INSERT INTO tasks(clientName, taskDate, taskTime, resourceType, taskAmount, paid)
                    VALUES (:clientName, :taskDate, :taskTime, :resourceType, :taskAmount, :paid)";

        //2. Prepare the statement
        $statement = $this->dbh->prepare($sql);
        //3. Bind the parameters
        $statement->bindParam(':clientName',$clientName, PDO::PARAM_STR);
        $statement->bindParam(':taskDate',$taskDate, PDO::PARAM_STR);
        $statement->bindParam(':taskTime',$taskTime, PDO::PARAM_STR);
        $statement->bindParam(':resourceType',$resourceType, PDO::PARAM_STR);
        $statement->bindParam(':taskAmount',$taskAmount, PDO::PARAM_STR);
        $statement->bindParam(':paid',$paid, PDO::PARAM_STR);

        //4. Execute the statement
        $result = $statement->execute();
        //echo "Result: " . $result;
        //Get the key of the last inserted row
        $taskId = $this->dbh->lastInsertId();
        $_SESSION['taskId'] = $taskId;
        //echo $id;
    }


    /**
     * Return the user's tasks
     * @return array the tasks
     */
    function getTasks()
    {
        $taskArchived = 0;
        // Define the query
        $sql = "SELECT * FROM tasks WHERE archived = $taskArchived";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Return the user's tasks
     * @return array the tasks
     */
    function getArchivedTasks()
    {
        $taskArchived = 1;
        // Define the query
        $sql = "SELECT * FROM tasks WHERE archived = $taskArchived";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Archive a task
     * @param $taskId the task id
     */
    function deleteTask($taskId)
    {
        //1. Define the query
        //$sql = "DELETE FROM tasks
        //WHERE taskID = $taskId";
        $sql= "UPDATE tasks SET archived=1 WHERE taskID=$taskId";
        //2. Prepare the statement
        $statement = $this->dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':userId', $userId);

        //4. Execute the statement
        $statement->execute();

    }


    /**
     * Update a task to set amount paid
     * @param $taskId the task id
     * @param $paid the amount
     */
    function updateTask($taskId, $paid)
    {
        //1. Define the query
        $sql = "UPDATE tasks
        SET paid = $paid WHERE taskID = $taskId";
        //2. Prepare the statement
        $statement = $this->dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the statement
        $statement->execute();

    }

    /**
     * Update the budget amount
     * @param $budget the amount
     */
    function addBudget($budget)
    {
        //1. Define the query
        $sql = "UPDATE budget SET budget = $budget";

        //2. Prepare the statement
        $statement = $this->dbh->prepare($sql);
        //3. Bind the parameters
        $statement->bindParam(':budget',$budget, PDO::PARAM_STR);

        //4. Execute the statement
        $result = $statement->execute();
        //echo "Result: " . $result;
        //Get the key of the last inserted row
        $taskId = $this->dbh->lastInsertId();
        $_SESSION['taskId'] = $taskId;
        //echo $id;
    }

    /**
     * @return mixed
     */
    function getBudget()
    {
        //1. Define the query
        $sql = "SELECT budget FROM budget";

        //2. Prepare the statement
        $statement = $this->dbh->prepare($sql);
        //3. Bind the parameters

        //4. Execute the statement
        $result = $statement->execute();
        //echo "Result: " . $result;

        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        $budget = $row[0]['budget'];
        return $budget;
        //Get the key of the last inserted row
        $taskId = $this->dbh->lastInsertId();
    }

    /**
     * Sums the estimates of the weekly tasks
     */
    function getEstimates()
    {
        //1. Define the query
        $sql = "SELECT SUM(taskAmount) AS value_sum FROM tasks";

        //2. Prepare the statement
        $statement = $this->dbh->prepare($sql);
        //3. Bind the parameters

        //4. Execute the statement
        $result = $statement->execute();
        //echo "Result: " . $result;
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        $sum = $row[0]['value_sum'];
        return $sum;
    }

    /**
     * Sums the estimates of the weekly tasks
     */
    function getPaid()
    {
        //1. Define the query
        $sql = "SELECT SUM(paid) AS value_sum FROM tasks";

        //2. Prepare the statement
        $statement = $this->dbh->prepare($sql);
        //3. Bind the parameters

        //4. Execute the statement
        $result = $statement->execute();
        //echo "Result: " . $result;
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        $sum = $row[0]['value_sum'];
        return $sum;
    }

    /*
    * Update thrift vouchers issued
    */
    function updateThriftVouchers()
    {
        //1. Define the query
        $sql = "UPDATE budget SET thriftVoucher = thriftVoucher + 1";

        //2. Prepare the statement
        $statement = $this->dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the statement
        $statement->execute();
    }

    /*
    * Reset thrift vouchers issued
    */
    function resetThriftVouchers()
    {
        //1. Define the query
        $sql = "UPDATE budget SET thriftVoucher = 0";

        //2. Prepare the statement
        $statement = $this->dbh->prepare($sql);

        //3. Bind the parameters

        //4. Execute the statement
        $statement->execute();
    }

    /**
     * @return mixed
     */
    function getThriftVouchers()
    {
        //1. Define the query
        $sql = "SELECT thriftVoucher FROM budget";

        //2. Prepare the statement
        $statement = $this->dbh->prepare($sql);
        //3. Bind the parameters

        //4. Execute the statement
        $result = $statement->execute();
        //echo "Result: " . $result;

        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        $thrift = $row[0]['thriftVoucher'];
        return $thrift;
        //Get the key of the last inserted row
        $taskId = $this->dbh->lastInsertId();
    }

}