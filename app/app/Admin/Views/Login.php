<?php

namespace app\Admin\Views;

class Login extends DefaultView{
	
	protected function view() {
        // always redirect to home page
		return array('redirect',$this->controller->makeUrl(['s' => 'home']));
	}
	
}