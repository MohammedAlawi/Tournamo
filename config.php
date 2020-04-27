<?php
session_start();
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

define("URL", (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]".parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

define("DB_HOST", 'localhost');          // Host of MySQL Database
define("DB_USER", 'root');  			 //	Username of MySQL Database
define("DB_PASS", 'toor');   			 // Password of MySQL Database
define("DB_NAME", 'tournamo');  	     // Name of MySQL Database

define("PATH_UPLOAD", 'upload/');

define("SMTP_EMAIL", 	''); 				// email Gmail
define("SMTP_PASSWORD",	'');				// password Gmail