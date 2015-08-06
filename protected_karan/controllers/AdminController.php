<?php

class AdminController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
	 // die('hello');
	
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('login');
	}
  public function actionUsers()
	{
	  $model = new Users();
	  $users = Users::model()->findAll();
	
	
	 $this->render('view',array('users'=>$users));
	
	}
	 public function actionAddData()
	{
	  $model = new Users;
	
    if(isset($_POST['name']))
    {
	    $model->name = $_REQUEST['name'];
	      $model->email = $_REQUEST['email'];
	      $model->password = $_REQUEST['password'];
	      $model->state = $_REQUEST['state'];
	      $model->city = $_REQUEST['city'];
	      $model->image = $_FILES['image']['name'];
	       
	      // echo $file;die;
			   $file1  = $_FILES['image']['tmp_name'];  
    			move_uploaded_file($_FILES["image"]["tmp_name"],
      			"upload/" . $_FILES["image"]["name"]);
      			
      			 
          //  $uploadedFile->saveAs(Yii::app()->basePath.'/../banner/'.$model->image);
              
      			
	      if($model->save(false))
	      {
	        
	      
	         $this->redirect('users');
	      }
	    
	    
	 } 
	
	 $this->render('addUsers',array('model'=>$model));
	
	}
	
	    public function actionEditUser($id)
       {
          $model = new Users;
          	$rec=Users::model()->findByPk($id);
	
          if(isset($_POST['name']))
          {
            // echo"a";die;
	            $rec->name = $_REQUEST['name'];
	            $rec->email = $_REQUEST['email'];
	            $rec->password = $_REQUEST['password'];
	            $rec->state = $_REQUEST['state'];
	            $rec->city = $_REQUEST['city'];
	         
	          if($rec->save(false))
	          {
	             
	             //echo"success";
	             $this->redirect(array('users'));
	          }
	            
	        }
          $this->render('editUser',array('rec'=>$rec));
       } 
	
	

   public function actionDeleteData($id)
   {
   $detail=Users::model()->findByAttributes(array('id'=>$id));
	          
	    	 $detail->delete();
        $this->redirect('users');
   }
       public function actionViewData($id)
       {
          $rec=Users::model()->findByPk($id);

      	$this->render('viewUser',array('view'=>$rec));
       
       }
         public function actionLogin()
         {
             $this->layout=' ';
        
             $model = new Users();
          
            if(isset($_POST['username']))
            {
             
                 $username = $_REQUEST['username'];
              
                  $rec= Users::model()->findByAttributes(array('email'=>$username));
//echo"<pre>";print_r($rec);die;
                 
                 
                  if($rec) 
                  {       
             
                       Yii::app()->session['userId']=$rec->id;
	                     $this->redirect('dashboard');
	                }
	                else
	                {
	                   //echo"a";die;
	                  //$this->render('login');
	               
	                }     
               
            }  
          
            	$this->render('login');
         
         }
         public function actionDashboard()
         {
           $this->render('dashboard');
         
         }
         
         
         
         
  
}
