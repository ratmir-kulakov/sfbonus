<?php

class ConfigController extends Controller
{
    /**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/column1';
    
	public function actionIndex()
	{
        $model = new ConfigForm;
        
        if(isset($_POST['ConfigForm']))
		{
            $model->attributes = $_POST['ConfigForm'];
            if( $model->save() )
            {
                Yii::app()->user->setFlash('success', '<strong>Сохранено!</strong> Настройки успешно обновлены.');
                $this->redirect(array('index'));
            }
            else
            {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверьте правильность заполнения полей.');
            }
        }
        
		$this->layout = '/layouts/column1-page';
        $this->render('index', array('model'=>$model));
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index'),
				'roles'=>array('administrator'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
}