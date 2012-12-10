<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $id
 * @property integer $type
 * @property string $last_name
 * @property string $first_name
 * @property string $middle_name
 * @property string $username
 * @property string $password
 * @property integer $status
 */
class User extends CActiveRecord
{
//    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'administrator';
    const ROLE_MODERATOR = 'moderator';
    
//    const TYPE_USER = 0;
    const TYPE_ADMIN = 1;
    const TYPE_MODERATOR = 2;
    
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    
    public $password_repeat;
    public $date_first;
    public $date_last;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, username, password', 'required'),
			array('type, status, last_login_time', 'numerical', 'integerOnly'=>true),
			array('last_name, first_name, middle_name', 'length', 'max'=>40),
			array('username', 'length', 'max'=>25),
			array('username', 'unique'),
			array('username', 'match', 'pattern'=>'/^[A-Za-z]+[A-Za-z0-9_]*$/'),
			array('password', 'length', 'max'=>32),
			array('password', 'compare'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('type, last_name, first_name, middle_name, username, last_login_time, status, date_first, date_last', 'safe', 'on'=>'search'),
            array('password_repeat', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Тип учетной записи',
			'last_name' => 'Фамилия',
			'first_name' => 'Имя',
			'middle_name' => 'Отчество',
			'username' => 'Логин',
			'password' => 'Пароль',
			'password_repeat' => 'Повторите пароль',
			'last_login_time' => 'Дата последнего входа',
			'status' => 'Статус',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
        if( $this->type >= 0 )
        {
            $criteria->compare('type',$this->type);
        }
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
        if( (isset($this->date_first) && trim($this->date_first) != "") && (isset($this->date_last) && trim($this->date_last) != "") )
        {
            $dateLast = CDateTimeParser::parse(trim($this->date_last), 'dd.MM.yyyy');
            $dateLast = mktime(23, 59, 59, 
                               date("m", $dateLast), 
                               date("d", $dateLast), 
                               date("Y", $dateLast)
                        );
            $criteria->condition = "last_login_time  >= '".CDateTimeParser::parse(trim($this->date_first), 'dd.MM.yyyy')."' and last_login_time <= '$dateLast'";
        }
        elseif( (isset($this->date_first) && trim($this->date_first) != "") && (isset($this->date_last) && trim($this->date_last) == "") )
        {
            $criteria->condition = "last_login_time  >= '".CDateTimeParser::parse(trim($this->date_first), 'dd.MM.yyyy')."'";
        }
        elseif( (isset($this->date_first) && trim($this->date_first) == "") && (isset($this->date_last) && trim($this->date_last) != "") )
        {
            $dateLast = CDateTimeParser::parse(trim($this->date_last), 'dd.MM.yyyy');
            $dateLast = mktime(23, 59, 59, 
                               date("m", $dateLast), 
                               date("d", $dateLast), 
                               date("Y", $dateLast)
                        );
            $criteria->condition = "last_login_time <= '$dateLast'";
        }
        else
        {
            $criteria->compare('last_login_time', $this->last_login_time);
        }
        if( $this->status >= 0 )
        {
            $criteria->compare('status',$this->status);
        }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    /**
    * @return array user type names indexed by type IDs
    */
    public function getTypeOptions()
    {
        return array(
//            self::TYPE_USER      => 'Пользователь',
            self::TYPE_ADMIN     => 'Администратор',
            self::TYPE_MODERATOR => 'Модератор',
        );
    }
    
    public function getRole()
    {
        switch($this->type)
        {
            /*
            case self::TYPE_USER :
                $role = self::ROLE_USER;
                break;
            */
            case self::TYPE_ADMIN :
                $role = self::ROLE_ADMIN;
                break;
            
            case self::TYPE_MODERATOR :
                $role = self::ROLE_MODERATOR;
                break;
            
            default :
                $role = null;
        }
        
        return $role;
    }
    
    public function getTypeName($index)
    {
        $options = $this->getTypeOptions();
        return $options[$index];
    }
    
    /**
    * @return array user type names indexed by type IDs
    */
    public function getStatusOptions()
    {
        return array(
            self::STATUS_INACTIVE  => 'Неактивен',
            self::STATUS_ACTIVE => 'Активен',
        );
    }
    
    public function getStatusName($index)
    {
        $options = $this->getStatusOptions();
        return $options[$index];
    }
    
    /**
    * perform one-way encryption on the password before we store it in
    the database
    */
    protected function afterValidate()
    {
        parent::afterValidate();
        $this->password = $this->encrypt($this->password);
    }
    
    public function encrypt($value)
    {
        $dict = array(
            '0' => 'D', '1' => 'r', '2' => 'j', '3' => 'a', '4' => 'V',
            '5' => 'l', '6' => 'r', '7' => 'z', '8' => 'U', '9' => 'C',
        );
        
        $value = "$value";
        $pass =  md5( $value . md5($value + 'yii_sfbonus_bkzs') );
        $pass = strtr($pass, $dict);
        return $pass;
    }
}