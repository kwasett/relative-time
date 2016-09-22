<?php
include './RelativeTime.php';
$date='2016-09-22 11:08:00';
//echo date('Y-m-d H:i:s');
$relativeTime  = new RelativeTime();
echo   $relativeTime->GetTime($date);
