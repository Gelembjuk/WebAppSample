<?php

namespace app\Controllers;

use \Gelembjuk\WebApp\Exceptions\DoException as DoException;

class DefaultController extends \Gelembjuk\WebApp\Controller {
	    
    protected function getViewer($name = '') 
    {
        if ($this->getName() == 'DefaultController') {
        	$this->defviewname = 'DefaultView';
        }
        return parent::getViewer(); // presume all other controllers will have views with same names
    }
    
    public function makeUrlQ($message='',$methodtype = '', $methodname = '',
            $objectid = '', $objecttitle = '',$extra1 = '', $extra2 = '') 
    {
        
        return $this->application->makeUrlQ($this->getName(),$message,$methodtype, $methodname,
            $objectid, $objecttitle,$extra1, $extra2);
    }

    /*
    * Authentificate a user
    */
    protected function initAuthSession() 
    {
        $authtype = $this->router->getAuthType();

        // open PHP session data
        $this->router->initSession();
        
        if ($_SESSION['userid'] == 0 && $this->router->getInput('remembermecode') != '') {
            // auth with a Remember Me code
            $loginmod = $this->application->getModel('Login',array());
            $loginmod->logInWithCode($this->router->getInput('remembermecode'));
        }
        
        // set a user info to an application
        if ($_SESSION['userid'] > 0) {
            $this->application->setUserID($_SESSION['userid']);
        }
    }
        
    public function signinNotRequired() {
        $this->signinreqired = false;
    }
}
