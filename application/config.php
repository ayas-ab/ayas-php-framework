<?php
###############################################################
########## Config.php #########################################
###############################################################
########## This file will contain server properties ###########
########## Everything is defined in here From: ################
########## Server Host info, to default language ##############
########## And anything else ##################################
###############################################################

//Webiste default settings
define("HOST", "127.0.0.1"); //database host
define("USERNAME", "user"); //db username
define("PASSWORD", "123123");  //db password
define("DATABASE", "apf");     //db name
define("HASHKEY", "C00OOcIez_N_IceC3@M");
define("SITE_NAME", "Php framework");
define("SITE_DIR", "apf");  //the directorythe website is in, if its in main directory, leave empty
define('LANG', 'en');   //must have a matching name in application/langauge
define('BASE_URL', 'http://127.0.0.1/'.SITE_DIR.'/'); 
define('HTTP_URL', '127.0.0.1'); //this is used for making cookies
define('SERVER_DEFAULT_TIMEZONE', 'Asia/Riyadh');

$server_existing_langs = ['ar', 'en', 'fr']; //these must exist in application/language
?>