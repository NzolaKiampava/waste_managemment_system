<?php

//WEBSITE NAME
define("WEBSITE_TITLE", "WasteManagement");

//DATABASE CONFIG

if($_SERVER['SERVER_NAME'] == "localhost")
{
	define("DB_NAME", "waste");			//DATABASE NAME
	define("DB_USER", "root");				//DATABASE USER
	define("DB_PASS", "");                  //DATABASE PASSWORD
	define("DB_TYPE", "mysql");             //DATABASE TYPE
	define("DB_HOST", "localhost");         //DATABASE HOST
} /*else           // living server
{
	define("DB_NAME", "id19515336_eshop_db");			//DATABASE NAME
	define("DB_USER", "id19515336_root");				//DATABASE USER
	define("DB_PASS", "B9lOl-5d>WUpyB\M");              //DATABASE PASSWORD
	define("DB_TYPE", "mysql");             			//DATABASE TYPE
	define("DB_HOST", "localhost");         			//DATABASE HOST
}*/


//Theme of eshop folder
define("THEME", "waste_management/");

//DEBUGING
define("DEBUG", true);

if (DEBUG) {
	
	ini_set('display_errors', 1);                          //ini_set(varname, newvalue), initialize the php configuration
}else{

	ini_set('display_errors', 0);
}