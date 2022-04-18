<?php
// header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
// header('Acces-Control-Allow-Headers: Acces-Control-Allow-Methods,Content-Type,Acces-Control-Allow-Headers,Authorization,X-Requested-With');
// header('Acces-Control-Allow-Methods: GET, PUT, PATCH, POST, DELETE');
require_once '../vendor/autoload.php';
include_once '../app/loader.php';
session_start();
if ($_SERVER['REQUEST_URI'] == '/isLogged')
  echo json_encode(['ref' => $_SESSION['ref']]);
$yy = new core();
