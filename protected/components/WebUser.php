<?php
class WebUser extends CWebUser
{
    private $_model;

    // Not sure why Yii changes sessionID for logged in users
    protected function changeIdentity($id,$name,$states) {
        //Yii::app()->getSession()->regenerateID();
        $this->setId($id);
        $this->setName($name);
        $this->loadIdentityStates($states);
    }

    function getType(){
        $user = $this->loadUser(Yii::app()->user->_id);
        return $user->type;
    }

    protected function loadUser($id=null)
    {
        if($this->_model===null)
        {
            if($id!==null)
                $this->_model=User::model()->findByPk($id);
        }
        return $this->_model;
    }

    public function getId(){
        if (!Yii::app()->user->isGuest) {
            return $this->loadUser(Yii::app()->user->_id)->username;
        }
        return null;
    }
}

