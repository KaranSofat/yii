<?php

class ServicetypeController extends Controller
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
				'actions'=>array('servicetypelisting','logout','login','addservicetype','servicetypeedit','servicetypeview','AjaxServiceTypeDelete','ajaxServiceTypeStatus','AjaxServiceTypeStatusDeactivate','Addservicetypeadditional','Additionalservicelisting','Editadditional','Viewadditional','Ajaxadditionaldlt','AjaxAdditionalStatus','AjaxAdditionalDeactivate'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	 public function actionserviceTypeListing()
	{
         $res=ServiceTypes::model()->findAll();
         //echo "<pre>";print_r($res);die;
         $this->render('servicetypelisting',array('list'=>$res));
	}

	public function actionAddserviceType()
	{
		  
         $model=new ServiceTypes;
        // echo "<pre>";print_r($_REQUEST);die;
           if(isset($_POST['ServiceTypes']))
           {

                /*$path = Yii::app()->basePath . '/../uploads';
		        if (!is_dir($path)) {
		            mkdir($path);
		        }*/
                 // echo "<pre>";print_r($_REQUEST);die;
                  
                   $model->attributes=$_POST['ServiceTypes'];
                   $rnd = rand(0,9999);
                   $uploadedFile=CUploadedFile::getInstance($model,'image');
                   $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                   //$model->image = $fileName;
                    
                   //echo $fileName;die;

	             if($model->validate())
	             {
                 
	                 //echo "<pre>";print_r($_FILES);    
		             $date=date('Y-m-d');
		             $model->service_name=$_REQUEST['ServiceTypes']['service_name'];
		             $model->date=$date;
		             if(is_uploaded_file($_FILES['ServiceTypes']['tmp_name']['image']))
		             {
		             	
                         $model->image = $fileName;  
                      }
		             //echo Yii::app()->basePath . '/ServiceImages'.$fileName;die;
	                 if($model->save())
	                 {   
	                 	 if(is_uploaded_file($_FILES['ServiceTypes']['tmp_name']['image']))
		                 {
	                 	      $uploadedFile->saveAs(Yii::app()->basePath.'/../banner/'.$fileName);  
	                     } 

	                     $this->redirect('servicetypelisting');
	                 }	
	                 

                 }	
	             else
	             {
	             	 
	             	$errors=$model->getErrors();
	             	// var_dump($errors); 
	             }	

         }	
         
         $this->render('addservicetype',array('model'=>$model));
         
	}

	public function actionAjaxServiceTypeDelete()
	{
		//echo "<pre>";print_r($_REQUEST);die;
         
    	 $id=$_REQUEST['id'];
	     $detail=ServiceTypes::model()->findByAttributes(array('id'=>$id));
	          
	     $detail->delete();
	     echo "success";

	}

	public function actionServiceTypeView($id)
	{
         
         $rec=ServiceTypes::model()->findByPk(array('id'=>$id));

         $this->render('servicetypeview',array('view'=>$rec));
          
	}
     
    //function to edit the details for service type starts here
    public function actionServiceTypeEdit($id)
    {
    	
        $model=new ServiceTypes;

    	$rec=ServiceTypes::model()->findByPk(array('id'=>$id));
        //echo "<pre>";print_r($rec);die;

        if(isset($_POST['ServiceTypes']))
        {
        	$model->attributes=$_POST['ServiceTypes'];
        	 
	         $rnd = rand(0,9999);
		     $uploadedFile=CUploadedFile::getInstance($model,'image');
		     $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
		     //echo $fileName;die;
             //echo "<pre>";print_r($_FILES);die;

        	if($model->validate())
        	{
        		    $rec=ServiceTypes::model()->findByPk(array('id'=>$id));
		            $service=$_REQUEST['ServiceTypes']['service_name'];
		            //$city=$_REQUEST['ServiceTypes']['city'];
		            $desc=$_REQUEST['ServiceTypes']['desc']; 
                    
                    

		            $rec->service_name=$service;
		            
		            $rec->desc=$desc;
		            if(is_uploaded_file($_FILES['ServiceTypes']['tmp_name']['image']))
		            {	
		            	
		                $rec->image = $fileName;
                    }
		            if($rec->save())
		            {     
		            	 if(is_uploaded_file($_FILES['ServiceTypes']['tmp_name']['image']))
		                 {
		            	     $uploadedFile->saveAs(Yii::app()->basePath.'/../banner/'.$fileName); 
		            	 }
                         
		            	 $this->redirect(array('servicetypelisting'));	
		            }	
              
        	}	
        	else
        	{
        		$errors=$model->getErrors();
        		var_dump($errors);
        	}	
        }	
    	
    	$this->render('servicetypedit',array('detail'=>$rec,'model'=>$model));

    }
    //function to edit the details for service type ends here
    

    // function to change the status for service type starts here
     
     public function actionajaxServiceTypeStatus()
     {
     	 //echo "<pre>";print_r($_REQUEST);die;
     	 $id=$_REQUEST['id'];
     	 $rec=ServiceTypes::model()->findByPk($id);
     	 $status=$rec->status;
         
         if($status==0)
         {
         	 $rec->status=1;
         	 $rec->save(false);

         }	
         else
         {
         	 $rec->status=0;
         	 $rec->save();

         }


     }
      

    // function to change the status for service type ends here

     // function to change the status deactivate for service type starts here
      
      public function actionAjaxServiceTypeStatusDeactivate()
      {
         $id=$_REQUEST['id'];
     	 $rec=ServiceTypes::model()->findByPk($id);
     	 $status=$rec->status;
         
         if($status==1)
         {
         	 $rec->status=0;
         	 $rec->save(false);

         }	
         else
         {
         	 $rec->status=1;
         	 $rec->save();

         }


      }



     // function to add the additional service for particular service type

     public function actionAddservicetypeadditional()
     {
     	$model=new ServicetypeAdditionalservices; 
     	$service_type_id=$_REQUEST['id'];
     	//echo "<pre>";print_r($_REQUEST);die;
      $servType=ServiceTypes::model()->findByPk(array('id'=>$service_type_id));
      $type    =$servType['service_name'];
     	if(isset($_POST['ServicetypeAdditionalservices']))
     	{
           $model->attributes=$_POST['ServicetypeAdditionalservices'];
           if($model->validate())
           {
              $model->date            =date('Y-m-d');
              $model->service_type_id =$service_type_id;
              if($model->save(false))
              {
              	 //$this->redirect(array('servicetypelisting'));
                 $this->redirect(array('additionalservicelisting','id'=>$service_type_id));
              }	
           }
           else
           {
           	    $errors=$model->getErrors();
        		var_dump($errors);
           }	
     	}	
     	$this->render('addservicetypeadditional',array('model'=>$model,'type'=>$type));
     } 

     //function to show the listing for additioanl service of particular service type
     public function actionAdditionalservicelisting($id)
     {
     	//echo $id;die;
      $servType=ServiceTypes::model()->findByPk(array('id'=>$id));
      $type    =$servType['service_name'];
     	$listing=ServicetypeAdditionalservices::model()->findAll(array(
                      'condition' => 'service_type_id=:id', 
                      //'group'   =>'conversation_id',                   
                      'params' => array(':id'=>$id,),
                    )); 
     	
     	$this->render('additionalservicelisting',array('list'=>$listing,'type'=>$type));
     } 

     //function to edit the detail for additional service of a particular service
     public function actionEditadditional($id)
     {
        $model  =new ServicetypeAdditionalservices;
        $record =ServicetypeAdditionalservices::model()->findbyPk($id);
        //echo "<pre>";print_r($record);die;
        if(isset($_POST['ServicetypeAdditionalservices']))
        {
             $model->attributes=$_POST['ServicetypeAdditionalservices'];
             if($model->validate())
             {
                 //echo "<pre>";print_r($_REQUEST);die; 
                 $rec                         =ServicetypeAdditionalservices::model()->findbyPk($id);
                 $serviceName                 =$_REQUEST['ServicetypeAdditionalservices']['additional_service_name'];
                 $price                       =$_REQUEST['ServicetypeAdditionalservices']['additional_service_price'];

                 $rec->additional_service_name=$serviceName;
                 $rec->additional_service_price=$price;
                 if($rec->save(false))
                 {
                     $this->redirect(array('additionalservicelisting','id'=>$record->service_type_id));
                 }
             }  
             else
             {
                 $errors=$model->getErrors();

             }
        }  

        $this->render('editadditional',array('model'=>$model,'detail'=>$record));

     }

     //code to get the view detail for additional service
     public function actionViewadditional($id)
     {
         $rec=ServicetypeAdditionalservices::model()->findByPk(array('id'=>$id));

         $this->render('viewadditional',array('view'=>$rec));

         
     }

     // code to delete the additional service for particular service type
     public function actionAjaxadditionaldlt()
     {
          $id=$_REQUEST['id'];
          $deta=ServicetypeAdditionalservices::model()->findByAttributes(array('id'=>$id));
            
          $deta->delete();
          echo "success";
     }

     // code to chnage the status for additional service activate
     public function actionAjaxAdditionalStatus()
    {
        $id=$_REQUEST['id'];
        $rec=ServicetypeAdditionalservices::model()->findByPk($id);
        $status=$rec->status;
         
         if($status==0)
         {
           $rec->status=1;
           $rec->save(false);

         }  
         else
         {
           $rec->status=0;
           $rec->save();

         }
    }
    // code to chnage the status for additional service 

    public function actionAjaxAdditionalDeactivate()
    {
           $id=$_REQUEST['id'];
           $rec=ServicetypeAdditionalservices::model()->findByPk($id);
           $status=$rec->status;
         
           if($status==1)
           {
             $rec->status=0;
             $rec->save(false);

           }  
           else
           {
             $rec->status=1;
             $rec->save();

           }
    }



}