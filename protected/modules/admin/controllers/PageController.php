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

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        $model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Page']))
		{
			$model->attributes=$_POST['Page'];
			if($model->save())
            {
                Yii::app()->user->setFlash('success', '<strong>Сохранено!</strong> Изменения успешно сохранены.');
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
        $this->render('update',array(
			'model'=>$model,
		));
	}

    /**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        if($this->loadModel($id)->delete())
        {
            Yii::app()->user->setFlash('success', '<strong>Удалено!</strong> Страница успешно удалена.');
        }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
    
    /**
     * Deletes a set of items in accordance with the ids array
	 * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDeletescope()
    {
        if(isset($_POST['Ids']))
        {
              $ids=explode(',', $_POST['Ids']);
              $criteria = new CDbCriteria;
              $criteria->addInCondition('id', $ids);
              Page::model()->deleteAll($criteria);
        }
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
        {
			$this->redirect( isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index') );
        }
    }
    
    public function actionFileUploader() 
    {
        $this->layout='//layouts/empty';
        $this->render('fileUploader');
    }
    
    public function actions()
    {
        return array(
            'fileUploaderConnector' => "ext.ezzeelfinder.ElFinderConnectorAction",
        );
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
     * 
     * @return Page
	 */
	public function loadModel($id)
	{
		$model=Page::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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