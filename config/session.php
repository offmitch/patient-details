<?php
require 'vendor/autoload.php'; // if using Composer

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$sessionDB = $mongoClient->selectDatabase('session_store');
$sessionCollection = $sessionDB->selectCollection('sessions');

session_set_save_handler(new MongoDB\Session\SessionHandler($sessionCollection), true);
session_start();
?>