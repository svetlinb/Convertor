<?php 

/**
 * Path configuration
 *
 * In this file you set paths to different directories used by App.
 * Also include neccessery classes.
 *
 */
error_reporting(E_ERROR | E_PARSE);

/*
 * Path to saved data.
 */
define('SAVE_PATH', getcwd()."/currency.data");

/*
 * JSON URL Feed.
*/
define('JSON_URL', "http://rocky-brushlands-8739.herokuapp.com/rates");

require_once 'model/Persistor.php';
require_once 'model/Validator.php';
require_once 'model/Calculate.php';
require_once 'controller/Convertor.php';
?>