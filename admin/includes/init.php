<?php 

defined('DS')? null : define('DS', DIRECTORY_SEPARATOR);

//defined('SITE_ROOT')? null : define('SITE_ROOT', DS.'Applications'.DS.'mampstack-5.4.38-0'.DS.'apache2'.DS.'htdocs'.DS.'w-realtor');



defined('SITE_ROOT')? null : define('SITE_ROOT', DS.'Applications'.DS.'MAMP'.DS.'htdocs'.DS.'w-r');

///Applications/MAMP/htdocs/w-r



/*
defined('SITE_ROOT')? null : define('SITE_ROOT', 'http://localhost:8080/w-realtor');*/

    
defined('INCLUDES_PATH')? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');




require_once("functions.php");
require_once("config.php");
require_once("database.php");
require_once("db_object.php");
require_once("building.php");
require_once("object_u.php");
require_once("object_m.php");
require_once("user.php");
require_once("session.php");
require_once("photo.php");
require_once("alert.php");



?>