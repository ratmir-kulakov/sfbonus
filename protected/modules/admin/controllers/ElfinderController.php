<?php

class ElfinderController extends CController
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
				'actions'=>array('connector'),
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
            'connector' => array(
                'class' => 'ext.elFinder.ElFinderConnectorAction',
                'settings' => array(
                    'root' => Yii::getPathOfAlias('webroot') . Yii::app()->params['uploadDir'],
                    'URL' => Yii::app()->baseUrl . Yii::app()->params['uploadDirURL'],
                    'rootAlias' => 'Home',
                    'mimeDetect' => 'none'
                )
            ),
        );
    }
}
