<?php

namespace app;

class Application extends \Gelembjuk\WebApp\Application{
	protected $adminmode = false;
	
	/**
	* Next 2 properties are needed to swicth to "user's" controlers when work in admin mode
	* It is required to build links to "user's" views
	*/
	protected $controllerspace_orig;
	protected $viewspace_orig;
	
    public function __construct() {
        parent::__construct();
        $this->localeautoload = true;
        // no exception when url can not be created
        $this->exceptiononurlmake = false;
    }
    // to catch admin mode
    protected function frontRouterLoaded()
	{
        if ($this->routerfront->checkIfAdminSide()) {
        	$this->controllerspace_orig = $this->controllerspace;
        	$this->viewspace_orig = $this->viewspace; 
        	
        	$this->controllerspace = $this->options['applicationnamespaceprefix'] . 'Admin\\Controllers\\';;
        	$this->viewspace = $this->options['applicationnamespaceprefix'] . 'Admin\\Views\\';
        	
        	$this->adminmode = true;
        }
	}
    /**
    * Build urls
    */
    public function makeUrl($controllername,$opts = array()) {
    	
    	// this is a trick to support links to user's side from admin side
        if (isset($opts['global']) && $this->adminmode) {
        
        	// this is admin mode and url must be to "user's" view
        	$controllername = $this->getControllerFullClass($controllername, $this->controllerspace_orig);
        }
        
        return parent::makeUrl($controllername,$opts);
    }
    
    /**
    * Function to build a query by standard set of arguments
    * It is an alias but allows to make urls easier
    */
    public function makeAbsUrlQ($controllername,$message='',$methodtype = '', $methodname = '',
            $objectid = '', $objecttitle = '',$extra1 = '', $extra2 = '',$aopts = array()) {
    
        $relativeurl = $this->makeUrlQ($controllername,$message,$methodtype, $methodname,
            $objectid, $objecttitle ,$extra1 , $extra2 ,$aopts );
        
        $baseurl = $this->getBasehost();
        
        if (substr($baseurl,-1) == '/' && substr($relativeurl,0,1) == '/') {
            $relativeurl = substr($relativeurl,1);
        }
        
        return $baseurl.$relativeurl;
    }
    public function makeUrlQ($controllername,$message='',$methodtype = '', $methodname = '',
            $objectid = '', $objecttitle = '',$extra1 = '', $extra2 = '',$aopts = array()) {
        
        $opts = array();
        
        if ($methodname !='' && $methodtype != '') {
            $opts[$methodtype] = $methodname;
        }
        
        if ($objectid != '') {
            $opts['id'] = $objectid;
        }
        
        if ($objecttitle != '') {
            $opts['title'] = $objecttitle;
        }
        
        if ($extra1 != '') {
            $opts['extra1'] = $extra1;
        }
        
        if ($extra2 != '') {
            $opts['extra2'] = $extra2;
        }
        
        if ($message != '') {
            $opts['message'] = $message;
        }
        $opts = array_merge($opts,$aopts);
        
        return $this->makeUrl($controllername,$opts);
    }
    
    public function getUserRecord() {
        if ($this->getUserID() > 0) {
            $usermod = $this->getModel('User');
            $user_rec = $usermod->getUserRecord();
            
            if ($user_rec) {
                return $user_rec;
            }
        }
        return parent::getUserRecord();
    }
    public function isAdmin()
    {
    	if ($this->getUserID() == 1) {
    		// the user with ID 11 is admin
    		return true;
    	}
    	return false;
    }
}  