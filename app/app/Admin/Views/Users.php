<?php

namespace app\Admin\Views;

use \Gelembjuk\WebApp\Exceptions\NotFoundException as NotFoundException;
use \Gelembjuk\WebApp\Exceptions\ViewException as ViewException;

class Users extends DefaultView{
	
	protected function view() {
		
		$this->htmltemplate = 'users';
		
		return true;
	}
	
}