<?php

$host = 'localhost';
$dbname = 'ojtm';
$dbusername = 'root';
$dbuserpassword = 'incent';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbuserpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection Failed: " . $e->getMessage());
}
