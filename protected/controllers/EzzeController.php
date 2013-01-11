<?php

class EzzeController extends Controller
{
    public $layout = "main/clean";

    public function actions()
    {
        return array(
            'connector' => "ext.ezzeelfinder.ElFinderConnectorAction",
        );
    }

    public function actionElfinder()
    {
        $this->render("elfinder");
    }
}