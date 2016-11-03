<?php

namespace app\Admin\Controllers;

use \Gelembjuk\WebApp\Exceptions\DoException as DoException;
use \Gelembjuk\WebApp\Exceptions\FormException as FormException;

class Settings extends DefaultController {
    public function init() 
    {
        
        $this->defmodel = $this->application->getModel('Profile');
    }
    protected function doUpdatepassword() 
    {
        $curpassword = $this->getInput('curpassword','plainline');
        $password = $this->getInput('password','plainline');
        
        try {
            $this->defmodel->updatePassword($curpassword,$password);
            
            return array('success',
                $this->makeUrl(array('message'=>'s:'.$this->_('passwordupdated','account'))));
        } catch (\Exception $exception) {
            // model will rteurn Exception, but we need extended exception with a redirect url
            throw new DoException(
                $this->makeUrl(array('message'=>'e:'.$exception->getMessage())),
                $exception->getMessage(),'password',400,'redirect');
        }
    }
}
