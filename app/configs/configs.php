<?php
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();
define("APPROOT", dirname(dirname(__FILE__)));
define("URLROOT", 'http://localhost/my_php/GestionRDVs/Back/');
define("APPNAME", 'GestionRDVs');
define("db_host", $_ENV['DB_HOST']);
define("db_user", $_ENV['DB_USER']);
define("db_psw", $_ENV['DB_PASS']);
define("db_name", $_ENV['DB_NAME']);
