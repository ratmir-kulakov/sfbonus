<?php

/**
 * This is the model class for table "{{page}}".
 *
 * The followings are the available columns in table '{{page}}':
 * @property string $id
 * @property string $name
 * @property string $content
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $last_update_date
 * @property string $created_date
 * @property integer $status
 */
class Page extends CActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    
    public $date_first;
    public $date_last;
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Page the static model class
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
		return '{{page}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'numerical', 'integerOnly'=>true),
			array('name', 'required'),
			array('name, meta_title, meta_description, meta_keywords', 'length', 'max'=>255),
			array('last_update_date, created_date', 'length', 'max'=>10),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, content, meta_title, meta_description, meta_keywords, last_update_date, created_date, status, date_first, date_last', 'safe', 'on'=>'search'),
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
			'name' => 'Название страницы',
			'content' => 'Содержание',
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
            self::STATUS_INACTIVE  => 'Не опубликована',
            self::STATUS_ACTIVE => 'Опубликована',
        );
    }
    
    public function getStatusName($index)
    {
        $options = $this->getStatusOptions();
        return $options[$index];
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
		$criteria->compare('content',$this->content,true);
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
    
    public function behaviors() 
    {  
        return array(  
            'AutoTimestampBehavior' => array(  
                'class' => 'zii.behaviors.CTimestampBehavior',  
                'createAttribute' => 'created_date',  
                'updateAttribute' => 'last_update_date',  
                'setUpdateOnCreate' => true,  
            ),  
        );  
    }  
}