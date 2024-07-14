<?php
require_once 'vendor/autoload.php';

use Classes\PromoDays;
// выводит даты ДО указанного года (указанный код не включен).
$startTime = microtime(true);
$promoDays = new PromoDays(2024);
$result = $promoDays->calculate();
echo implode("\n", $result);
$resultTime = sprintf("%.6f sec", microtime(true) - $startTime);
echo "\n";
echo $resultTime;