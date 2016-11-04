<?php

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', '1');

date_default_timezone_set('UTC');
mb_internal_encoding("UTF-8");

$MYWEBSITE_DIR = dirname(__FILE__) ."/";

if (defined('APP_PUBLIC_DIR_PATH')) {
    $MYWEBSITE_WEB_DIR = APP_PUBLIC_DIR_PATH . '/';
} else { 
    $MYWEBSITE_WEB_DIR = $_SERVER['DOCUMENT_ROOT'] . '/';
}

$MYWEBSITE_TEMP_DIR = $MYWEBSITE_DIR ."/../storage/tmp/";

// composer autoload init
$loader = require $MYWEBSITE_DIR .'../src/vendor/autoload.php';
$loader->add('app\\', $MYWEBSITE_DIR);
// uncomment if you have some manual installed classes
//$loader->add('', $MYWEBSITE_DIR .'../src/manual/');

require_once('config.inc.php');

$options = array(
	'webroot' => $MYWEBSITE_WEB_DIR,
	'tmproot' => $MYWEBSITE_TEMP_DIR,
	// logging. Use standard configuration
	'loggerstandard' => true,
	'logdirectory' => $MYWEBSITE_DIR ."/../storage/logs/",
	
	'applicationnamespaceprefix' => '\\app\\',
	'defaultroutername' => 'DefaultRouter',
	'defaultcontrollername' => 'DefaultController',
	'errorhandlerclass' => '\\Gelembjuk\\Logger\\ErrorScreen',
	'errorhandlerobjectoptions' => array(
		'catchwarnings' => true, 
		'catchfatals' => true,
		'catchexceptions' => true,
		'showfatalmessage' => true,
		'showtrace' => true
	),
	// init localization system.
	'languagesstandard' => true,
	'languagespath' => $MYWEBSITE_DIR . '../resources/lang/',
	
	'htmltemplatespath' => $MYWEBSITE_DIR.'../resources/views/',
	'htmltemplatesoptions' => array(
		'extension' => 'htm',
		'compiledir' => $MYWEBSITE_DIR ."/../storage/template_compile/"
		),
	'emailtemplatespath' => $MYWEBSITE_DIR.'../resources/mail/',
	);

$application = \app\Application::getInstance();

$application->init(new appConfig(),$options);

return $application;

