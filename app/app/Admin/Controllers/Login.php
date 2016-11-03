<?php

namespace app\Admin\Controllers;

use \Gelembjuk\WebApp\Exceptions\DoException as DoException;
use \Gelembjuk\WebApp\Exceptions\FormException as FormException;

class Login extends DefaultController {

    public function init() 
    {
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
        $authtype = $this->router->getAuthType();
        
        // session is inited in this controller
        $this->defmodel->logOut();

        return array('success',$this->makeUrl(array('s'=>'ahome')));;
    }
    protected function doUpdatepassword() 
    {
        $curpassword = $this->getInput('curpassword','plainline');
        $password = $this->getInput('password','plainline');
        
        try {
            $this->defmodel->updatePassword($curpassword,$password);
            
            return array('success',
                $this->application->makeUrl('Profile',array('message'=>'s:'.$this->_('passwordupdated','account'))));
        } catch (\Exception $exception) {
            // model will rteurn Exception, but we need extended exception with a redirect url
            throw new DoException(
                $this->application->makeUrl('Profile',array('message'=>'e:'.$exception->getMessage())),
                $exception->getMessage(),'password',400,'redirect');
        }
    }
}
