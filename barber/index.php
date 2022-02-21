<?php
session_start();
date_default_timezone_set('America/Recife');
define('URL_BASE', 'http://localhost/clickbeard/barber/');
require "vendor/autoload.php";

$app = new \App\core\App();