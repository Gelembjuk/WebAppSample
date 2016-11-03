<?php

namespace app\Admin\Controllers;

use \Gelembjuk\WebApp\Exceptions\DoException as DoException;
use \Gelembjuk\WebApp\Exceptions\FormException as FormException;

class Login extends DefaultController {
    public function init() 
    {
    	$this->signinreqired = false;
        $this->defmodel = $this->application->getModel('Login');
    }
    
    protected function doLogin() 
    {
    	
        $email = $this->getInput('email','plainline');
        $password = $this->getInput('password','plainline');
        $rememberme = $this->getInput('rememberme','alphaext');
        
        try {
            $referrer = $this->router->getReferrer();
            $redirecturl = $this->defmodel->logIn($email,$password,$rememberme,$referrer);
            
            $this->viewdata['redirecturl'] = $redirecturl;
    
            return array('success',$redirecturl);
        } catch (\Exception $exception) {
            throw new DoException(
                $this->makeUrl(array('message'=>'e:'.$exception->getMessage(),'email'=>$email)),$exception->getMessage(),'login',400,'redirect');
        }
        
        return array('success',$this->makeUrlQ(array('message'=>'s:'.$this->_('success'))));
    }
    
    
    protected function doLogout() 
    {
        // session is inited in this controller
        $this->defmodel->logOut();

        return array('success',$this->makeUrl(array('s'=>'ahome')));;
    }
    
}
