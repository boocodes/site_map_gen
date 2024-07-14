<?php

namespace Exceptions;

use Exception;

class ErrorGoalYearException extends Exception
{
    function __construct($message = "Error, incorrect data in usage Promo Days calculating method \n")
    {
        $this->message = $message;
    }
}


