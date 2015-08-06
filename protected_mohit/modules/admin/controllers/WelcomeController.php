<?php

class WelcomeController extends Controller
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
          'actions'=>array('welcomelisting','logout','login','addwelcomecontent','welcomeedit','AjaxWelcomeStatus','ajaxWelcomeStatusDeactivate','WelcomeView','AjaxDeleteWelcome'),
          'users'=>array('@'),
        ),
        array('deny',  // deny all users
          'users'=>array('*'),
        ),
      );
    }
	// function to show the listing for welcome module starts here

    public function actionWelcomeListing()
    {
    	ob_start();
    	Yii::app()->theme='back';
    	$rec=HomeWelcome::model()->findAll();
        //echo "<pre>";print_r($rec);die; 
    	$this->render('welcomelisting',array('list'=>$rec));
    }
    // function to show the listing for welcome module ends here
     
    // function to add the welcome content starts here 
    public function actionAddWelcomecontent()
    {
    	ob_start();
    	Yii::app()->theme='back';
    	$model=new HomeWelcome;
    	if(isset($_POST['HomeWelcome']))
    	{

            $model->attributes=$_POST['HomeWelcome'];
            $rnd = rand(0,9999);
		    $uploadedFile=CUploadedFile::getInstance($model,'image');
		    $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
            
            if($model->validate())
            {

            	$title=$_REQUEST['HomeWelcome']['title'];
            	$desc=$_REQUEST['HomeWelcome']['desc'];
            	$date=date('Y-m-d');
            	$model->date=$date;
            	if(is_uploaded_file($_FILES['HomeWelcome']['tmp_name']['image']))
	            {	
	            	
	                $model->image = $fileName;
                }
                if($model->save())
                {
                	if(is_uploaded_file($_FILES['HomeWelcome']['tmp_name']['image']))
	                 {
	            	     $uploadedFile->saveAs(Yii::app()->basePath.'/../banner/'.$fileName); 
	            	 }
	            	 $this->redirect(array('welcomelisting'));

                }	
                
            }
            else
            {
              $errors=$model->getErrors();

            }	

    	}	
    	$this->render('addwelcomecontent',array('model'=>$model));
    }
   // function to add the welcome content ends here

    // function to chnage the status of welcome content starts here

    public function actionAjaxWelcomeStatus()
    {

       $id=$_REQUEST['id'];
       $rec=HomeWelcome::model()->findByPk(array('id'=>$id));
       $status=$rec->status;
       if($status==0)
       {
       	   $rec->status=1;
       	   $rec->save();
       	  $res=HomeWelcome::model()->findAll("id <>".$id);
       	   //$res=HomeWelcome::model()->findAll(array('condition'=>'id=:id','params'=>array(':id <>'.$id))); 
		   foreach($res as $r)
		   {
		   	  if($r->status==1)
		   	  {
                  $r->status=0;
                  $r->save();

		   	  }	
		   }        
       	

       }
       else
       { 
           $rec->status=0;
       	   $rec->save();   
       }	

    }
    // function to chnage the status of welcome content ends here

    // function to  deactivate the status of welcome content
    public function actionajaxWelcomeStatusDeactivate()
    {
    	$id=$_REQUEST['id'];
       $rec=HomeWelcome::model()->findByPk(array('id'=>$id));
       $status=$rec->status;
       if($status==1)
       {
       	   $rec->status=0;
       	   $rec->save();
       }
       else
       { 
           $rec->status=1;
       	   $rec->save(); 

       	   
       }	
    }
    // function to deactivate the status of welcome content

    //function to delete the current welcome content starts here
      public function actionAjaxDeleteWelcome()
      {
          $id=$_REQUEST['id'];
    	 //echo $id;die;
    	 $detail=HomeWelcome::model()->findByAttributes(array('id'=>$id));
    	 //echo "<pre>";print_r($detail);die;
    	 $detail->delete();
    	 echo "success";
      }
     
    // function to delete the current welcome content ends here

    //function to edit the welcome content starts here
     
     public function actionWelcomeEdit($id)
     {
         ob_start();
         Yii::app()->theme='back';
         $model=new HomeWelcome;
         $rec=HomeWelcome::model()->findByPk(array('id'=>$id));
         
         if(isset($_POST['HomeWelcome']))
        {
           
        	 $model->attributes=$_POST['HomeWelcome'];
        	 
	         $rnd = rand(0,9999);
		     $uploadedFile=CUploadedFile::getInstance($model,'image');
		     $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
		     
             //echo "<pre>";print_r($_FILES);die;

        	if($model->validate())
        	{
        		    $res=HomeWelcome::model()->findByPk(array('id'=>$id));
		            $title=$_REQUEST['HomeWelcome']['title'];
		            $desc=$_REQUEST['HomeWelcome']['desc']; 
                    
		            $res->title=$title;
		            $res->desc=$desc;
		            
		            if(is_uploaded_file($_FILES['HomeWelcome']['tmp_name']['image']))
		            {	
		            	
		                $res->image = $fileName;
                    }
		            if($res->save())
		            {     
		            	 if(is_uploaded_file($_FILES['HomeWelcome']['tmp_name']['image']))
		                 {
		            	     $uploadedFile->saveAs(Yii::app()->basePath.'/../banner/'.$fileName); 
		            	 }
                         
		            	 $this->redirect(array('welcomelisting'));	
		            }	
              
        	}	
        	else
        	{
        		$errors=$model->getErrors();
        		//var_dump($errors);
        	}	
        } 



         $this->render('welcomeedit',array('edit'=>$rec,'model'=>$model));
     }

    // function to edit the welcome content ends here

     // function to view the details for welcome page starts here
     public function actionWelcomeView($id)
     {
     	ob_start();
     	Yii::app()->theme='back';
     	$rec=HomeWelcome::model()->findByPk($id);
     	$this->render('welcomeview',array('view'=>$rec));
     }
     // function to view the details for welcome page ends here

}