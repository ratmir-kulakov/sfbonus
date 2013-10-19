<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='/layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    /**
     * @var string the page name 
     */
    public $pageName = '';
    /**
     * @var array the control buttons of the current page 
     */
    public $controlButtons = array();
    /**
     * @var string the link to previous page 
     */
    public $backLink = '';

    protected function beforeAction($action)
    {
        parent::beforeAction($action);
        
        $jsFilesDir = Yii::getPathOfAlias('webroot.js');
        Yii::app()->clientScript->registerCoreScript('jquery');
//        Yii::app()->clientScript->registerScriptFile(CHtml::asset($jsFilesDir.DIRECTORY_SEPARATOR.'bootstrap.js'), CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile(CHtml::asset($jsFilesDir.DIRECTORY_SEPARATOR.'jScrollPane'.DIRECTORY_SEPARATOR.'jquery.mousewheel.js'), CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile(CHtml::asset($jsFilesDir.DIRECTORY_SEPARATOR.'jScrollPane'.DIRECTORY_SEPARATOR.'jsPane.js'), CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile(CHtml::asset($jsFilesDir.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'f.js'), CClientScript::POS_END);
        
        $commonScriptFile = Yii::getPathOfAlias('webroot.js.'.Yii::app()->controller->id).DIRECTORY_SEPARATOR.'common.js';
        if (file_exists($commonScriptFile)) 
        {
            Yii::app()->clientScript->registerScriptFile(CHtml::asset($commonScriptFile), CClientScript::POS_END);
        }
        
        return true;
    }
}