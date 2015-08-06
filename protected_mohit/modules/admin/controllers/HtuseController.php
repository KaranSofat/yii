<?php

class HtuseController extends Controller
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
				'actions'=>array('addhtusecontent','logout','login','htedit','htview','htuselisting','AjaxDeleteHtUse','AjaxHTDeactivate','AjaxHtStatus'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	// function to list the htuse content starts here
       
       public function actionHTUselisting()
       {
       	 
       	 $rec=HtuseHome::model()->findAll();
       	 $this->render('htuselisting',array('list'=>$rec));
       }


       // function to list the htuse content ends here

       // function to add the the how to use content starts here

       public function actionAddHtUseContent()
       {
          
          $model=new HtuseHome;
          
          if(isset($_POST['HtuseHome']))
    	 {
            
	            $model->attributes=$_POST['HtuseHome'];
	            $rnd = rand(0,9999);
			    $uploadedFile=CUploadedFile::getInstance($model,'image');
			    $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
	            
	            if($model->validate())
	            {

	            	$title=$_REQUEST['HtuseHome']['title'];
	            	$desc=$_REQUEST['HtuseHome']['desc'];
	            	$date=date('Y-m-d');
	            	$model->date=$date;
	            	if(is_uploaded_file($_FILES['HtuseHome']['tmp_name']['image']))
		            {	
		            	
		                $model->image = $fileName;
	                }
	                if($model->save())
	                {
	                	if(is_uploaded_file($_FILES['HtuseHome']['tmp_name']['image']))
		                 {
		            	     $uploadedFile->saveAs(Yii::app()->basePath.'/../HowToUseImages/'.$fileName); 
		            	 }
		            	 $this->redirect(array('htuselisting'));

	                }	
	                
	            }
	            else
	            {
	              $errors=$model->getErrors();

	            }	

    	}




          $this->render('addhtusecontent',array('model'=>$model)); 
       
       }

       // function to add the how to use content ends here

       //function to delete how to use record starts here

       public function actionAjaxDeleteHtUse()
       {
       	     $id=$_REQUEST['id'];
	          $detail=HtuseHome::model()->findByAttributes(array('id'=>$id));
	         unlink(Yii::app()->basePath.'/../HowToUseImages/'. $detail->image);
	    	 //echo "<pre>";print_r($detail);die;
	    	 $detail->delete();
	    	 echo "success";
       }
       // function to delete how to use record ends here

       // function to edit the how to use record starts here

       public function actionHtEdit($id)
       {
       	     
             $model=new HtuseHome;
             $rec=HtuseHome::model()->findByPk($id);
              if(isset($_POST['HtuseHome']))
            {
           
		        	 $model->attributes=$_POST['HtuseHome'];
		        	 
			         $rnd = rand(0,9999);
				     $uploadedFile=CUploadedFile::getInstance($model,'image');
				     $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
				     
		             //echo "<pre>";print_r($_FILES);die;

		        	if($model->validate())
		        	{
		        		    $res=HtuseHome::model()->findByPk(array('id'=>$id));
				            $title=$_REQUEST['HtuseHome']['title'];
				            $desc=$_REQUEST['HtuseHome']['desc']; 
		                    
				            $res->title=$title;
				            $res->desc=$desc;
				            
				            if(is_uploaded_file($_FILES['HtuseHome']['tmp_name']['image']))
				            {	
				            	
				                $res->image = $fileName;
		                    }
				            if($res->save())
				            {     
				            	 if(is_uploaded_file($_FILES['HtuseHome']['tmp_name']['image']))
				                 {
				            	     $uploadedFile->saveAs(Yii::app()->basePath.'/../HowToUseImages/'.$fileName); 
				            	 }
		                         
				            	 $this->redirect(array('htuselisting'));	
				            }	
		              
		        	}	
		        	else
		        	{
		        		$errors=$model->getErrors();
		        		//var_dump($errors);
		        	}	
           }
              
           $this->render('htedit',array('edit'=>$rec,'model'=>$model));

       }
       // function to edit the how to use record ends here


       // function to view the how to use starts here

       public function actionHtView($id)
       {
           
           $rec=HtuseHome::model()->findByPk($id);

           $this->render('htview',array('view'=>$rec));

       }
       // function to view the how to use ends here


       // function to active the chnage the status starts here
       
        public function actionAjaxHtStatus()
        {
        	  $id=$_REQUEST['id'];
	       	 $rec=HtuseHome::model()->findByPk($id);

	         if($rec->status==0)
	         {
	            $rec->status=1;
	            $rec->save();
	         } 
	         else
	         {
	         	$rec->status=0;
	            $rec->save();
	         }	
        }  

       // function to active the status ends here

        //function to deactivate the status starts here

        public function actionAjaxHTDeactivate()
        {
        	$id=$_REQUEST['id'];
	       	 $rec=HtuseHome::model()->findByPk($id);

	         if($rec->status==1)
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
        // function to deactivate the status ends here
       
}