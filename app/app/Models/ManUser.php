<?php

namespace app\Models;

class ManUser extends User {
    public function getUsers() {
        $userdb = $this->application->getDBO('User');
        
        return $userdb->getUsers(['id','name','email','active','created','logintype']);
    }
}
