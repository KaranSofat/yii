<?php

class ImagesController extends Controller
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
          'actions'=>array('imagelisting','logout','login','addhomeimage','image','AjaxDeleteHomeImage','HomeImageView','AjaxImageActive','AjaxImageDeactivate'),
          'users'=>array('@'),
        ),
        array('deny',  // deny all users
          'users'=>array('*'),
        ),
      );
    }
	 // function to list the all images starts here

      public function actionImageListing()
      {
      	 
      	 $model=new HomeImages;
          
         $rec= HomeImages::model()->findAll(); 
      	 $this->render('imagelisting',array('model'=>$model,'list'=>$rec));
      } 
      // function to list the all images ends here

      // function to add image for home page starts here

      public function actionAddHomeImage()
      {
      	
      	$model=new HomeImages;
      	
        if(isset($_POST['HomeImages']))
    	{

            $model->attributes=$_POST['HomeImages'];
            $rnd = rand(0,9999);
		    $uploadedFile=CUploadedFile::getInstance($model,'image');
		    $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
            
            if(is_uploaded_file($_FILES['HomeImages']['tmp_name']['image']))
	        {

            	$url=$_REQUEST['HomeImages']['url'];
            	
            	$date=date('Y-m-d');
            	$model->date=$date;
            	$model->image = $fileName;
                
                if($model->save())
                {
                	
	            	 $uploadedFile->saveAs(Yii::app()->basePath.'/../HomeImages/'.$fileName); 
	            	
	            	 $this->redirect(array('imagelisting'));

                }	
                
            }
            else
            {
              //$errors=$model->getErrors();
               Yii::app()->user->setFlash('success', "Please Upload Image!"); 
            }	


    	} 



      	$this->render('addhomeimage',array('model'=>$model));
      }
      // function to add image for home page ends here

      // function to delete the home image starts here
      public function actionAjaxDeleteHomeImage()
      {
          $id=$_REQUEST['id'];
          $detail=HomeImages::model()->findByAttributes(array('id'=>$id));
          unlink(Yii::app()->basePath.'/../HomeImages/'. $detail->image);
    	 //echo "<pre>";print_r($detail);die;
    	 $detail->delete();
    	 echo "success";
      }
      // function to delete the home image ends here

      // function to view the home image starts here

      public function actionHomeImageView($id)
      {
      	

      	$rec=HomeImages::model()->findByPk($id);
      	//echo "<pre>";print_r($rec);die;
      	$this->render('homeimageview',array('view'=>$rec));

      }
      // function to view the home image ends here

      // function to edit the current image starts  here

       public function actionImage($id)
       {
          
          $model=new HomeImages;
          //echo $id;die;
          $rec=HomeImages::model()->findByPk($id);
          if(isset($_POST['HomeImages']))
    	  {

            $model->attributes=$_POST['HomeImages'];
            $rnd = rand(0,9999);
		    $uploadedFile=CUploadedFile::getInstance($model,'image');
		    $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
            
            if(is_uploaded_file($_FILES['HomeImages']['tmp_name']['image']))
	        {

            	$url=$_REQUEST['HomeImages']['url'];
            	$res=HomeImages::model()->findByPk($id);
            	$date=date('Y-m-d');
            	$res->url=$url;  
            	$res->image = $fileName;
                
                if($res->save())
                {
                	
	            	 $uploadedFile->saveAs(Yii::app()->basePath.'/../HomeImages/'.$fileName); 
	            	
	            	 $this->redirect(array('imagelisting'));

                }	
                
            }
            else
            {
              //$errors=$model->getErrors();
               Yii::app()->user->setFlash('success', "Please Upload Image!"); 
            }	


    	} 


          $this->render('image',array('edit'=>$rec,'model'=>$model));
       }

      //function to edit the current image ends here

       // function to change the status for image to active starts here

       public function actionAjaxImageActive()
       {
       	 $id=$_REQUEST['id'];
       	 $rec=HomeImages::model()->findByPk($id);

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
       // function to chnage the status for image to active ends here

       //function to change the status for image to deactivate

       public function actionAjaxImageDeactivate()
       {
	       	 $id=$_REQUEST['id'];
	       	 $rec=HomeImages::model()->findByPk($id);

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
       //function to change the status for image to deactivate ends her

}