<?php

namespace app\Controllers;

class Cron extends DefaultController {
	public function init() {
		parent::init();
		
		// read input data from command line
		$this->router->parseCommandLine();
		
		$this->router->setInput('controller','cron');
		$this->router->setInput('responseformat','json');
		
		if ($this->router->getInput('do') == '') {
			// default operation.
			$this->router->setInput('do','execute');
		}
		
		$this->router->setUpActionInfo();
		
		$this->defmodel = $this->application->getModel('Cron');
	}
	protected function mustBeCommandLine() {
		if ($this->application->getOption('RunMode') != 'cron') {
			throw new \Exception('Only command line calls are allowed');
		}
	}
	protected function doExecute() {
		$this->mustBeCommandLine();
		
		return array('success','/');
	}
	
	protected function doSomeaction() {
		
		// do somethign in a model
		
		//$logs = $this->defmodel->someAction();
		//$this->addViewerData("logs",$logs);
		
		return array('success','/');
	}
	
	protected function doTest() {
		$this->debug('test cron');
		
		$logs = $this->defmodel->test();
		$this->addViewerData("logs",$logs);
		
		return array('success','/');
	}
	
}
