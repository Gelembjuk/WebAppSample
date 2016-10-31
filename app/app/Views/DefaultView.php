<?php

namespace app\Views;

use \Gelembjuk\WebApp\Exceptions\ViewException as ViewException;

class DefaultView extends \Gelembjuk\WebApp\View
{
    public function init() 
    {
        $this->erroronnotfoundview = true;
    }
    
    protected function view() {
        $this->htmltemplate = 'default';
        
        if ($this->application->getUserID() > 0) {
            // if user is logged in then show his home page
            $this->htmltemplate = 'home';
        }
        return true;
    }
    
    protected function beforeDisplay() {
        // set some extra information like user, some special links etc
        if ($this->responseformat == 'html') {
            // only for HTML view add extra info to a template
                       
            $this->viewdata['USERID'] = $this->application->getUserID();
            
            $this->viewdata['USER'] = $this->application->getUserRecord();
            
            $branding = $this->application->getConfig('branding');
            
            $this->viewdata['config'] = $branding;
            
            if (empty($this->viewdata['html_title'])) {
            	  $this->viewdata['html_title'] = $branding['sitename'];
            }
            
            $this->viewdata['THISISLOCALVERSION'] = $this->application->getConfig('localversion');
            
            if ($this->viewdata['CURRENTPAGE'] == '' || 
                $this->viewdata['CURRENTPAGE'] == 'controller') {
                // in templates we need to know what page is opened
                $this->viewdata['CURRENTPAGE'] = strtolower($this->getName());
            }
            // extra info for opened page.
            $this->viewdata['CURRENTSUBPAGE'] = $this->getPageSubID();
 
            // outer template. It is the single in our case
            $this->htmlouttemplate_force = 'default';
        }
        
        return true;
    }
    
    protected function displayJSON() {
        // we always need 200 response for JSON requests. even if there is error
        // JSON is used for ajax
        if (!empty($this->viewdata['errorcode'])) {
            $this->viewdata['errorcode'] = 200;
        }
        parent::displayJSON();
    }
    
    /**
    * Redirect to home page if a user is already in
    */
    protected function goToHomeIfIn() 
    {
        if ($this->application->getUserID() > 0) {
            throw new ViewException($this->application->makeUrl('def'),
                'You are already in','',400,'redirect');
        }
    }
    /*
    * This is used to mark correct menu item for opened page
    */
    protected function getPageSubID()
    {
        return '';
    }
}