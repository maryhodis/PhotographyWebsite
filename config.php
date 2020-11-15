<?php
require('vendor/autoload.php');
require('vendor/dcblogdev/pdo-wrapper/src/Database.php');

use Dcblogdev\PdoWrapper\Database;

$options = [
    //required
    'username' => 'root',
    'database' => 'events_photo',
    //optional
    'password' => '',
    'type' => 'mysql',
    'charset' => 'utf8',
    'host' => 'localhost',
    'port' => '3306'
];

$db = new Database($options);

$dir = "./";

