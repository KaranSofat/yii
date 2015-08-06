<?php

class AdditionalservicesController extends Controller
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
        'actions'=>array('additionallisting','logout','login','additionalview','additionalservicedit','AdditionalService','AjaxDeleteAdditionalService','AjaxAdditionalDeactivate','AjaxAdditionalStatus'),
        'users'=>array('@'),
      ),
      array('deny',  // deny all users
        'users'=>array('*'),
      ),
    );
  }

    	// function to list the additional services added by admin starts here

    	 public function actionAdditionalListing()
    	 {
    	 	
            
            $rec=AdditionalServices::model()->findAll();
    	 	$this->render('additionallisting',array('list'=>$rec));
    	 }
    	// function to list the additional services added by admin ends here

    	 //function to add additional service starts here
    	 public function actionAdditionalService()
    	 {
    	 	
    	 	$model=new AdditionalServices;

    	 	if(isset($_POST['AdditionalServices']))
    	 	{
    	 		$model->attributes=$_POST['AdditionalServices'];
    	 		if($model->validate())
    	 		{
                   $date=date('Y-m-d');
                   $model->date=$date;
                   if($model->save())
                   {
                      $this->redirect(array('additionallisting'));
                   } 
    	 		}	
    	 		else
    	 		{
    	 			$errors=$model->getErrors();
    	 		}
    	 	}	

    	 	$this->render('additionalservice',array('model'=>$model));
    	 }
    	 //function to add additional service ends here


    	 //function to delete the additional service starts here

    	 public function actionAjaxDeleteAdditionalService()
    	 {
                 $id=$_REQUEST['id'];
		          $detail=AdditionalServices::model()->findByAttributes(array('id'=>$id));
		          
		    	 $detail->delete();
		    	 echo "success";
    	 }
    	 //function to delete the additional service ends here

    	 //function to edit the detail for additional service starts here

          public function actionAdditionalServicEdit($id)
          {
              
              $model=new AdditionalServices;
              $rec=AdditionalServices::model()->findByPk($id);
              
              if(isset($_POST['AdditionalServices']))
              {

              	   $model->attributes=$_POST['AdditionalServices'];
              	   if($model->validate())
              	   {
                       $res=AdditionalServices::model()->findByPk($id);
                       $name=$_REQUEST['AdditionalServices']['service_name'];
                       $res->service_name            =$name;
                       $res->additional_service_price=$_REQUEST['AdditionalServices']['additional_service_price'];
                       if($res->save())
                       {
                       	 $this->redirect(array('additionallisting'));
                       }

              	   }
              	   else
              	   {
              	   	  $errors=$model->getErrors();
              	   	  //var_dump($errors);

              	   }	
              }	


              $this->render('additionalservicedit',array('edit'=>$rec,'model'=>$model));
          }

    	 // function to edit the detail for additional service ends here 

          //function to view the detail for additional service starts here

          public function actionAdditionalView($id)
          {
              
              $rec=AdditionalServices::model()->findByPk($id);
              //echo "<pre>";print_r($rec);die;
              $this->render('additionalview',array('view'=>$rec));
          }
          //function to view the details for additional service ends here

          // function to change the status for for added service starts here
           public function actionAjaxAdditionalStatus()
           {
           	     $id=$_REQUEST['id'];
		       	 $rec=AdditionalServices::model()->findByPk($id);

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

          // function to chnage the status for added service ends here 

           // function to chnage the status deactivate the service starts here
           
            public function actionAjaxAdditionalDeactivate()
            {
            	 $id=$_REQUEST['id'];
		       	 $rec=AdditionalServices::model()->findByPk($id);

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

           // function to chnage the status deactivate the service ends here



}