<?php

/**
 * This is the model class for table "{{partner}}".
 *
 * The followings are the available columns in table '{{partner}}':
 * @property string $id
 * @property string $name
 * @property string $conditions
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $last_update_date
 * @property string $created_date
 * @property integer $status
 * @property ImageARBehavior $logoImgBehavior
 */
class Partner extends ActiveRecord
{
    public $image = null;

    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Partner the static model class
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
		return '{{partner}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
            array('image', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true, 'maxSize' => 1048576),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name, meta_title, meta_description, meta_keywords', 'length', 'max'=>255),
			array('last_update_date, created_date', 'length', 'max'=>10),
            array('conditions, description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, conditions, description, meta_title, meta_description, meta_keywords, last_update_date, created_date, status, date_first, date_last', 'safe', 'on'=>'search'),
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
            'offices'=>array(self::HAS_MANY, 'PartnerOffices', 'partner_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Название',
			'conditions' => 'Условия',
			'description' => 'Краткая информация',
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords',
			'last_update_date' => 'Дата обновления',
			'created_date' => 'Дата создания',
			'status' => 'Статус',
		);
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
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('conditions',$this->conditions,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('created_date',$this->created_date,true);
        if( (isset($this->date_first) && trim($this->date_first) != "") && (isset($this->date_last) && trim($this->date_last) != "") )
        {
            $dateLast = CDateTimeParser::parse(trim($this->date_last), 'dd.MM.yyyy');
            $dateLast = mktime(23, 59, 59, 
                               date("m", $dateLast), 
                               date("d", $dateLast), 
                               date("Y", $dateLast)
                        );
            $criteria->condition = "last_update_date  >= '".CDateTimeParser::parse(trim($this->date_first), 'dd.MM.yyyy')."' and last_update_date <= '$dateLast'";
        }
        elseif( (isset($this->date_first) && trim($this->date_first) != "") && (isset($this->date_last) && trim($this->date_last) == "") )
        {
            $criteria->condition = "last_update_date  >= '".CDateTimeParser::parse(trim($this->date_first), 'dd.MM.yyyy')."'";
        }
        elseif( (isset($this->date_first) && trim($this->date_first) == "") && (isset($this->date_last) && trim($this->date_last) != "") )
        {
            $dateLast = CDateTimeParser::parse(trim($this->date_last), 'dd.MM.yyyy');
            $dateLast = mktime(23, 59, 59, 
                               date("m", $dateLast), 
                               date("d", $dateLast), 
                               date("Y", $dateLast)
                        );
            $criteria->condition = "last_update_date <= '$dateLast'";
        }
        else
        {
            $criteria->compare('last_update_date', $this->last_update_date);
        }
        if( $this->status >= 0 )
        {
            $criteria->compare('status',$this->status);
        }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function beforeDelete()
    {
        if( is_array($this->offices) )
        {
            foreach($this->offices as $office)
            {
                $office->delete();
            }
        }
        else
        {
            $offices = PartnerOffices::model()->with('ymap')->findAll('partner_id=:partnerId', array(':partnerId'=>$this->id));
            foreach($offices as $office)
            {
                $office->delete();
            }
        }
        
        return parent::beforeDelete();
    }
    
    public function deleteAll($condition = '', $params = array())
    {
        $models = $this->findAll($condition, $params);
        $partnersId = array();
        foreach($models as $model)
        {
            $partnersId[] = $model->id;
        }
        
        $criteria = new CDbCriteria;
        $criteria->addInCondition('partner_id', $partnersId);
        $offices = PartnerOffices::model()->with('ymap')->findAll($criteria);
        foreach($offices as $office)
        {
            $office->delete();
        }
        
        return parent::deleteAll($condition, $params);
    }
    
    public function behaviors() 
    {  
        return array(  
            'AutoTimestampBehavior' => array(  
                'class' => 'zii.behaviors.CTimestampBehavior',  
                'createAttribute' => 'created_date',  
                'updateAttribute' => 'last_update_date',  
                'setUpdateOnCreate' => true,  
            ),  
            'logoImgBehavior' => array(  
                'class' => 'application.components.behaviors.ImageARBehavior',  
                'attribute' => 'image', // Эта переменная которую мы объявлили  
                'extension' => 'png, gif, jpg', // Возможные расширения файла  
                'prefix' => 'logo_',  
                'relativeWebRootFolder' => 'upload/partners', // this folder must exist  

                // 'forceExt' => png, // Если раскомментировать эту строчку, то изображения будут конвертироватся в png формат  

                // Определяем "форматы" в которых будут хранится изображения  
                'formats' => array(  
                    '126x126' => array(  
                        'suffix' => '_small',  
                        'process' => array('resize' => array(126, 126)),  
                    ),  
                    // and override the default :  
                    '300x300' => array(  
                        'process' => array('resize' => array(300, 300)),  
                    ),  
                ),  

                'defaultName' => 'nophoto', // when no file is associated, this one is used by getFileUrl  
                // defaultName need to exist in the relativeWebRootFolder path, and prefixed by prefix,  
                // and with one of the possible extensions. if multiple formats are used, a default file must exist  
                // for each format. Name is constructed like this :  
                //     {prefix}{name of the default file}{suffix}{one of the extension}  
            ),
        );  
    } 
}