<?php
/**
 * User account update functions
 */
 
namespace app\Database;

class Profile extends User {
    
    public function setSubscription($userid,$subscription) 
    {
        $sql = "UPDATE ".$this->table('users')." SET subscription='".(($subscription)?'y':'n')."' WHERE id = ".$this->int($userid);
        $this->executeQuery($sql);
        
        return true;
    }
    
    public function updateUserEmail($userid,$email) 
    {
        $sql = "UPDATE ".$this->table('users')." SET email='".$this->quote($email)."'".
            " WHERE id = ".$this->int($userid);
        $this->executeQuery($sql);
        
        return true;
    }
    
    public function updateUserName($userid,$name) 
    {
        $sql = "UPDATE ".$this->table('users')." SET name='".$this->quote($name)."' WHERE id = ".$this->int($userid);
        $this->executeQuery($sql);
        
        return true;
    }
}