<?php

/**
 * This is the model class for table "{{news}}".
 *
 * The followings are the available columns in table '{{news}}':
 * @property string $id
 * @property string $name
 * @property string $date_published
 * @property string $intro
 * @property string $content
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $date_create
 * @property string $status
 */
class News extends ActiveRecord
{
    public $date_publ;
    public $time_publ;
    
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return News the static model class
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
		return '{{news}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, date_published, content', 'required'),
			array('name, meta_title, meta_description, meta_keywords', 'length', 'max'=>255),
			array('date_published, date_create', 'length', 'max'=>10),
			array('status', 'length', 'max'=>1),
			array('intro', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, date_published, intro, content, date_create, status, date_first, date_last', 'safe', 'on'=>'search'),
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
			'name' => 'Название',
			'date_published' => 'Дата публикации',
			'intro' => 'Предварительное содержание',
			'content' => 'Текст новости',
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords',
			'date_create' => 'Дата создания',
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
		$criteria->compare('name',$this->name,true);
        if( (isset($this->date_first) && trim($this->date_first) != "") && (isset($this->date_last) && trim($this->date_last) != "") )
        {
            $dateLast = CDateTimeParser::parse(trim($this->date_last), 'dd.MM.yyyy');
            $dateLast = mktime(23, 59, 59, 
                               date("m", $dateLast), 
                               date("d", $dateLast), 
                               date("Y", $dateLast)
                        );
            $criteria->condition = "date_published  >= '".CDateTimeParser::parse(trim($this->date_first), 'dd.MM.yyyy')."' and date_published <= '$dateLast'";
        }
        elseif( (isset($this->date_first) && trim($this->date_first) != "") && (isset($this->date_last) && trim($this->date_last) == "") )
        {
            $criteria->condition = "date_published  >= '".CDateTimeParser::parse(trim($this->date_first), 'dd.MM.yyyy')."'";
        }
        elseif( (isset($this->date_first) && trim($this->date_first) == "") && (isset($this->date_last) && trim($this->date_last) != "") )
        {
            $dateLast = CDateTimeParser::parse(trim($this->date_last), 'dd.MM.yyyy');
            $dateLast = mktime(23, 59, 59, 
                               date("m", $dateLast), 
                               date("d", $dateLast), 
                               date("Y", $dateLast)
                        );
            $criteria->condition = "date_published <= '$dateLast'";
        }
        else
        {
            $criteria->compare('date_published', $this->date_published);
        }
		$criteria->compare('intro',$this->intro,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('date_create',$this->date_create,true);
        if( $this->status >= 0 )
        {
            $criteria->compare('status',$this->status);
        }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array(
                'defaultOrder' => 'date_published DESC',
            ),
		));
	}
    
    public function behaviors() 
    {  
        return array(  
            'AutoTimestampBehavior' => array(  
                'class' => 'zii.behaviors.CTimestampBehavior',  
                'createAttribute' => 'date_create',    
                'updateAttribute' => null, 
                'setUpdateOnCreate' => true,  
            ),
            'AutoDateTimeBehavior' => array(  
                'class' => 'application.components.behaviors.DateTimeBehavior',
                'timeFormat' => 'hh:mm',
                'dateAttribute' => 'date_publ',    
                'timeAttribute' => 'time_publ', 
                'timestampAttrbute' => 'date_published',  
            ),
        );  
    }  
}