<?php

namespace app\Admin\Controllers;

class Pages extends \app\Controllers\Pages {
    public function init() 
    {
        parent::init();
        $this->defmodel = $this->application->getModel('Pages',
        	['pagesdir' => $this->getPagesDir(),
        		'subfolder' => 'Admin/']);
    }
}