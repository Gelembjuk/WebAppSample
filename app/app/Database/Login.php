<?php

namespace app\Database;

class Login extends User {

    public function checkEmailUsed($email) 
    {
        $sql = 'SELECT * FROM '.$this->table('users').' WHERE email=\''.$this->quote($email).'\'';
        $ext_rec = $this->getRow($sql);
        
        if ($ext_rec) {
            return true;
        }
        return false;
    }
    public function addUser($logintype,$active,$name,$email,$passwordhash,$usertype = 'v',$externalid = '') 
    {
        $active = ($active === true || $active === '1' || $active === 1 || $active === 'y' || $active === 'yes')?'1':'0';
        
        if ($logintype == 'site') {
            $externalid = '';
        }
        $this->debug("$name,$email");
        $sql = "INSERT INTO ".$this->table('users')." SET ".
            "name = '".$this->quote($name)."',".
            "email = '".$this->quote($email)."',".
            "password = '".$this->quote($passwordhash)."',".
            "created = UTC_TIMESTAMP(),".
            "active = ".$active.",".
            "logintype = '".$logintype."',".
            "externalid = '".$this->quote($externalid)."',".
            "subscription = 'n'"
            ;
            
        $this->executeQuery($sql);
        $this->debug($sql);
        
        $this->debug('last insert ID '.$this->getLastInsertedId());
        return $this->getLastInsertedId();
    }
    protected function changeActiveStatus($userid,$active) 
    {
        $sql = "UPDATE ".$this->table('users')." SET ".
            " active=".(($active === true || $active === 1 || $active === '1' || $active === 'y' || $active === 'yes')?'1':'0').
            " WHERE id=".$this->int($userid);
            
        $this->executeQuery($sql);
    }
    
    public function activateUser($userid) 
    {
        return $this->changeActiveStatus($userid,true);
    }
    
    public function deActivateUser($userid) 
    {
        return $this->changeActiveStatus($userid,false);
    }
    public function updateUserPassword($userid,$passwordhash) 
    {
        $sql = "UPDATE ".$this->table('users')." SET password='".$this->quote($passwordhash)."' WHERE id = ".$this->int($userid);
        $this->executeQuery($sql);
        
        return true;
    }
    public function updateUserLoginType($userid,$type) 
    {
        $sql = "UPDATE ".$this->table('users')." SET logintype='".$this->quote($type)."' WHERE id = ".$this->int($userid);
        $this->executeQuery($sql);
        
        return true;
    }
    
    public function getUserByExternalAuth($network,$externalid) 
    {
        $sql = 'SELECT * FROM '.$this->table('users').' WHERE logintype=\''.$this->quote($network).'\' '.
            ' AND externalid=\''.$this->quote($externalid).'\'';
        return $this->getRow($sql);
    }
    
}