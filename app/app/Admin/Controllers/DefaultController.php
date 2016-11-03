<?php

namespace app\Admin\Controllers;

use \Gelembjuk\WebApp\Exceptions\DoException as DoException;

class DefaultController extends \app\Controllers\DefaultController {
	// if we want to add any functions there then we have to use trait, as some controllers inherit from user side controllers
	use ControllerTrait;
	
}
