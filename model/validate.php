<?php
/*
 * Validation Class for dating website
 * provides validation functions
 * 5/30/20
 * filename https://lscott.greenriverdev.com/outreach/model/validate.php
 * @author Lewis Scott
 * @version 1.0
 */

/**
 * Class Validate
 * Contains the validation methods for my app
 * @author Lewis Scott
 * @version 1.0
 */
class Validate
{
    /* Define functions to validate data */
    function validName($name)
    {
        return !empty($name);
    }

    // validate phone number either 10 digits or 3-3-4 digits
    function validPhone($phoneNum)
    {
        //echo $phoneNum;
        return (preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phoneNum) ||
            preg_match("/^[0-9]{10}$/", $phoneNum));
    }

    // validate e-mail using php function
    function validEMail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return false;
        }
        return true;
    }
}