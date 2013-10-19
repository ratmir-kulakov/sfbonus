<?php

/**
 * This is the model class for table "{{config}}".
 *
 * The followings are the available columns in table '{{config}}':
 * @property string $id
 * @property string $param
 * @property string $value
 * @property string $default
 * @property string $label
 * @property string $type
 */
class Config extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Config the static model class
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
		return '{{config}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('param, value, default, label, type', 'required'),
			array('param', 'length', 'max'=>128),
			array('label', 'length', 'max'=>255),
			array('type', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, param, value, default, label, type', 'safe', 'on'=>'search'),
		);
	}
}