<?php

namespace app;

class Application extends \Gelembjuk\WebApp\Application{
    public function __construct() {
        parent::__construct();
        $this->localeautoload = true;
    }
    
    public function init($config,$options = array()) {
        parent::init($config,$options);

        $this->setLogger(new \Gelembjuk\Logger\FileLogger(
                    array(
                    'logfile' => $this->getOption('logdirectory').'log.txt',
                    'groupfilter' => $this->getConfig('loggingfilter')
                    )
                )
            );
        
        if (!$this->checkTranslateObjectIsSet()) {
            $this->initTranslateObject(
                array(
                    'locale'=>$this->locale,
                    'localespath'=>$this->getOption('languagespath'))
                );
        }

        
    }
    // We have only one router, so not need to do some detection there
    protected function getDefaultRouter() {
        return 'DefaultRouter';
    }
    protected function getRouterNameFromRequest() {
        return $this->getDefaultRouter();
    }
    // this name is used when not possible to detect controller from a request
    protected function getDefaultControllerName() {
        return 'DefaultController';
    }
    /**
    * Build urls
    */
    public function makeUrl($controllername,$opts = array()) {
        
        try {
            return parent::makeUrl($controllername,$opts);
        } catch (\Exception $e) {
            $this->error("Link gen error ".$e->getMessage());
            return '';
        }
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
}  