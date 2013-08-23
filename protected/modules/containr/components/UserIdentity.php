<?php

class UserIdentity extends CUserIdentity
{
    const ERROR_USER_NOT_ACTIVE=50;

    private $_id;
    private $_role;

    public function authenticate()
    {

        $record = ContainrUser::model()->find('login = "'.$this->username.'"');

        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->password!==crypt($this->password,$record->password)) {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        } else if (is_null($record->role) || $record->role < 1) {
            $this->errorCode=self::ERROR_USER_NOT_ACTIVE;
        } else
        {
            $this->_id = $record->id;
            $this->_role = $record->role;
            $this->setState('publicname', $record->nameFirst . ' ' . $record->nameLast);
            $this->setState('role', $record->role);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getRole()
    {
    	return $this->_role;
    }
}
