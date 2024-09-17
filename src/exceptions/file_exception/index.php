<?php

class FileException extends Exception
{
    public function __construct()
    {
        $this->message = "Error was occured at creating file or folder access\n";
    }
}