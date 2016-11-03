<?php

namespace app\Admin\Views;

use \Gelembjuk\WebApp\Exceptions\ViewException as ViewException;

class DefaultView extends \app\Views\DefaultView
{
	//We use trait, because this viewer must be added to other virwers, but in same time they want to inherit from 
	// user viewers, like Pages, Login etc
	use ViewTrait;
	
    protected function view() {
        $this->htmltemplate = 'login';
        
        if ($this->application->getUserID() > 0) {
            // if user is logged in then show his home page
            $this->htmltemplate = 'home';
        }
        return true;
    }
    
    
}