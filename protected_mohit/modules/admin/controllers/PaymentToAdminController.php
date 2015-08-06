<?php

class PaymentToAdminController extends Controller
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
          'actions'=>array('paymentpercentagelisting','addpaymentpercentage','edit','view','ajaxDeactivate','ajaxActive','ajaxdelete'),
          'users'=>array('@'),
        ),
        array('deny',  // deny all users
          'users'=>array('*'),
        ),
      );
    }
	 // function to list the all images starts here

      public function actionPaymentpercentagelisting()
      {
      	 
      	 $model=new PaymentToAdmin;
          
         $rec= PaymentToAdmin::model()->findAll(); 
      	 $this->render('paymentpercentagelisting',array('model'=>$model,'list'=>$rec));
      } 
      // function to add  the percentage for cuatomer

      public function actionAddpaymentpercentage()
      {
      	     $model=new PaymentToAdmin; 
      	    if(isset($_POST['PaymentToAdmin']))
    	    {
    	    	 //echo "<pre>";print_r($_REQUEST);die;
            
		            $model->attributes=$_POST['PaymentToAdmin'];
		            
		            if($model->validate())
		            {
		                        $q     =$_REQUEST['PaymentToAdmin']['cost_percentage'];
				            	
				            	$date  =date('Y-m-d');
				            	$model->date=$date;
				            	if($model->save(false))
		                        {
		                	
			            	        $this->redirect(array('paymentpercentagelisting'));

		                        }
		            }
		     }
		     else 
		     {
                $errors=$model->getErrors();
		     }       	

      	$this->render('addpaymentpercentage',array('model'=>$model));
      }
      // function to edit the code
      public function actionEdit($id)
      {
           $model=new PaymentToAdmin; 
           $rec=PaymentToAdmin::model()->findByPk($id);
           if(isset($_POST['PaymentToAdmin']))
           {
           	   $model->attributes=$_POST['PaymentToAdmin'];
           	   if($model->validate())
           	   {
                   $res                   =PaymentToAdmin::model()->findByPk($id);
                   $res->cost_percentage  =$_REQUEST['PaymentToAdmin']['cost_percentage'];

                   if($res->save())
		            {     
		            	                        
		            	 $this->redirect(array('paymentpercentagelisting'));	
		            }
           	   }
           	   else
           	   {
                  $errors=$model->getErrors();
           	   }
           }
          $this->render('edit',array('model'=>$model,'edit'=>$rec));  
      }
      //function to view the  percentage add
      public function actionView($id)
      {
      	   $model =new PaymentToAdmin;
      	   $rec   =PaymentToAdmin::model()->findByPk($id);
      	   $this->render('view',array('model'=>$model,'view'=>$rec)); 
      }	
      // function to chnage the status 
      public function actionAjaxActive()
      {
            
           $id=$_REQUEST['id'];
          
	       $rec=PaymentToAdmin::model()->findByPk(array('id'=>$id));
	       $status=$rec->status;
	       if($status==0)
	       {
	       	   $rec->status=1;
	       	   $rec->save();
	       	  $res=PaymentToAdmin::model()->findAll("id <>".$id);
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

      //function to chnage the status
       public function actionAjaxDeactivate()
       {
       	   $id=$_REQUEST['id'];
	       $rec=PaymentToAdmin::model()->findByPk(array('id'=>$id));
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

       // function to delete the record
       public function actionAjaxDelete()
       {
	       	  $id=$_REQUEST['id'];
	    	 //echo $id;die;
	    	 $detail=PaymentToAdmin::model()->findByAttributes(array('id'=>$id));
	    	 //echo "<pre>";print_r($detail);die;
	    	 $detail->delete();
	    	 echo "success";
       } 

}