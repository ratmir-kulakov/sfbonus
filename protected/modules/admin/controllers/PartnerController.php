<?php

class PartnerController extends Controller
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
				'actions'=>array('index','view','admin','delete', 'deletescope', 'create', 'update'),
				'roles'=>array('administrator','moderator'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Partner;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Partner']))
		{
			$model->attributes=$_POST['Partner'];
			if($model->save())
            {
                Yii::app()->user->setFlash('success', '<strong>Сохранено!</strong> Страница успешно добавлена.');
                if(isset($_POST['savePartner']))
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
		$model=Partner::model()->with('offices')->findByPk($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Partner']))
		{
			$model->attributes=$_POST['Partner'];
			if($model->save())
            {
                Yii::app()->user->setFlash('success', '<strong>Сохранено!</strong> Изменения успешно сохранены.');
                if(isset($_POST['savePartner']))
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
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = Partner::model()->with('offices')->findByPk($id);
        if($model->delete())
        {
            Yii::app()->user->setFlash('success', '<strong>Удалено!</strong> Информация о партнере успешно удален.');
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
//              Partner::model()->deleteAll($criteria);
              $models = Partner::model()->findAll($criteria);
              foreach($models as $model)
              {
                  /* @var $model Partner */
                  $model->delete();
              }
        }
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
        {
			$this->redirect( isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index') );
        }
    }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $model = Partner::model();
		$model->setScenario('search'); 
		$model->unsetAttributes(); 
        
		if(isset($_GET['Partner']))
        {
			$model->attributes = $_GET['Partner'];
        }
        
		$this->render('index',array(
			'model' => $model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Partner the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Partner::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Partner $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='partner-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
