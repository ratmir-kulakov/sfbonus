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
    

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}