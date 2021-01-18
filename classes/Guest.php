<?php
/**
 * Created by PhpStorm.
 * User: Alex, Pavel
 * Date: 3/7/2018
 * Time: 12:55 PM
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * Class Guest.class represents a guest of the St.James Outreach Church
 *
 */
class Guest
{
    protected $_ClientId;
    protected $_firstName;
    protected $_lastName;
    protected $_birthdate;
    protected $_phone;
    protected $_email;
    protected $_ethnicity;
    protected $_street;
    protected $_city;
    protected $_zip;
    protected $_license;
    protected $_pse;
    protected $_water;
    protected $_income;
    protected $_rent;
    protected $_foodStamp;
    protected $_additionalSupport;
    protected $_senior;
    protected $_mental;
    protected $_physical;
    protected $_veteran;
    protected $_homeless;
    protected $_notes;

    /**
     * Guest.class constructor.
     * @param $fname string first name of guest
     * @param $lname string last name of guest
     * @param $birthdate string birthdate of guest
     */
    function __construct($fname, $lname, $birthdate)
    {
        $this->_firstName = $fname;
        $this->_lastName = $lname;
        $this->_birthdate = $birthdate;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getBirthdate()
    {
        return $this->_birthdate;
    }

    /**
     * @param  $birthdate
     */
    public function setBirthdate( $birthdate)
    {
        $this->_birthdate = $birthdate;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getEthnicity()
    {
        return $this->_ethnicity;
    }

    /**
     * @param mixed $ethnicity
     */
    public function setEthnicity($ethnicity)
    {
        $this->_ethnicity = $ethnicity;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->_street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street)
    {
        $this->_street = $street;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->_city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->_city = $city;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->_zip;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->_zip = $zip;
    }

    /**
     * @return mixed
     */
    public function getLicense()
    {
        return $this->_license;
    }

    /**
     * @param mixed $license
     */
    public function setLicense($license)
    {
        $this->_license = $license;
    }

    /**
     * @return mixed
     */
    public function getPse()
    {
        return $this->_pse;
    }

    /**
     * @param mixed $pse
     */
    public function setPse($pse)
    {
        $this->_pse = $pse;
    }

    /**
     * @return mixed
     */
    public function getWater()
    {
        return $this->_water;
    }

    /**
     * @param mixed $water
     */
    public function setWater($water)
    {
        $this->_water = $water;
    }

    /**
     * @return mixed
     */
    public function getIncome()
    {
        return $this->_income;
    }

    /**
     * @param mixed $income
     */
    public function setIncome($income)
    {
        $this->_income = $income;
    }

    /**
     * @return mixed
     */
    public function getRent()
    {
        return $this->_rent;
    }

    /**
     * @param mixed $rent
     */
    public function setRent($rent)
    {
        $this->_rent = $rent;
    }

    /**
     * @return mixed
     */
    public function getFoodStamp()
    {
        return $this->_foodStamp;
    }

    /**
     * @param mixed $foodStamp
     */
    public function setFoodStamp($foodStamp)
    {
        $this->_foodStamp = $foodStamp;
    }

    /**
     * @return mixed
     */
    public function getAdditionalSupport()
    {
        return $this->_additionalSupport;
    }

    /**
     * @param mixed $additionalSupport
     */
    public function setAdditionalSupport($additionalSupport)
    {
        $this->_additionalSupport = $additionalSupport;
    }

    /**
     * @return mixed
     */
    public function getSenior()
    {
        return $this->_senior;
    }

    /**
     * @param mixed $senior
     */
    public function setSenior($senior)
    {
        $this->_senior = $senior;
    }

    /**
     * @return mixed
     */
    public function getMental()
    {
        return $this->_mental;
    }

    /**
     * @param mixed $mental
     */
    public function setMental($mental)
    {
        $this->_mental = $mental;
    }

    /**
     * @return mixed
     */
    public function getPhysical()
    {
        return $this->_physical;
    }

    /**
     * @param mixed $physical
     */
    public function setPhysical($physical)
    {
        $this->_physical = $physical;
    }

    /**
     * @return mixed
     */
    public function getVeteran()
    {
        return $this->_veteran;
    }

    /**
     * @param mixed $veteran
     */
    public function setVeteran($veteran)
    {
        $this->_veteran = $veteran;
    }

    /**
     * @return mixed
     */
    public function getHomeless()
    {
        return $this->_homeless;
    }

    /**
     * @param mixed $homeless
     */
    public function setHomeless($homeless)
    {
        $this->_homeless = $homeless;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->_notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->_notes = $notes;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->_ClientId;
    }

    /**
     * @param mixed $ClientId
     */
    public function setClientId($ClientId)
    {
        $this->_ClientId = $ClientId;
    }


}