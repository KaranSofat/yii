<?php

class AdminController extends Controller
{
	

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
				'actions'=>array('dashboard','logout','login'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex()
	{
		 //echo Yii::app()->request->baseUrl;die;

		//ob_start();
		//Yii::app()->theme='back'; 
         $model=new LoginForm;
          
        
		$this->render('index',array('model'=>$model));
	}

	
	public function actionLogin()
	{
		
		$model=new LoginForm;
        //echo "<pre>";print_r($_REQUEST);die;  
        
		// if it is ajax validation request
		    if(isset($_POST['LoginForm']))
	     	{
	     		  $model->attributes=$_POST['LoginForm'];
				  if($model->validate() && $model->login())
	              {
	              	  //echo "<pre>";print_r($_SESSION);die;
	              	  $user=$_SESSION['_admin__id'];
	              	  $rec= Admin::model()->findByAttributes(array('username'=>$user));
	              	  //echo $rec->id;die;
	              	  Yii::app()->session['username']=$rec->id;
	              	  $this->redirect('dashboard',array('model'=>$model));
	               }
	               else
	               {
	               	 $errors=$model->getErrors();
	               	 $this->render('index',array('model'=>$model));
	               }
	     	}	
		     
          // $this->render('index',array('model'=>$model));
		/*if(isset($_POST['LoginForm']) && $_POST['LoginForm']==='login-form')
		{
			//echo "<pre>";print_r($_REQUEST);die;
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			
			
			
			$uName=$_POST['LoginForm']['username'];
			$uPass=$_POST['LoginForm']['password'];
			$pass=md5($uPass);
			$admin = Admin::model()->findByAttributes(array('username'=>$uName,'password'=>$pass));
            $count=count($admin);
            //echo $count;die;
             $model->attributes=$_POST['LoginForm'];  
			
               
				//$this->redirect(Yii::app()->user->returnUrl);
				Yii::app()->session['username']=$uName;
           //Yii::app()->session->add('username',$uName);

			if($count>0)
			{
			    //Yii::app()->session['username']=$uName;
                 Yii::app()->session['username']=$admin->id;
				$this->redirect('dashboard',array('model'=>$model));
			}
			else
			{
			    $this->render('index',array('model'=>$model));		
		 	}	
             
			
		} */
		// display the login form
		//$this->render('index',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		

		Yii::app()->user->logout();
         $this->redirect('index');
		//$this->redirect(Yii::app()->homeUrl);
	}

	public function actionDashboard()
	{
		//echo "<pre>";print_r($_SESSION);die;
		$rec=ServiceUser::model()->findAll();
        /*foreach($rec as $re)
        {
        	$name[]=$re['company_name'];

        } */
        //echo "<pre>";print_r($name);die;
		//echo "<pre>";print_r(count($rec));die;
		$customer=CustomerUser::model()->findAll();

        $this->render('dashboard',array('name'=>$rec,'customer'=>$customer));
	}
}
