<?php

session_start();

//[REQUEST_SCHEME] => http
//[SERVER_NAME] => localhost
//[PHP_SELF] => /eshop/public/index.php

$path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
$path = str_replace("index.php", "", $path);                                    //str_replace(search, replace, subject) replace a string index.php by nothing on the path

define('ROOT', $path);                                                          //creating constant variable
define('ASSETS', $path . "assets/");

include '../app/init.php';

//show(ROOT);
$app = new App();