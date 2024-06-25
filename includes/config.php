<?php
ob_start(); //Turns on output buffering 
session_start();

date_default_timezone_set("Europe/Prague");

try {
    $con = new PDO("mysql:dbname=qwqtube;host=localhost", "root", "r3]RMN4WMW23R*_");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>