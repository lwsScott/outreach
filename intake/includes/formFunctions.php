<?php
// Validate Assistance
function validAssist($assistance) {
    $validAssistance = array("Utilities", "Rent", "Gas", "Thrift Store", "License or ID", "Food");
    //Check each assistance is valid
    foreach($assistance as $assistanceCheck) {
        if (!in_array($assistanceCheck, $validAssistance)) {
            return false;
        }
    }
    return true;
}

// Validate name
function validName($name) {
    return !empty($name);
}

// Validate Email
function validEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    } else {
        return true;
    }
}

// Validate Phone Number
function validPhone($phone) {
    if(!(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone))) {
        return false;
    }
    else {
        return true;
    }
}

// Validate Zip
function validZip($zip){
    return ($zip =="") OR ($zip == 98030) OR ($zip ==98031) OR ($zip == 98032) OR ($zip == 98042) OR ($zip == 98058);
}


