<?php

class User extends CActiveRecord {
    public $password_repeat;
    public $password_new;

    # Unhashed password for account verification email
    public $passwordUnHashed;

    public $passwordInvalid = false;
    public $sendNewPassword = false;


    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'yii_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
            array('username','length','max'=>128),
            array('username', 'required'),
            array('username', 'unique'),
            array('password', 'required', 'on'=>'insert'),
            array('password', 'compare', 'compareAttribute'=>'password_repeat', 'on'=>'insert'),
            array('password', 'checkPassword', 'on'=>'update'),
            array('password', 'unsafe'),
        );
    }

    public function checkPassword($attribute, $params) {
        $password = $this->password_new;
        $password_repeat = $this->password_repeat;

        if ($password != '') {
            $password_repeat = $this->password_repeat;

            if ($password != $password_repeat) {
                $this->addError('password',"Password and confirm don't match");
                return false;
            }
            else {
                Yii::log(__FUNCTION__."> match", 'debug');
            }

            $this->password = $this->password_new;
        }
        return true;
    }


    /**
     * @return array relational rules.
     */
    public function relations() {
        return array (
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'username' => 'Username',
            'password_repeat' => 'Confirm Password',
        );
    }


    public function getRoleName() {
        $auth = Yii::app()->authManager;
        foreach ($auth->getAuthAssignments($this->username) as $ass) {
            return $ass->getItemName();
        }
    }

    public function encryptPassword() {
        $this->passwordUnHashed = $this->password;
        $this->password = md5($this->password);
    }

    public function generatePassword($length=8) {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;

        while ($i <= $length) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass .= $tmp;
            $i++;
        }
        return $pass;
    }

}

