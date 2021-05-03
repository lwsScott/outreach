<?php

/*
 * stores tasks
 * 04/30/21
 * @author Lewis Scott
 * @version 1.0
 */

class Task
{
    //Declare instance variables
    private $_taskID;
    //private $_taskName;
    private $_client;
    private $_assistance;
    private $_date;
    private $_time;
    private $_amount;
    private $_paid;

    /**
     * Tasks constructor.
     * @param $_taskID
     * @param $_client
     * @param $_assistance
     * @param $_date
     * @param $_time
     * @param $_amount
     * @param $_paid
     */
    public function __construct($_client, $_date, $_time, $_assistance, $_amount, $_paid)
    {
        $this->_client = $_client;
        $this->_assistance = $_assistance;
        $this->_date = $_date;
        $this->_time = $_time;
        $this->_amount = $_amount;
        $this->_paid = $_paid;
    }

    /**
     * @return mixed
     */
    public function getTaskID()
    {
        return $this->_taskID;
    }

    /**
     * @param mixed $taskID
     */
    public function setTaskID($taskID): void
    {
        $this->_taskID = $taskID;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->_client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client): void
    {
        $this->_client = $client;
    }

    /**
     * @return mixed
     */
    public function getAssistance()
    {
        return $this->_assistance;
    }

    /**
     * @param mixed $assistance
     */
    public function setAssistance($assistance): void
    {
        $this->_assistance = $assistance;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->_date = $date;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->_time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time): void
    {
        $this->_time = $time;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->_amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getPaid()
    {
        return $this->_paid;
    }

    /**
     * @param mixed $paid
     */
    public function setPaid($paid): void
    {
        $this->_paid = $paid;
    }


}