<?php

$host = 'localhost';
$dbname = 'ojtsys';
$dbusername = 'root';
$dbuserpassword = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbuserpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection Failed: " . $e->getMessage());
}


function time_controll(): string
{
    date_default_timezone_set('Asia/Manila');

    // return date('H:i');
    return '17:00:00';
}
