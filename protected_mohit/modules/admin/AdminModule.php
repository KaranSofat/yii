<?php

class AdminModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));
		/*Yii::app()->setComponents(array(
            'errorHandler'=>array(
            'errorAction'=>'admin/default/error',
        ),
		));*/
		Yii::app()->user->setStateKeyPrefix('_admin');
        Yii::app()->user->setReturnUrl('//admin'); // Module base return URL
        Yii::app()->user->loginUrl = array('//admin/'); // Module login URL
        Yii::app()->theme = 'back'; 
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
