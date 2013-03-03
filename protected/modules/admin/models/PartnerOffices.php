<?php

/**
 * This is the model class for table "{{partner_offices}}".
 *
 * The followings are the available columns in table '{{partner_offices}}':
 * @property string $id
 * @property string $partner_id
 * @property string $address
 * @property string $phone
 * @property string $schedule
 * @property string $ymaps_id
 * @property string $ymaps_type
 * @property double $cgeopoint_x
 * @property double $cgeopoint_y
 * @property double $geopoint_x
 * @property double $geopoint_y
 *
 * The followings are the available model relations:
 * @property Partner $partner
 */
class PartnerOffices extends ActiveRecord
{
    const YMAP_MAP = 'MAP';
    const YMAP_SATELLITE = 'SATELLITE';
    const YMAP_HYBRID = 'HYBRID';
    const YMAP_PMAP = 'PMAP';
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PartnerOffices the static model class
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
		return '{{partner_offices}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('partner_id, address, schedule', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('cgeopoint_x, cgeopoint_y, geopoint_x, geopoint_y', 'numerical'),
			array('partner_id', 'length', 'max'=>10),
			array('address, phone, schedule', 'length', 'max'=>255),
			array('ymaps_type', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, partner_id, address, phone, schedule, ymaps_type, cgeopoint_x, cgeopoint_y, geopoint_x, geopoint_y, status', 'safe', 'on'=>'search'),
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
			'partner' => array(self::BELONGS_TO, 'Partner', 'partner_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'partner_id' => 'Торговая точка',
			'address' => 'Адрес',
			'phone' => 'Телефон',
			'schedule' => 'График работы',
			'ymaps_type' => 'Тип карты',
			'cgeopoint_x' => 'Координата центра карты по X',
			'cgeopoint_y' => 'Координата центра карты по Y',
			'geopoint_x' => 'Координата X',
			'geopoint_y' => 'Координата Y',
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
		$criteria->compare('partner_id',$this->partner_id,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('schedule',$this->schedule,true);
		$criteria->compare('ymaps_type',$this->ymaps_type,true);
		$criteria->compare('cgeopoint_x',$this->cgeopoint_x);
		$criteria->compare('cgeopoint_y',$this->cgeopoint_y);
		$criteria->compare('geopoint_x',$this->geopoint_x);
		$criteria->compare('geopoint_y',$this->geopoint_y);
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
    public function getStatusOptions()
    {
        return array(
            self::STATUS_INACTIVE  => 'Не опубликован',
            self::STATUS_ACTIVE => 'Опубликован',
        );
    }
    
    /**
    * @return array map type names indexed by type
    */
    public function getMapTypes()
    {
        return array(
            self::YMAP_MAP  => 'Схема',
            self::YMAP_SATELLITE => 'Спутник',
            self::YMAP_HYBRID => 'Гибрид',
            self::YMAP_PMAP => 'Народная',
        );
    }
    
    public function getMapName($index)
    {
        $mapTypes = $this->getMapTypes();
        return $mapTypes[$index];
    }
}