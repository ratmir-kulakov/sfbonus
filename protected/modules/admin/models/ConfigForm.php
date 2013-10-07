<?php

class ConfigForm extends CFormModel
{
    public $siteTitle;
    public $adminEmail;
    public $metaDescription;
    public $metaKeywords;
    
    public function init()
    {
        $this->siteTitle = Yii::app()->config->get('SITE.TITLE');
        $this->adminEmail = Yii::app()->config->get('SITE.ADMIN_EMAIL');
        $this->metaDescription = Yii::app()->config->get('SITE.META_DESCRIPT');
        $this->metaKeywords = Yii::app()->config->get('SITE.META_KEYWORDS');
    }


    public function rules()
    {
        return array(
            array('adminEmail', 'email'),
            array('siteTitle', 'length', 'max'=>64),
            array('metaDescription, metaKeywords', 'length', 'max'=>255),
        );
    }

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'adminEmail'=>'E-mail администратора',
			'siteTitle'=>'Название сайта',
			'metaDescription'=>'Описание сайта',
			'metaKeywords'=>'Ключевые слова',
		);
	}
    
    public function save()
    {
        Yii::app()->config->set('SITE.TITLE', $this->siteTitle);
        Yii::app()->config->set('SITE.ADMIN_EMAIL', $this->adminEmail);
        Yii::app()->config->set('SITE.META_DESCRIPT', $this->metaDescription);
        Yii::app()->config->set('SITE.META_KEYWORDS', $this->metaKeywords);
        
        return true;
    }
}

?>
