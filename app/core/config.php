<?php

//WEBSITE NAME
define("WEBSITE_TITLE", "Waste IOT");

//DATABASE CONFIG
define("DB_NAME", "waste");			//DATABASE NAME
define("DB_USER", "root");				//DATABASE USER
define("DB_PASS", "");                  //DATABASE PASSWORD
define("DB_TYPE", "mysql");             //DATABASE TYPE
define("DB_HOST", "localhost");         //DATABASE HOST

//Theme of eshop folder
define("THEME", "waste/");

//DEBUGING
define("DEBUG", true);

if (DEBUG) {
	
	ini_set('display_errors', 1);                          //ini_set(varname, newvalue), initialize the php configuration
}else{

	ini_set('display_errors', 0);
}