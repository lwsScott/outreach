<?php

/**
 * Class Controller
 * This class controls the templating access
 * @author David Haas
 * @version 1.0
 * @date 2/5/21
 */
class Controller
{
    private $_f3; //router
    private $_validator; //validation object

    /**
     * Controller constructor.
     * @param $f3
     * @param $validator
     */
    public function __construct($f3, $validator)
    {
        $this->_f3 = $f3;
        $this->_validator = $validator;
    }

    /**
     * Logout the user
     * @param $f3
     */
    public function logout($f3)
    {
        //unsets the session variables
        unset($_SESSION['username']);
        $f3->reroute('/');
    }

    /**
     * View Intake form requests
     * @param $f3
     */
    public function requests($f3)
    {
        //if logged in
        if(empty($_SESSION['username']))
        {
            $f3->reroute('/');
        }
        // date format change
        $dateToday = date("m/d/Y");
        $f3->set('dateToday',$dateToday);


        $database = new Database();
        $database->checkExists();
        $requests = $database->getRequests();

        $f3->set('requests', $requests);

        $template = new Template();
        echo $template->render('views/requests.html');
    }

    /**
     * View Budget page with tasks and budget
     * @param $f3
     */
    public function budget($f3)
    {
        //if logged in
        if(empty($_SESSION['username']))
        {
            $f3->reroute('/');
        }
        // date format change
        $dateToday = date("m/d/Y");
        $f3->set('dateToday',$dateToday);

        $database = new Database();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $valid = true;
            // validate the data and set hive variables
            if (isset($_POST['clientName'])) {
                $clientName = $_POST['clientName'];
            } else {
                $valid = false;
            }
            if (isset($_POST['taskDate'])) {
                $taskDate = $_POST['taskDate'];
            } else {
                $valid = false;
            }
            if (isset($_POST['taskTime'])) {
                $taskTime = $_POST['taskTime'];
            } else {
                $valid = false;
            }
            if (isset($_POST['resource'])) {
                $resourceType = implode(", ", $_POST['resource']);
            } else {
                $valid = false;
            }
            if (isset($_POST['taskAmount'])) {
                $taskAmount = $_POST['taskAmount'];
            } else {
                $valid = false;
            }
            if (isset($_POST['paid'])) {
                $taskAmount = $_POST['paid'];
                $paid = $_POST['paid'];
            } else {
                $paid = 0;
            }
                $userId = $_SESSION['userId'];

            // construct tasks
            if ($valid) {
                $task = new Task($clientName, $taskDate, $taskTime, $resourceType, $taskAmount, $paid);
                $this->_f3->set('task', $task);
                // add the task to the database
                $database->addTask($task);
           }

            // delete the task from the database
            if (isset($_POST['taskID'])) {
                $taskId = $_POST['taskID'];
                $database->deleteTask($taskId);
            }

            // update the amount paid for a task
            if (isset($_POST['paid'])) {
                $taskId = $_POST['taskIDedit'];
                $paid = $_POST['paid'];
                $database->updateTask($taskId, $paid);
                $f3->set('paid', $paid);
            }

            // add the budget to the database
            if (isset($_POST['budget']) && $_POST['budget'] != '') {
                $budget = $_POST['budget'];
                $database->addBudget($budget);

                $estimates = $database->getEstimates();
                $f3->set('estimates',$estimates);
                $f3->set('budget',$budget);
                $bme = $budget - $estimates;
                $bme = number_format($bme, 2, '.', '');

                $f3->set('budgetMinusEstimates', $bme);

                $paid = $database->getPaid();
                $bmp = $budget - $paid;
                $bmp = number_format($bmp, 2, '.', '');
                $f3->set('budgetMinusPaid', $bmp);
            }

            // update the number of thrift vouchers issued
            // and display
            if (isset($_POST['thrift'])) {
                $database->updateThriftVouchers();

                $thriftVouchers = $database->getThriftVouchers();
                $f3->set('thriftVouchers', $thriftVouchers);
            }

            // reset the number of thrift vouchers issued
            // and display
            if (isset($_POST['resetThrift'])) {
                $database->resetThriftVouchers();

                $thriftVouchers = $database->getThriftVouchers();
                $f3->set('thriftVouchers', $thriftVouchers);
            }

            $_POST = array();
        }
        unset($_POST);
        $_POST = array();

        $budget = $database->getBudget();
        $f3->set('budget',$budget);

        $estimates = $database->getEstimates();
        $f3->set('estimates',$estimates);

        $paid = $database->getPaid();
        $f3->set('paid',$paid);

        $bme = $budget - $estimates;
        $bme = number_format($bme, 2, '.', '');
        $f3->set('budgetMinusEstimates', $bme);

        $bmp = $budget - $paid;
        $bmp = number_format($bmp, 2, '.', '');
        $f3->set('budgetMinusPaid', $bmp);

        $result = $database->getTasks();
        $f3->set('result', $result);

        $thriftVouchers = $database->getThriftVouchers();
        $f3->set('thriftVouchers', $thriftVouchers);

        $template = new Template();
        echo $template->render('views/budget.html');
    }

    /**
     * View Archived task page with tasks
     * @param $f3
     */
    public function archived($f3)
    {
        //if logged in
        if(empty($_SESSION['username']))
        {
            $f3->reroute('/');
        }
        // date format change
        $dateToday = date("m/d/Y");
        $f3->set('dateToday',$dateToday);

        $database = new Database();

        $result = $database->getArchivedTasks();
        $f3->set('result', $result);

        $template = new Template();
        echo $template->render('views/archivedTasks.html');
    }

    /**
     * Log the user in
     * @param $f3
     */
    public function login($f3)
    {
        $database = new Database();
        //if submitted login form
        if(isset($_POST['login']))
        {
            $username = $_POST['username'];
            $password = $_POST['password'];

            //checks the database if the credentials are correct
            $user = $database->getUser($username,$password);
            //returns 1 if correct, and nothing if incorrect
            if(!empty($user))
            {
                //sets the session
                $_SESSION['username'] = $username;
                $f3->reroute('/home');
            } else {
                $f3->set('error', 'Incorrect Login');
            }
        }
        $template = new Template();
        echo $template->render('views/login.html');
    }

    /**
     * View the home page
     * @param $f3
     */
    public function home($f3)
    {
        //if logged in
        if(empty($_SESSION['username']))
        {
            $f3->reroute('/');
        }
        $database = new Database();
        $guests = $database->getGuests();

        //Date and Phone Format guestinfo
        for($i = 0; $i < count($guests); $i++)
        {
            // date
            $bday=$guests[$i]['birthdate'];
            $validDate = strtotime($bday);
            $guests[$i]['birthdate'] = date('m/d/Y', $validDate); //newdate

            // phone
            if(strlen($guests[$i]['phone']) > 0) {
                $phone = $guests[$i]['phone'];
                $area = substr($phone,0, 3);
                $first = substr($phone, 3, 3);
                $last = substr($phone,-4);
                $guests[$i]['phone'] = "(" . $area . ") " . $first . "-" . $last;
            }

        }

        $f3->set('guests', $guests);
        $needs = $database->getNeeds();
        //Date Format Guest Needs
        for($i = 0; $i < count($needs); $i++)
        {
            $visitDate= $needs[$i]['visitDate'];
            $validDate = strtotime($visitDate);
            $needs[$i]['visitDate'] = date('m/d/Y', $validDate); //newdate
        }

        $f3->set('needs', $needs);
        $households = $database->getHouseholds();
        $f3->set('households', $households);
        $template = new Template();
        echo $template->render('views/home.html');
    }

    /**
     * View Reports page
     * @param $f3
     */
    public function reports($f3)
    {
        //if logged in
        if (empty($_SESSION['username'])) {
            $f3->reroute('/');
        }
        // initialize variable
        $start = date("m-d-Y");
        $end = date("m-d-Y");
        // set to new value when submitting
        if (isset($_POST['submit'])) {
            if (!empty($_POST['start'])) {
                $start = $_POST['start'];
            }
            if (!empty($_POST['end'])) {
                $end = $_POST['end'];
            }
        }
        $f3->set('start', $start);
        $f3->set('end', $end);
        $database = new Database();
        //setters for the hive
        $needs = $database->getNeeds();

        //Date Format
        for ($i = 0; $i < count($needs); $i++) {
            $visitDate = $needs[$i]['visitDate'];
            //
            $validDate = strtotime($visitDate);
            $needs[$i]['visitDate'] = date('m/d/Y', $validDate); //newdate
        }
        $f3->set('needs', $needs);

        $thrift = $database->getThrift($start, $end);
        $f3->set('thrift', $thrift);
        $gas = $database->getGas($start, $end);
        $f3->set('gas', $gas);
        $water = $database->getWater($start, $end);
        $f3->set('water', $water);
        $energy = $database->getEnergy($start, $end);
        $f3->set('energy', $energy);
        $food = $database->getFood($start, $end);
        $f3->set('food', $food);
        $dol = $database->getDol($start, $end);
        $f3->set('dol', $dol);
        $other = $database->getRent($start, $end);
        $f3->set('rent', $other);
        $other = $database->getOther($start, $end);
        $f3->set('other', $other);
        $total = $database->getTotal($start, $end);
        $f3->set('total', $total);
        $template = new Template();
        echo $template->render('views/reports.html');
    }

    /**
     * Add a new Guest
     * No fields are required fields
     * @param $f3
     */
    public function newGuest($f3)
    {
        //if logged in
        if(empty($_SESSION['username']))
        {
            $f3->reroute('/');
        }
        // date format change
        $dateToday = date("m/d/Y");
        $f3->set('dateToday',$dateToday);

        if(isset($_POST['submit'])){
            //setting variables
            $firstName = $_POST['first'];
            $lastName = $_POST['last'];
            $birthdate = $_POST['birthdate'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $ethnicity = $_POST['ethnicity'];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $zip = $_POST['zip'];
            $mental = $_POST['mental'];
            $physical = $_POST['physical'];
            $senior = $_POST['senior'];
            $veteran = $_POST['veteran'];
            $homeless = $_POST['homeless'];
            $income = $_POST['income'];
            $rent = $_POST['rent'];
            $foodStamp = $_POST['foodStamp'];
            $addSupport = $_POST['addSupport'];
            $license = $_POST['license'];
            $pse = $_POST['pse'];
            $water = $_POST['water'];
            $notes = $_POST['notes'];
            $voucher = $_POST['voucher'];
            $checkNum = $_POST['checkNum'];
            $amount = $_POST['amount'];
            $date = $_POST['date'];
            $resource = $_POST['resource'];
            $name = $_POST['name'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $flag = $_POST['flag'];


            // convert phone format
            $phone = str_replace(array("(", ")", " ", "-"), "", $phone);
            $area = substr($phone,0, 3);
            $first = substr($phone, 3, 3);
            $last = substr($phone,-4);
            $phone = "(" . $area . ") " . $first . "-" . $last;

            //set to hive
            $f3->set('firstName', $firstName);
            $f3->set('lastName', $lastName);
            $f3->set('birthdate', $birthdate);
            $f3->set('phone', $phone);
            $f3->set('email', $email);
            $f3->set('ethnicity', $ethnicity);
            $f3->set('street', $street);
            $f3->set('city', $city);
            $f3->set('zip', $zip);
            $f3->set('mental', $mental);
            $f3->set('physical', $physical);
            $f3->set('senior', $senior);
            $f3->set('veteran', $veteran);
            $f3->set('homeless', $homeless);
            $f3->set('income', $income);
            $f3->set('rent', $rent);
            $f3->set('foodStamp', $foodStamp);
            $f3->set('addSupport', $addSupport);
            $f3->set('license', $license);
            $f3->set('pse', $pse);
            $f3->set('water', $water);
            $f3->set('notes', $notes);
            $f3->set('flag', $flag);

            $mainVouch = array();
            for($i = 0; $i < sizeof($voucher);$i++){
                if(!empty($voucher[$i]) || !empty($resource[$i])) {
                    $temp = array();
                    array_push($temp, $voucher[$i], $checkNum[$i], $amount[$i], $date[$i], $resource[$i]);
                    array_push($mainVouch,$temp);
                }
            }

            $mainMem = array();
            for($i = 0; $i < sizeof($name);$i++){
                if(!empty($name[$i])) {
                    $temp = array();
                    array_push($temp, $name[$i], $age[$i], $gender[$i]);
                    array_push($mainMem,$temp);
                }
            }
            $f3->set('vouchers', $mainVouch);
            $f3->set('members', $mainMem);

            include('model/validation.php');
            $isValid = true;

            if($isValid) {
                $f3->set('formIsSubmited','true');
                //replace values for easier access later
                if($income == null){
                    $income = 0;
                }
                if($rent == null){
                    $rent = 0;
                }
                if($foodStamp == null){
                    $foodStamp = 0;
                }
                if($addSupport == null){
                    $addSupport = 0;
                }
                if($homeless == null){
                    $homeless = 0;
                }
                if($senior == null){
                    $senior = 0;
                }
                if($veteran == null){
                    $veteran = 0;
                }
                if($physical == null){
                    $physical = 0;
                }
                if($mental == null){
                    $mental = 0;
                }

                //setter for the guest object
                $guest = new Guest($firstName,$lastName,$birthdate);
                // strip phone back to all numberic for db
                $phone = str_replace(array("(", ")", " ", "-"), "", $phone);

                //add setters for all variables
                $guest->setPhone($phone);
                $guest->setEmail($email);
                $guest->setEthnicity($ethnicity);
                $guest->setStreet($street);
                $guest->setCity($city);
                $guest->setZip($zip);
                $guest->setMental($mental);
                $guest->setPhysical($physical);
                $guest->setSenior($senior);
                $guest->setVeteran($veteran);
                $guest->setHomeless($homeless);
                $guest->setIncome($income);
                $guest->setRent($rent);
                $guest->setFoodStamp($foodStamp);
                $guest->setAdditionalSupport($addSupport);
                $guest->setLicense($license);
                $guest->setPse($pse);
                $guest->setWater($water);
                $guest->setNotes($notes);
                $guest->setFlag($flag);
                $database = new Database();

                //insert the guest into the database
                $database->insertGuest($guest->getFirstName(),$guest->getLastName(),$guest->getBirthdate(),$guest->getPhone(),
                    $guest->getEmail(),$guest->getEthnicity(),$guest->getStreet(),$guest->getCity(),$guest->getZip(),
                    $guest->getLicense(),$guest->getPse(),$guest->getWater(),$guest->getIncome(),$guest->getRent(),
                    $guest->getFoodStamp(),$guest->getAdditionalSupport(),$guest->getMental(),$guest->getPhysical(), $guest->getSenior(),
                    $guest->getVeteran(),$guest->getHomeless(),$guest->getNotes(),$guest->getFlag());

                $lastId = $database->getLastId();
                $f3->set('lastId', $lastId);

                /*
                // add the guest to the mailing list
                // set the Audience ID for the mailing list to add to
                // this comes from the mailchimp settings
                $list_id = "fb67dfc029";
                $subscriber_hash = md5(strtolower($email));

                if ($email != '') {
                    require_once $_SERVER['DOCUMENT_ROOT'] . "/../config.php";
                    $mailchimp = new \MailchimpMarketing\ApiClient();

                    $mailchimp->setConfig([
                        'apiKey' => DB_API,
                        'server' => 'us1'
                    ]);

                    try {
                        $response = $mailchimp->lists->addListMember($list_id, [
                            "email_address" => "$email",
                            "status" => "subscribed",
                            "merge_fields" => [
                                "FNAME" => "$firstName",
                                "LNAME" => "$lastName"
                            ]
                        ]);
                    } catch (MailchimpMarketing\ApiException $e) {
                        echo $e->getMessage();
                    }

                    // tag the guest as an Outreach Guest
                    try {
                        $mailchimp->lists->updateListMemberTags($list_id, $subscriber_hash, [
                            "tags" => [
                                [
                                    "name" => "Outreach Guest",
                                    "status" => "active"
                                ]
                            ]
                        ]);

                        echo "The return type for this endpoint is null";
                    } catch (MailchimpMarketing\ApiException $e) {
                        echo $e->getMessage();
                    }

                    // tag the guest as a Thrift Shop User if applicable
                    foreach ($resource as $item) {
                        if ($item == "thriftshop") {
                            try {
                                $mailchimp->lists->updateListMemberTags($list_id, $subscriber_hash, [
                                    "tags" => [
                                        [
                                            "name" => "Thrift Shop User",
                                            "status" => "active"
                                        ]
                                    ]
                                ]);

                                echo "The return type for this endpoint is null";
                            } catch (MailchimpMarketing\ApiException $e) {
                                echo $e->getMessage();
                            }
                        }
                    }
                }
*/
                if(!empty($mainVouch)){
                    for($i = 0; $i < sizeof($mainVouch);$i++){
                        $database->insertNeeds($mainVouch[$i][4],$mainVouch[$i][3], $mainVouch[$i][2],$mainVouch[$i][0],$mainVouch[$i][1]);
                    }
                }
                if(!empty($mainMem)) {
                    for ($i = 0; $i < sizeof($mainMem); $i++) {
                        $database->insertHousehold($mainMem[$i][0], $mainMem[$i][1], $mainMem[$i][2]);
                    }
                }
                $f3->reroute('/home');
            }
        }
        $template = new Template();
        echo $template->render('views/newGuest.html');

    }

    /**
     * View a Guest
     * @param $f3
     * @param $params the client id
     * @throws Exception
     */
    public function clientId($f3, $params)
    {
        if(empty($_SESSION['username']))
        {
            $f3->reroute('/');
        }
        $id = $params['client_id'];
        $database = new Database();
        $guest = $database->getGuest($id);
        $mainVouch = array();
        $mainMem = array();
        $tempVouch = $database->getUserNeeds($id);
        $tempMem = $database->getUserHousehold($id);

        for($x = 0; $x < sizeof($tempVouch);$x++){
            if(!empty($tempVouch[$x])) {
                $temp = array();
                array_push($temp, $tempVouch[$x]['voucher'], $tempVouch[$x]['checkNum'], $tempVouch[$x]['amount'], $tempVouch[$x]['visitDate'],$tempVouch[$x]['resource'], $tempVouch[$x]['NeedsId']);
                array_push($mainVouch,$temp);
            }
        }
        $resources = getResources();

        // set the eligibility dates for each type of voucher
        for($x = 0; $x < sizeof($mainVouch);$x++) {

            if (($mainVouch[$x][4]) == "thriftshop") {
                $date = new DateTime($mainVouch[$x][3]);
                $date->add(new DateInterval('P6M'));
                $date = $date->format('m/d/Y');
                $f3->set('ThriftShop', $date);

            } elseif (($mainVouch[$x][4]) == "water") {
                $date = new DateTime($mainVouch[$x][3]);
                $date->add(new DateInterval('P1Y'));
                $date = $date->format('m/d/Y');
                $f3->set('Water', $date);

            } elseif (($mainVouch[$x][4]) == "energybill") {
                $date = new DateTime($mainVouch[$x][3]);
                $date->add(new DateInterval('P1Y'));
                $date = $date->format('m/d/Y');
                $f3->set('EnergyBill', $date);

            } elseif (($mainVouch[$x][4]) == "gas") {
                $date = new DateTime($mainVouch[$x][3]);
                $date->add(new DateInterval('P6M'));
                $date = $date->format('m/d/Y');
                $f3->set('Gas', $date);

            } elseif (($mainVouch[$x][4]) == "rent") {
                $date = new DateTime($mainVouch[$x][3]);
                $date->add(new DateInterval('P1Y'));
                $date = $date->format('m/d/Y');
                $f3->set('Rent', $date);

            } elseif (($mainVouch[$x][4]) == "food") {
                $date = new DateTime($mainVouch[$x][3]);
                $date->add(new DateInterval('P1M'));
                $date = $date->format('m/d/Y');
                $f3->set('Food', $date);
            }
        }

        //sort vouchers by date
        function compareOrder($a, $b)
        {
            return strnatcmp($a[3], $b[3]);
        }
        usort($mainVouch, 'compareOrder');

        for($x = 0; $x < sizeof($tempMem);$x++){
            if(!empty($tempMem[$x])) {
                $temp = array();
                array_push($temp, $tempMem[$x]['name'], $tempMem[$x]['age'], $tempMem[$x]['gender'], $tempMem[$x]['HouseholdId']);
                array_push($mainMem,$temp);
            }
        }

        // convert phone format for display
        $dbPhone = $guest['phone'];
        $area = substr($dbPhone,0, 3);
        $first = substr($dbPhone, 3, 3);
        $last = substr($dbPhone,-4);
        $guest['phone'] = "(" . $area . ") " . $first . "-" . $last;

        $f3->set('firstName', $guest['first']);
        $f3->set('lastName', $guest['last']);
        $f3->set('birthdate', $guest['birthdate']);
        $f3->set('phone', $guest['phone']);
        $f3->set('email', $guest['email']);
        $f3->set('ethnicity', $guest['ethnicity']);
        $f3->set('street', $guest['street']);
        $f3->set('city', $guest['city']);
        $f3->set('zip', $guest['zip']);
        $f3->set('license', $guest['license']);
        $f3->set('pse', $guest['pse']);
        $f3->set('water', $guest['water']);
        $f3->set('income', $guest['income']);
        $f3->set('rent', $guest['rent']);
        $f3->set('foodStamp', $guest['foodStamp']);
        $f3->set('addSupport', $guest['addSupport']);
        $f3->set('mental', $guest['mental']);
        $f3->set('physical', $guest['physical']);
        $f3->set('senior', $guest['senior']);
        $f3->set('veteran', $guest['veteran']);
        $f3->set('homeless', $guest['homeless']);
        $f3->set('members', $guest['members']);
        $f3->set('notes', $guest['notes']);
        $f3->set('vouchers', $mainVouch);
        $f3->set('members', $mainMem);
        $f3->set('flag', $guest['flag']);


        if (isset($_POST['submit'])) {
            $firstName = $_POST['first'];
            $lastName = $_POST['last'];
            $birthdate = $_POST['birthdate'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $ethnicity = $_POST['ethnicity'];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $zip = $_POST['zip'];
            $mental = $_POST['mental'];
            $physical = $_POST['physical'];
            $senior = $_POST['senior'];
            $veteran = $_POST['veteran'];
            $homeless = $_POST['homeless'];
            $income = $_POST['income'];
            $rent = $_POST['rent'];
            $foodStamp = $_POST['foodStamp'];
            $addSupport = $_POST['addSupport'];
            $license = $_POST['license'];
            $pse = $_POST['pse'];
            $water = $_POST['water'];
            $notes = $_POST['notes'];
            $NeedsId = $_POST['needsid'];
            $voucher = $_POST['voucher'];
            $checkNum = $_POST['checkNum'];
            $amount = $_POST['amount'];
            $date = $_POST['date'];
            $resource = $_POST['resource'];
            $household = $_POST['householdid'];
            $name = $_POST['name'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $flag = $_POST['flag'];

            // convert phone format for display
            $phone = str_replace(array("(", ")", " ", "-"), "", $phone);
            $area = substr($phone,0, 3);
            $first = substr($phone, 3, 3);
            $last = substr($phone,-4);
            $phone = "(" . $area . ") " . $first . "-" . $last;

            $f3->set('firstName', $firstName);
            $f3->set('lastName', $lastName);
            $f3->set('birthdate', $birthdate);
            $f3->set('phone', $phone);
            $f3->set('email', $email);
            $f3->set('ethnicity', $ethnicity);
            $f3->set('street', $street);
            $f3->set('city', $city);
            $f3->set('zip', $zip);
            $f3->set('mental', $mental);
            $f3->set('physical', $physical);
            $f3->set('senior', $senior);
            $f3->set('veteran', $veteran);
            $f3->set('homeless', $homeless);
            $f3->set('income', $income);
            $f3->set('rent', $rent);
            $f3->set('foodStamp', $foodStamp);
            $f3->set('addSupport', $addSupport);
            $f3->set('license', $license);
            $f3->set('pse', $pse);
            $f3->set('water', $water);
            $f3->set('notes', $notes);
            $f3->set('flag', $flag);

            $mainVouch = array();
            for($i = 0; $i < sizeof($voucher); $i++){
                if(!empty($voucher[$i]) || !empty($resource[$i]) ) {
                    $temp = array();
                    array_push($temp, $voucher[$i], $checkNum[$i], $amount[$i], $date[$i], $resource[$i], $NeedsId[$i]);
                    array_push($mainVouch, $temp);
                }
            }

            $mainMem = array();
            var_dump($name);
            for($i = 0; $i < sizeof($name); $i++){
                if(!empty($name[$i])) {
                    $temp = array();
                    array_push($temp, $name[$i], $age[$i], $gender[$i], $household[$i]);
                    array_push($mainMem,$temp);
                }
            }
            $f3->set('vouchers', $mainVouch);
            $f3->set('members', $mainMem);

            include('model/validation.php');

            $isValid = true;

            if ($isValid) {
                $f3->set('formIsSubmited','true');
                if($homeless == null){
                    $homeless = 0;
                }
                if($veteran == null){
                    $veteran = 0;
                }
                if($senior == null){
                    $senior = 0;
                }
                if($physical == null){
                    $physical = 0;
                }
                if($mental == null){
                    $mental = 0;
                }
                $guest = new Guest($firstName,$lastName,$birthdate);
                //add setters for all variables
                // strip phone back to just numbers for database
                $phone = str_replace(array("(", ")", " ", "-"), "", $phone);
                $guest->setPhone($phone);
                $guest->setEmail($email);
                $guest->setEthnicity($ethnicity);
                $guest->setStreet($street);
                $guest->setCity($city);
                $guest->setZip($zip);
                $guest->setMental($mental);
                $guest->setPhysical($physical);
                $guest->setSenior($senior);
                $guest->setVeteran($veteran);
                $guest->setHomeless($homeless);
                $guest->setIncome($income);
                $guest->setRent($rent);
                $guest->setFoodStamp($foodStamp);
                $guest->setAdditionalSupport($addSupport);
                $guest->setLicense($license);
                $guest->setPse($pse);
                $guest->setWater($water);
                $guest->setNotes($notes);
                $guest->setFlag($flag);
                $database = new Database();
                $database->editGuest($id,$guest->getFirstName(),$guest->getLastName(),$guest->getBirthdate(),$guest->getPhone(),
                    $guest->getEmail(),$guest->getEthnicity(),$guest->getStreet(),$guest->getCity(),$guest->getZip(),
                    $guest->getLicense(),$guest->getPse(),$guest->getWater(),$guest->getIncome(),$guest->getRent(),
                    $guest->getFoodStamp(),$guest->getAdditionalSupport(),$guest->getMental(),$guest->getPhysical(), $guest->getSenior(),
                    $guest->getVeteran(),$guest->getHomeless(),$guest->getNotes(),$guest->getFlag());

                if(!empty($mainVouch)){
                    for($i = 0; $i < sizeof($mainVouch);$i++){
                        $database->editNeeds($mainVouch[$i][5], $id, $mainVouch[$i][4],$mainVouch[$i][3],$mainVouch[$i][2],$mainVouch[$i][0],$mainVouch[$i][1]);
                    }
                }
                if(!empty($mainMem)){
                    for($i = 0; $i < sizeof($mainMem); $i++){
                        $database->editHousehold($mainMem[$i][3], $id, $mainMem[$i][0], $mainMem[$i][1], $mainMem[$i][2]);
                    }
                }
                $f3->reroute('/home');
            }
        }
        $template = new Template();
        echo $template->render('views/newGuest.html');
    }

    /**
     * View the new Guest form with a potential client
     * from the View Requests page
     * @param $f3
     * @param $params the client to add
     */
    public function requestId($f3, $params)
    {
        if(empty($_SESSION['username']))
        {
            $f3->reroute('/');
        }
        $id = $params['id'];
        $database = new Database();
        $guest = $database->getRequestDetails($id);
        $mainVouch = array();
        $mainMem = array();
        //$tempVouch = $database->getUserNeeds($id);
        //$tempMem = $database->getUserHousehold($id);
        /*
        for($x = 0; $x < sizeof($tempVouch);$x++){
            if(!empty($tempVouch[$x])) {
                $temp = array();
                array_push($temp, $tempVouch[$x]['voucher'], $tempVouch[$x]['checkNum'], $tempVouch[$x]['amount'], $tempVouch[$x]['visitDate'],$tempVouch[$x]['resource'], $tempVouch[$x]['NeedsId']);
                array_push($mainVouch,$temp);
            }
        }
        */
        //sort vouchers by date
        function compareOrder($a, $b)
        {
            return strnatcmp($a[3], $b[3]);
        }
        usort($mainVouch, 'compareOrder');
        /*
        for($x = 0; $x < sizeof($tempMem);$x++){
            if(!empty($tempMem[$x])) {
                $temp = array();
                array_push($temp, $tempMem[$x]['name'], $tempMem[$x]['age'], $tempMem[$x]['gender'], $tempMem[$x]['HouseholdId']);
                array_push($mainMem,$temp);
            }
        }
        */

        // convert phone format for display
        $dbPhone = $guest['phone'];
        $area = substr($dbPhone,0, 3);
        $first = substr($dbPhone, 3, 3);
        $last = substr($dbPhone,-4);
        $guest['phone'] = "(" . $area . ") " . $first . "-" . $last;

        $f3->set('helpList', $guest['HelpList']);
        $f3->set('firstName', $guest['FirstName']);
        $f3->set('lastName', $guest['LastName']);
        $f3->set('phone', $guest['Phone']);
        $f3->set('email', $guest['Email']);
        $f3->set('street', $guest['Address']);
        $f3->set('city', $guest['City']);
        $f3->set('zip', $guest['Zip']);

        $f3->set('vouchers', $mainVouch);

        if (isset($_POST['submit'])) {
            $firstName = $_POST['first'];
            $lastName = $_POST['last'];
            $birthdate = $_POST['birthdate'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $ethnicity = $_POST['ethnicity'];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $zip = $_POST['zip'];
            $mental = $_POST['mental'];
            $physical = $_POST['physical'];
            $senior = $_POST['senior'];
            $veteran = $_POST['veteran'];
            $homeless = $_POST['homeless'];
            $income = $_POST['income'];
            $rent = $_POST['rent'];
            $foodStamp = $_POST['foodStamp'];
            $addSupport = $_POST['addSupport'];
            $license = $_POST['license'];
            $pse = $_POST['pse'];
            $water = $_POST['water'];
            $notes = $_POST['notes'];
            $NeedsId = $_POST['needsid'];
            $voucher = $_POST['voucher'];
            $checkNum = $_POST['checkNum'];
            $amount = $_POST['amount'];
            $date = $_POST['date'];
            $resource = $_POST['resource'];
            $household = $_POST['householdid'];
            $name = $_POST['name'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $flag = $_POST['flag'];

            // convert phone format for display
            $phone = str_replace(array("(", ")", " ", "-"), "", $phone);
            $area = substr($phone,0, 3);
            $first = substr($phone, 3, 3);
            $last = substr($phone,-4);
            $phone = "(" . $area . ") " . $first . "-" . $last;

            $f3->set('firstName', $firstName);
            $f3->set('lastName', $lastName);
            $f3->set('birthdate', $birthdate);
            $f3->set('phone', $phone);
            $f3->set('email', $email);
            $f3->set('ethnicity', $ethnicity);
            $f3->set('street', $street);
            $f3->set('city', $city);
            $f3->set('zip', $zip);
            $f3->set('mental', $mental);
            $f3->set('physical', $physical);
            $f3->set('senior', $senior);
            $f3->set('veteran', $veteran);
            $f3->set('homeless', $homeless);
            $f3->set('income', $income);
            $f3->set('rent', $rent);
            $f3->set('foodStamp', $foodStamp);
            $f3->set('addSupport', $addSupport);
            $f3->set('license', $license);
            $f3->set('pse', $pse);
            $f3->set('water', $water);
            $f3->set('notes', $notes);
            $f3->set('flag', $flag);
            $mainVouch = array();
            for($i = 0; $i < sizeof($voucher); $i++){
                if(!empty($voucher[$i]) || !empty($resource[$i]) ) {
                    $temp = array();
                    array_push($temp, $voucher[$i], $checkNum[$i], $amount[$i], $date[$i], $resource[$i], $NeedsId[$i]);
                    array_push($mainVouch, $temp);
                }
            }

            $mainMem = array();
            for($i = 0; $i < sizeof($name); $i++){
                if(!empty($name[$i])) {
                    $temp = array();
                    array_push($temp, $name[$i], $age[$i], $gender[$i], $household[$i]);
                    array_push($mainMem,$temp);
                }
            }
            $f3->set('vouchers', $mainVouch);
            $f3->set('members', $mainMem);

            include('model/validation.php');

            $isValid = true;

            if ($isValid) {
                $f3->set('formIsSubmited','true');
                if($homeless == null){
                    $homeless = 0;
                }
                if($veteran == null){
                    $veteran = 0;
                }
                if($senior == null){
                    $senior = 0;
                }
                if($physical == null){
                    $physical = 0;
                }
                if($mental == null){
                    $mental = 0;
                }
                $guest = new Guest($firstName,$lastName,$birthdate);
                //add setters for all variables
                // strip phone back to just numbers for database
                $phone = str_replace(array("(", ")", " ", "-"), "", $phone);
                $guest->setPhone($phone);
                $guest->setEmail($email);
                $guest->setEthnicity($ethnicity);
                $guest->setStreet($street);
                $guest->setCity($city);
                $guest->setZip($zip);
                $guest->setMental($mental);
                $guest->setPhysical($physical);
                $guest->setSenior($senior);
                $guest->setVeteran($veteran);
                $guest->setHomeless($homeless);
                $guest->setIncome($income);
                $guest->setRent($rent);
                $guest->setFoodStamp($foodStamp);
                $guest->setAdditionalSupport($addSupport);
                $guest->setLicense($license);
                $guest->setPse($pse);
                $guest->setWater($water);
                $guest->setNotes($notes);
                $guest->setFlag($flag);
                $database = new Database();

                //insert the guest into the database
                $database->insertGuest($guest->getFirstName(),$guest->getLastName(),$guest->getBirthdate(),$guest->getPhone(),
                    $guest->getEmail(),$guest->getEthnicity(),$guest->getStreet(),$guest->getCity(),$guest->getZip(),
                    $guest->getLicense(),$guest->getPse(),$guest->getWater(),$guest->getIncome(),$guest->getRent(),
                    $guest->getFoodStamp(),$guest->getAdditionalSupport(),$guest->getMental(),$guest->getPhysical(), $guest->getSenior(),
                    $guest->getVeteran(),$guest->getHomeless(),$guest->getNotes(),$guest->getFlag());

                $database->markAssistanceComplete($id);

                $lastId = $database->getLastId();
                $f3->set('lastId', $lastId);

                if(!empty($mainVouch)){
                    for($i = 0; $i < sizeof($mainVouch);$i++){
                        $database->insertNeeds($mainVouch[$i][4],$mainVouch[$i][3], $mainVouch[$i][2],$mainVouch[$i][0],$mainVouch[$i][1]);
                    }
                }
                if(!empty($mainMem)) {
                    for ($i = 0; $i < sizeof($mainMem); $i++) {
                        $database->insertHousehold($mainMem[$i][0], $mainMem[$i][1], $mainMem[$i][2]);
                    }
                }
                $f3->reroute('/home');
            }
        }
        $template = new Template();
        echo $template->render('views/newGuest.html');
    }

    /**
     * Provide Reports on demographics
     * @param $f3
     */
    public function demographics($f3)
    {
        if(empty($_SESSION['username']))
        {
            $f3->reroute('/');
        }
        $database = new Database();
        //call to the database and set to variables
        $ethnicity = $database->getEthnicity();
        $gender = $database->getGender();
        $zips = $database->getZips();
        $disabilities = $database->getDisabilities();
        $veterans = $database->getVeterans();
        $seniors = $database->getSeniors();

        $f3->set('ethnicity', $ethnicity);
        $f3->set('gender', $gender);
        $f3->set('zips', $zips);
        $f3->set('disabilities', $disabilities);
        $f3->set('veterans', $veterans);
        $f3->set('seniors', $seniors);
        $template = new Template();
        echo $template->render('views/demographics.html');
    }

    /**
     * Change the password for the outreach administrator
     * @param $f3
     */
    public function profile($f3)
    {
        if(empty($_SESSION['username']))
        {
            $f3->reroute('/');
        }
        if( $_SESSION['username'] != 'petero') {
            $f3->reroute('/home');
        }
        $database = new Database();

        if (isset($_POST['changePassword'])) {

            $username = $_POST['username'];
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];
            $user = $database->getUser($username, $currentPassword);

            // if username and password is correct, it will retrieve it from the database
            if(!empty($user)) {
                // if the passwords match
                if ($newPassword == $confirmPassword) {
                    if (strlen($newPassword) > 7) {
                        $database->changePassword($username, $newPassword);
                        $f3->set('userUpdate', $username);
                        $f3->set('passChanged', true);
                    } else {
                        $f3->set('error', 'Password must be at least 8 characters');
                    }
                } else {
                    $f3->set('error', 'Passwords do not match');
                }
            } else {
                $f3->set('error', 'Password incorrect');
            }
        }

        $template = new Template();
        echo $template->render('views/profile.html');
    }

}