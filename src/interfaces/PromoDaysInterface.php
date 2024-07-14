<?php

namespace Interfaces;

interface PromoDaysInterface{
    public function __construct($goalYear);
    public function calculate();

}