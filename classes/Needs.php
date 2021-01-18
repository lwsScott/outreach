<?php
/**
 * Created by PhpStorm.
 * User: Pavel, Alex
 * Date: 3/14/18
 * Time: 12:40 PM
 */

/**
 * Class Needs.class represents the needs needed for the guests
 */
class Needs extends Guest
{
    protected $resource;
    protected $visitDate;
    protected $amount;
    protected $voucher;
    protected $checkNum;

    /**
     * Needs constructor.
     * @param $visitDate visit date of guest
     */
    function __construct($visitDate){
        $this->visitDate = $visitDate;
    }

    /**
     * Getter for resources
     * @return resource needed for guest
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Setter for resource
     * @param $resource resource needed for guest
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    /**
     * Getter for visit date
     * @return visitDate of guest
     */
    public function getVisitDate()
    {
        return $this->visitDate;
    }

    /**
     * Setter for visit date
     * @param $visitDate visit date of guest
     */
    public function setVisitDate($visitDate)
    {
        $this->visitDate = $visitDate;
    }

    /**
     * Getter for amount needed for guest
     * @return amount needed for guest
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Setter for amount
     * @param $amount amount needed for guest
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * Getter for voucher number
     * @return voucher number for guest
     */
    public function getVoucher()
    {
        return $this->voucher;
    }

    /**
     * Setter for voucher number
     * @param $voucher voucher number for guest
     */
    public function setVoucher($voucher)
    {
        $this->voucher = $voucher;
    }

    /**
     * Getter for check number
     * @return checkNum check number for guest
     */
    public function getCheckNum()
    {
        return $this->checkNum;
    }

    /**
     * Setter for check number
     * @param $checkNum check number for guest
     */
    public function setCheckNum($checkNum)
    {
        $this->checkNum = $checkNum;
    }
}