<?php

/**
 * This is the model class for table "{{tree}}".
 *
 * The followings are the available columns in table '{{tree}}':
 * @property integer $id
 * @property string $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property string $alias
 * @property string $name
 * @property string $module
 * @property string $controller
 * @property string $action
 * @property string $item_id
 */
class Tree extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tree the static model class
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
		return '{{tree}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lft, rgt, level, name, controller, action, item_id', 'required'),
			array('lft, rgt, level', 'numerical', 'integerOnly'=>true),
			array('root, item_id', 'length', 'max'=>10),
			array('alias, name', 'length', 'max'=>255),
			array('module, controller, action', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, root, lft, rgt, level, alias, name, module, controller, action, item_id', 'safe', 'on'=>'search'),
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
			'root' => 'Root',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'level' => 'Уровень',
			'alias' => 'Псевдоним страницы',
			'name' => 'Заголовок',
			'module' => 'Модуль',
			'controller' => 'Контроллер',
			'action' => 'Действие',
			'item_id' => 'ID объекта',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('root',$this->root,true);
		$criteria->compare('lft',$this->lft);
		$criteria->compare('rgt',$this->rgt);
		$criteria->compare('level',$this->level);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('module',$this->module,true);
		$criteria->compare('controller',$this->controller,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('item_id',$this->item_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function behaviors()
	{
		return array(
			'nestedSetBehavior' => array(
				'class' => 'ext.nested-set.NestedSetBehavior',
				'leftAttribute' => 'lft',
				'rightAttribute' => 'rgt',
				'levelAttribute' => 'level',
				'rootAttribute' => 'root',
				'hasManyRoots' => true,
			),
		);
	}
}