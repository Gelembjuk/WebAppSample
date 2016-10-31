<?php

class appConfig {
    public $offline = false;
     
    public $localversion = true;
    
    public $loggingfilter = 'all';
    
    public $defaultlocale = 'en';
    
    public $basehost = 'http://webappsample.com/';
    
    // DB settings
    public $database = array(
        'default' => array(
            'engine' => 'mysqli',
            'user' => 'dbuser',
            'password' => 'dbpassword',
            'database' => 'webappsample',
            'host' => 'localhost', // mondodb server credentials
        )
        );
    // email settings
    public $emails = array(
        'from' => array('address'=>'info@webappademo.com','name'=>'WebApp Demo'),
        'contact' => array('address'=>'info@webappademo.com','name'=>'WebApp Demo contact'),
        'noreply' => array('address'=>'info@webappademo.com','name'=>'WebApp Demo noreply'),
        );
        
    public $branding = array(
        'sitename' => 'Web Application Sample',
        'sitenamewithdomain' => 'webappsample.com'
        );
    
    // email sending
    public $mailerclass = 'null';
    public $mailersettings = array(
        'mailsystem' => 'mail',
        'smtp_host' => 'smtp.gmail.com',
        'smtp_port' => '465',
        'smtp_secure' => true,
        'smtp_auth' => true,
        'smtp_user' => 'xxxxxx@gmail.com',
        'smtp_password' => 'zzzzzzzz'
        );

    public $integrations = array(
        'facebook' => array(
            'api_key' => '',
            'secret_key' => ''
            ),
        'twitter' => array(
            'consumer_key' => '',
            'consumer_secret' => ''
            ),
        'linkedin' => array(
            'api_key' => '',
            'api_secret' => ''
            ),
        'google' => array(
            'application_name' => '',
            'client_id' => '',
            'client_secret' => ''
            )
    );
    
    //salts
    public $system_salt_general = 'CHANGE_SALT';

}
