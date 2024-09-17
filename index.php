<?php

    include_once "./src/mapgen.php";


    $pages_arr = array(["loc"=>"test.ru", "lastmod"=>"12.10.2002", "priority"=>"high", "changefreq"=>"2"], ["loc"=>"hi.ru", "lastmod"=>"09.12.2002", "priority"=>"high", "changefreq"=>"2"], ["loc"=>"main.ru", "lastmod"=>"02.12.2003", "priority"=>"high", "changefreq"=>"1"]);

    
    $obj = new Map($pages_arr, "json", "./");

    $obj->generate();