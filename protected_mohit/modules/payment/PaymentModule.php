<?php

class PaymentModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'payment.models.*',
			'payment.components.*',
		));
		Yii::app()->user->setStateKeyPrefix('_payment');
        Yii::app()->user->setReturnUrl('//payment'); // Module base return URL
        Yii::app()->user->loginUrl = array('//payment/'); // Module login URL
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
