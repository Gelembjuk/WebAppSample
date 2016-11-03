<?php

namespace app\Admin\Views;

use \Gelembjuk\WebApp\Exceptions\NotFoundException as NotFoundException;
use \Gelembjuk\WebApp\Exceptions\ViewException as ViewException;

class Settings extends DefaultView{
	
	protected function view() {
		
		$this->htmltemplate = 'state';
		
		return true;
	}
	
}