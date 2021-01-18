<?php
/**
 * Created by PhpStorm.
 * User: Pavel, Alex
 * Date: 3/14/18
 * Time: 12:40 PM
 */

/**
 * Class Household.class represents the households from a guest
 */
class Household extends Guest
{

    protected $_name;
    protected $_age;
    protected $_gender;

    /**
     * Household constructor.
     * @param $name name of household member
     */
    function __construct($name){
        $this->name = $name;
    }

    /**
     * Getter for name
     * @return name of household member
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Setter for name
     * @param $name name of member
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Getter for age
     * @return age of household member
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Setter for age
     * @param $age age of member
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * Getter of gender
     * @return gender of household member
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Setter for gender
     * @param $gender gender of household member
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }
}