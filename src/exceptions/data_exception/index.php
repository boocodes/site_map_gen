<?php

class DataException extends Exception
{
    public function __construct()
    {
        $this->message = "Error was occured in data\n";
    }
}