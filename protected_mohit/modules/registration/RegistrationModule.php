<?php

class RegistrationModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'registration.models.*',
			'registration.components.*',
		));
		Yii::app()->setComponents(array(
            'errorHandler'=>array(
            'errorAction'=>'registration/registration/error',
        ),
		));
		Yii::app()->user->setStateKeyPrefix('_registration');
        Yii::app()->user->setReturnUrl('//registration/registration/index'); // Module base return URL
        Yii::app()->user->loginUrl = array('//registration/registration/index'); // Module login URL
        //Yii::app()->theme = 'aits';
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
