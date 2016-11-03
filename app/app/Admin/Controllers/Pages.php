<?php

namespace app\Admin\Controllers;

class Pages extends \app\Controllers\Pages {
	use ControllerTrait;
	
    public function init() 
    {
        parent::init();
        $this->signinreqired = true;
        
        $this->defmodel = $this->application->getModel('Pages',
        	['pagesdir' => $this->getPagesDir(),
        		'subfolder' => 'Admin/']);
    }
}