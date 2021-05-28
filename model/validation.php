<?php
/**
 * Created by PhpStorm.
 * User: Pavel
 * Date: 3/9/18
 * Time: 12:09 AM
 */

$regex = "/^[a-zA-Z]+[a-zA-Z '-]*[a-zA-Z]+$/";

/**
 * @param $name
 * @return bool|false|int
 */
function validName($name) {
    if(empty($name)){
        return false;
    }
    return preg_match("/^[a-zA-Z]+[a-zA-Z '-]*[a-zA-Z ']+$/", $name);
}

/**
 * @param $date
 * @return bool
 */
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

/**
 * @param $phone
 * @return bool
 */
function validPhone($phone) {
    if(empty($phone)){
        return true;
    } else {
        $phone = str_replace(array("(", ")", " ", "-"), "", $phone);
        return (is_numeric($phone) && (strlen($phone) > 9 && (strlen($phone) < 16)));
    }
}

/**
 * @param $zip
 * @return bool
 */
function validZip($zip){
    if(empty($zip)){
        return true;
    }
    return (strlen($zip) == 5) && (is_numeric($zip));
}

/**
 * @param $income
 * @return bool
 */
function validIncome($income){
    return empty($income) || is_numeric($income);
}

/**
 * @param $rent
 * @return bool
 */
function validRent($rent){
    return empty($rent) || is_numeric($rent);
}

/**
 * @param $stamps
 * @return bool
 */
function validfoodstamps($stamps){
    return empty($stamps) || is_numeric($stamps);
}

/**
 * @param $gender
 * @return bool
 */
function validGender($gender){
    return isset($gender);
}

/**
 * @param $support
 * @return bool
 */
function validAddSupport($support){
    return empty($support) || is_numeric($support);
}
