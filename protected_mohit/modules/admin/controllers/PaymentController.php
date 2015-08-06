<?php

class PaymentController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
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
	 /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('index','login'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to access all actions
				'actions'=>array('paymentlisting','logout','login','paymentview','export'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionPaymentListing()
	{
		$rec=Booking::model()->findAll();
		//echo "<pre>";print_r($rec);die;
		$this->render('paymentlisting',array('list'=>$rec));
	}

	//function for view payment Details
	public function actionPaymentView($id)
	{
        $rec=Booking::model()->findByPk($id);
		 
		 //echo "<pre>";print_r($rec);die;
        $this->render('paymentview',array('detail'=>$rec));
	}

	/*code to export all the details for payment users*/
	public function actionExport()
	{
       
       $re= Booking::model()->findAll();
       //echo "<pre>";print_r($re);
       foreach($re as $res)
       {
       	   $detail=$res['cleaningDetail'];
       	   $trans=$res['trans_id'];
       	   $price=$res['price'];
       	   $serName=$res->serviceType['service_name'];
       	   $cAdd   =$res->customerAddress['address'];
       	   $company=$res->service['company_name'];

       	   $val[]=array('Copmany Name'=>$company,'Customer Address'=>$cAdd,'Service Name'=>$serName,'price'=>$price,'TransId'=>$trans,'Detail'=>$detail);
       	   
       }	//echo "<pre>";print_r($val);die;
        $filename="payment.csv";
        $csv = new ECSVExport($val);
		$content = $csv->toCSV();                   
		Yii::app()->getRequest()->sendFile($filename, $content, "text/csv", false);
		exit();
	 
           

	}
}