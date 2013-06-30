<?php

/**
 * This is the model class for table "{{yandex_map}}".
 *
 * The followings are the available columns in table '{{yandex_map}}':
 * @property integer $owner_id
 * @property string $model
 * @property double $center_lat
 * @property double $center_lon
 * @property double $placemrk_lat
 * @property double $placemrk_lon
 * @property integer $zoom
 * @property string $type
 * @property integer $status
 */
class YandexMapModel extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return YandexMap the static model class
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
		return '{{yandex_map}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('owner_id, model, center_lat, center_lon, placemrk_lat, placemrk_lon, zoom, type', 'required'),
			array('zoom, status', 'numerical', 'integerOnly'=>true),
			array('center_lat, center_lon, placemrk_lat, placemrk_lon', 'numerical'),
			array('owner_id, model', 'length', 'max'=>10),
			array('type', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('owner_id, model, center_lat, center_lon, placemrk_lat, placemrk_lon, zoom, type, status', 'safe', 'on'=>'search'),
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
			'owner_id' => 'Owner',
			'model' => 'Model',
			'center_lat' => 'Center Lat',
			'center_lon' => 'Center Lon',
			'placemrk_lat' => 'Placemrk Lat',
			'placemrk_lon' => 'Placemrk Lon',
			'zoom' => 'Zoom',
			'type' => 'Type',
			'status' => 'Status',
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

		$criteria->compare('owner_id',$this->owner_id,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('center_lat',$this->center_lat);
		$criteria->compare('center_lon',$this->center_lon);
		$criteria->compare('placemrk_lat',$this->placemrk_lat);
		$criteria->compare('placemrk_lon',$this->placemrk_lon);
		$criteria->compare('zoom',$this->zoom);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    /**
    * @return array status
    */
    public function getStatusOptions()
    {
        return array(
            self::STATUS_INACTIVE  => 'Не показывать',
            self::STATUS_ACTIVE => 'Показать',
        );
    }
}