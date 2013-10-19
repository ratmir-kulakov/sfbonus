<?php
// controller for tinyMce
Yii::import('ext.tinymce.*');
 
class TinyMceController extends CController
{
    /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
            array('allow',
				'actions'=>array('compressor', 'spellchecker'),
				'roles'=>array('administrator', 'moderator'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    public function actions()
    {
        return array(
            'compressor' => array(
                'class' => 'TinyMceCompressorAction',
                'settings' => array(
                    'compress' => true,
                    'disk_cache' => true,
                )
            ),
            'spellchecker' => array(
                'class' => 'TinyMceSpellcheckerAction',
            ),
        );
    }
}
