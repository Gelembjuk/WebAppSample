<?php
/**
 * User account read functions
 */
namespace app\Database;

class User extends \Gelembjuk\DB\Base {
    public function getRowById($id) 
    {
        return $this->getRow('SELECT * FROM '.$this->table('users').' WHERE id='.$this->int($id));
    }
    public function getUser($id,$extended = false) 
    {
        return $this->getRowById($id);
    }
    public function getUserEmptyRec() 
    {
        return $this->getEmptyRecord($this->table('users'));
    }
    public function getUserRecord($id_or_record) 
    {
        if (is_array($id_or_record)) {
            return $id_or_record;
        }
        return $this->getUser($id_or_record,true);
    }
    
    public function getUserByEmail($email) 
    {
        return $this->getRow('SELECT * FROM '.$this->table('users').' WHERE email=\''.$this->quote($email).'\'');
    }
    
    public function getUsers($fields = [])
    {
        $sql = 'SELECT ';
        
        if (count($fields) > 0) {
            $sql .= implode(',', $fields);
        } else {
            $sql .= '*';
        }
        
        $sql .= ' FROM '.$this->table('users').' WHERE id>1';
        
        return $this->getRows($sql);
    }
    
}