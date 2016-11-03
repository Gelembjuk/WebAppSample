<?php

namespace app\Admin\Views;

trait ViewTrait {
	protected function beforeDisplay() {
        // set some extra information like user, some special links etc
        if ($this->responseformat == 'html') {
            // only for HTML view add extra info to a template
                       
            $this->viewdata['USERID'] = $this->application->getUserID();
            
            $this->viewdata['USER'] = $this->application->getUserRecord();
            
            $branding = $this->application->getConfig('branding');
            
            $this->viewdata['config'] = $branding;
            
            if (empty($this->viewdata['html_title'])) {
                  $this->viewdata['html_title'] = $branding['sitename'];
            }
            
            $this->viewdata['THISISLOCALVERSION'] = $this->application->getConfig('localversion');
            
            if ($this->viewdata['CURRENTPAGE'] == '' || 
                $this->viewdata['CURRENTPAGE'] == 'controller') {
                // in templates we need to know what page is opened
                $this->viewdata['CURRENTPAGE'] = strtolower($this->getName());
            }
            // extra info for opened page.
            $this->viewdata['CURRENTSUBPAGE'] = $this->getPageSubID();
 
            // outer template. It is the single in our case
            $this->htmlouttemplate_force = 'default';
            
            if ($this->application->getUserID() > 0) {
                    $this->htmlouttemplate_force = 'in';
            }
        }
        
        return true;
    }
    protected function getHTMLTemplatesSubFolder()
    {
            // admin view templates are in this subfolder
            return 'Admin/';
    }
}