<?php

// test if DB is up and configured

$_SERVER['DOCUMENT_ROOT'] = dirname(__FILE__).'/../../public';

$application = require_once('../../app/init.inc.php');

$logindb = $application->getDBO('Login');

$user_rec = $logindb->getUserRecord('1');

if (!$user_rec) {
    $userid = $logindb->addUser('site',0,'admin','admin@email.com','PLAIN:adminpassword','',1);
    
    $user_rec = $logindb->getUserRecord('1');
    
    if (!$user_rec) {
        echo "FAIL\n";
        exit;
    }
}

echo "Success\n";
