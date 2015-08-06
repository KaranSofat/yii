<?php

class WhyusController extends Controller
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
				'actions'=>array('whylisting','logout','login','addwhyuscontent','whyedit','AjaxDeleteWhy','AjaxWhyStatus','AjaxWhyStatusDeactivate'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	} 
	//function to show the listing for why us starts here

     public function actionWhyListing()
     {
     	
     	$model=new WhyUsHome;
     	$rec=WhyUsHome::model()->findAll();


     	$this->render('whylisting',array('list'=>$rec,'model'=>$model));
     }
     //function to show the listing for why us ends here

     //function to add the why us content starts here

     public function actionAddWhyUsContent()
     {

     	
     	$model=new WhyUsHome;
        if(isset($_POST['WhyUsHome']))
    	{
            
            $model->attributes=$_POST['WhyUsHome'];
            $rnd = rand(0,9999);
		    $uploadedFile=CUploadedFile::getInstance($model,'image');
		    $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
            
            if($model->validate())
            {

            	$title=$_REQUEST['WhyUsHome']['title'];
            	$desc=$_REQUEST['WhyUsHome']['desc'];
            	$date=date('Y-m-d');
            	$model->date=$date;
            	if(is_uploaded_file($_FILES['WhyUsHome']['tmp_name']['image']))
	            {	
	            	
	                $model->image = $fileName;
                }
                if($model->save())
                {
                	if(is_uploaded_file($_FILES['WhyUsHome']['tmp_name']['image']))
	                 {
	            	     $uploadedFile->saveAs(Yii::app()->basePath.'/../banner/'.$fileName); 
	            	 }
	            	 $this->redirect(array('whylisting'));

                }	
                
            }
            else
            {
              $errors=$model->getErrors();

            }	

    	}

        $this->render('addwhyuscontent',array('model'=>$model)); 


     }
     // function to add the why us content ends here

     // function to delete the why us content satrts here
      
      public function actionAjaxDeleteWhy()
      {
      	  $id=$_REQUEST['id'];
    	 //echo $id;die;
    	 $detail=WhyUsHome::model()->findByAttributes(array('id'=>$id));
    	 //echo "<pre>";print_r($detail);die;
    	 $detail->delete();
    	 echo "success";

      }

     // function to delete the why us content ends here

      // function to edit the why content starts here

      public function actionWhyEdit($id)
      {

      	
        $model=new WhyUsHome; 
      	$rec=WhyUsHome::model()->findByPk($id);
      	
      	 if(isset($_POST['WhyUsHome']))
        {
           
        	 $model->attributes=$_POST['WhyUsHome'];
        	 
	         $rnd = rand(0,9999);
		     $uploadedFile=CUploadedFile::getInstance($model,'image');
		     $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
		     
             //echo "<pre>";print_r($_FILES);die;

        	if($model->validate())
        	{
        		    $res=WhyUsHome::model()->findByPk(array('id'=>$id));
		            $title=$_REQUEST['WhyUsHome']['title'];
		            $desc=$_REQUEST['WhyUsHome']['desc']; 
                    
		            $res->title=$title;
		            $res->desc=$desc;
		            
		            if(is_uploaded_file($_FILES['WhyUsHome']['tmp_name']['image']))
		            {	
		            	
		                $res->image = $fileName;
                    }
		            if($res->save())
		            {     
		            	 if(is_uploaded_file($_FILES['WhyUsHome']['tmp_name']['image']))
		                 {
		            	     $uploadedFile->saveAs(Yii::app()->basePath.'/../banner/'.$fileName); 
		            	 }
                         
		            	 $this->redirect(array('whylisting'));	
		            }	
              
        	}	
        	else
        	{
        		$errors=$model->getErrors();
        		//var_dump($errors);
        	}	
        } 





      	$this->render('whyedit',array('edit'=>$rec,'model'=>$model));

      }
      // function to edit the why content ends here

      // function to view the why content starts here

      public function actionWhyView($id)
      {
      	
      	$rec=WhyUsHome::model()->findByPk($id);
      	$this->render('whyview',array('view'=>$rec));
      }
      // function to view the why content ends here

      // function to change the status for active why us starts here

      public function actionAjaxWhyStatus()
      {
	       $id=$_REQUEST['id'];
	       $rec=WhyUsHome::model()->findByPk(array('id'=>$id));
	       $status=$rec->status;
	       if($status==0)
	       {
	       	   $rec->status=1;
	       	   $rec->save();
	       	  $res=WhyUsHome::model()->findAll("id <>".$id);
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
      // function to chnage the status for active why us ends here

      // function to chnage the status for deactive why us starts here
      public function actionAjaxWhyStatusDeactivate()
      {
	       $id=$_REQUEST['id'];
	       $rec=WhyUsHome::model()->findByPk(array('id'=>$id));
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
      // function to chnage the status for deactive why us ends here


}