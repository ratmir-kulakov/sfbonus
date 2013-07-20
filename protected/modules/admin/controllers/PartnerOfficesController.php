<?php

class PartnerOfficesController extends Controller
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
				'actions'=>array('view','delete', 'deletescope', 'create', 'update'),
				'roles'=>array('administrator'),
			),
			array('allow',
                'actions'=>array('update'),
                'roles'=>array('moderator'),
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
		$model=new PartnerOffices;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PartnerOffices']))
		{
			$model->attributes=$_POST['PartnerOffices'];
			if($model->save())
            {
                Yii::app()->user->setFlash('success', '<strong>Сохранено!</strong> Адрес успешно добавлен.');
                if(isset($_POST['savePartnerOffices']))
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
        if( is_null($model->ymap) )
        {
            $ymapModel = new YandexMapModel;
        }
        else
        {
            $ymapModel = $model->ymap;
        }

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PartnerOffices']))
		{
			$model->attributes=$_POST['PartnerOffices'];
            
            $_POST['YandexMapModel']['owner_id'] = intval($id);
            $_POST['YandexMapModel']['model'] = PartnerOffices::getYMapModelName();
            $ymapModel->attributes=$_POST['YandexMapModel'];
            
			if($model->save())
            {
                Yii::app()->user->setFlash('success', '<strong>Сохранено!</strong> Изменения в адресе успешно сохранены.');
                if( !$ymapModel->save() )
                {
                    Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Не удалось сохранить координаты объекта на карте.');
                }

                
                if(isset($_POST['savePartnerOffices']))
                {
                    $this->redirect(array('update','id'=>$model->id));
                }
                else
                {
                    $this->redirect(array('partner/update', 'id'=>$model->partner_id));
                }
            }
            else
            {
                Yii::app()->user->setFlash('error', '<strong>Ошибка!</strong> Проверьте правильность заполнения полей.');
            }
            
		}

		$this->layout = '/layouts/column1-page';
        $this->render('update',array(
			'model'=>$model,
            'ymapModel' => $ymapModel,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if($this->loadModel($id)->delete())
        {
            Yii::app()->user->setFlash('success', '<strong>Удалено!</strong> Адрес успешно удален.');
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
              PartnerOffices::model()->deleteAll($criteria);
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
    /*
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('PartnerOffices');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
    */

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PartnerOffices the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PartnerOffices::model()->with('ymap')->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PartnerOffices $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='partner-offices-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
