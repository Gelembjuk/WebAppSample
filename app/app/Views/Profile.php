<?php

namespace app\Views;

use \Gelembjuk\WebApp\Exceptions\NotFoundException as NotFoundException;
use \Gelembjuk\WebApp\Exceptions\ViewException as ViewException;

class Profile extends DefaultView{
	
	protected function view() {
	    // displya state of account, login type , email etc
	    
	    if ($this->application->isAdmin()) {
	    	return ['redirect', $this->controller->makeUrl(['s' => 'ahome'])];
	    }
	    
		$this->htmltemplate = 'state';
		
		return true;
	}
	
}