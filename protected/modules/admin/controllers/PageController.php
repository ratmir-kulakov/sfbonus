<?php

class PageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='/layouts/column1';

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

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','admin','delete', 'deletescope', 'create', 'update', 'fileUploaderConnector', 'fileUploader', 'fileManager', 'browse'),
				'roles'=>array('administrator'),
			),
			array('allow',
                'actions'=>array('update', 'fileUploaderConnector', 'fileUploader', 'browse'),
                'roles'=>array('moderator'),
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
        $model = new Page('search');
		$model->unsetAttributes(); 
        
		if(isset($_GET['Page']))
        {
			$model->attributes = $_GET['Page'];
        }
        
		$this->render('index',array(
			'model' => $model,
		));
	}
    
    /**
	 * Creates a new model.
	 */
	public function actionCreate()
    {
        $model = new Page;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Page']))
		{
			$model->attributes=$_POST['Page'];
			if($model->save())
            {
                Yii::app()->user->setFlash('success', '<strong>Сохранено!</strong> Страница успешно добавлена.');
                if(isset($_POST['savePage']))
                {
                    $this->redirect(array('update','id'=>$model->id));
                }
                else
                {
                    $this->redirect(array('index'));
                }
            }
            else
            {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверьте правильность заполнения полей.');
            }
		}
    
		$this->layout = '/layouts/column2-page';
		$this->render('create',array(
			'model'=>$model,
		));    
    }
    
    public function actionFileUploader() 
    {
        $this->layout='//layouts/empty';
        $this->render('fileUploader');
    }
    
    public function actionBrowse() 
    {
        $this->layout='//layouts/empty';
        $this->render('browse');
    }
    
    public function actions()
    {
        return array(
            'fileUploaderConnector' => "ext.ezzeelfinder.ElFinderConnectorAction",
            'fileManager'=>array(
                'class'=>'application.extensions.elfinder.ElFinderAction',
            ),
        );
    }

    /**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}