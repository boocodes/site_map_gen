<?php

class MapTypeException extends Exception
{
    public function __construct()
    {
        $this->message = "Error was occured in site map type. It can be only three types: csv, json, xml. By default it`s json";
    }
}