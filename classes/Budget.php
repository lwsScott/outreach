<?php

/*
 * stores tasks
 * 04/30/21
 * @author Lewis Scott
 * @version 1.0
 */

class Budget
{
    private $_budgetID;
    private $_weeklyBudget;
    private $_budgetEstimated;
    private $_budgetUsed;

    /**
     * Budget constructor.
     * @param $_weeklyBudget
     * @param $_budgetEstimated
     * @param $_budgetUsed
     */
    public function __construct($_weeklyBudget, $_budgetEstimated, $_budgetUsed)
    {
        $this->_weeklyBudget = $_weeklyBudget;
        $this->_budgetEstimated = $_budgetEstimated;
        $this->_budgetUsed = $_budgetUsed;
    }

    /**
     * @return mixed
     */
    public function getBudgetID()
    {
        return $this->_budgetID;
    }

    /**
     * @return mixed
     */
    public function getWeeklyBudget()
    {
        return $this->_weeklyBudget;
    }

    /**
     * @param mixed $weeklyBudget
     */
    public function setWeeklyBudget($weeklyBudget): void
    {
        $this->_weeklyBudget = $weeklyBudget;
    }

    /**
     * @return mixed
     */
    public function getBudgetEstimated()
    {
        return $this->_budgetEstimated;
    }

    /**
     * @param mixed $budgetEstimated
     */
    public function setBudgetEstimated($budgetEstimated): void
    {
        $this->_budgetEstimated = $budgetEstimated;
    }

    /**
     * @return mixed
     */
    public function getBudgetUsed()
    {
        return $this->_budgetUsed;
    }

    /**
     * @param mixed $budgetUsed
     */
    public function setBudgetUsed($budgetUsed): void
    {
        $this->_budgetUsed = $budgetUsed;
    }


}