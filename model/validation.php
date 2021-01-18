<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 3/9/18
 * Time: 12:09 AM
 */

$regex = "/^[a-zA-Z]+[a-zA-Z '-]*[a-zA-Z]+$/";

function validName($name) {
    if(empty($name)){
        return false;
    }
    return preg_match("/^[a-zA-Z]+[a-zA-Z '-]*[a-zA-Z ']+$/", $name);
}

function validBirth($date) {
    if(empty($date)) {
        return true;
    }
    $stringDate = strtotime($date);
    $dateFormat = date('m/d/Y', $stringDate);
    // separate month, day, and year
    $dateExploded = explode('/', $dateFormat);
    // make sure each was found
    if(count($dateExploded) != 3) {
        return false;
    }
    // verify valid date values
    return checkdate($dateExploded[0], $dateExploded[1], $dateExploded[2]);
}

function validPhone($phone) {
    if(empty($phone)){
        return true;
    } else {
        $phone = str_replace(array("(", ")", " ", "-"), "", $phone);
        return (is_numeric($phone) && (strlen($phone) > 9 && (strlen($phone) < 16)));
    }
}

function validZip($zip){
    if(empty($zip)){
        return true;
    }
    return (strlen($zip) == 5) && (is_numeric($zip));
}

function validIncome($income){
    return empty($income) || is_numeric($income);
}

function validRent($rent){
    return empty($rent) || is_numeric($rent);
}

function validfoodstamps($stamps){
    return empty($stamps) || is_numeric($stamps);
}

function validGender($gender){
    return isset($gender);
}

function validAddSupport($support){
    return empty($support) || is_numeric($support);
}
