<?php

namespace app\Admin\Controllers;

/*
* Contains all implementation of a default controller
*/

trait ControllerTrait {
    
    public function init() 
    {
        parent::init();
        
        // detect own name. if it is not inherited then allow not auth access
        if ($this->getName() == 'DefaultController') {
        	$this->signinreqired = false;
        } else {
        	$this->signinreqired = true;
        }
    }
}