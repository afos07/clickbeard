<?php
session_start();
date_default_timezone_set('America/Recife');
define('URL_BASE', 'http://localhost/clickbeard/app/');
require "vendor/autoload.php";

$app = new \App\core\App();