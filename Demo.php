<?php
include './RelativeTime.php';
//Set Date
$date='2016-09-22 10:08:00';

$relativeTime  = new RelativeTime();
echo   $relativeTime->GetTime($date);
