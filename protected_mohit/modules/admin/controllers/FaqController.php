<?php

class FaqController extends Controller
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
				'actions'=>array('faqlisting','logout','login','addfaq','editfaq','faqview','AjaxDeleteFaq','AjaxFaqStatus','AjaxFaqDeactivate'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	// function to show thw listing for faq content

       public function actionFaqListing()
       {
           
           $model=new Faq;
           $rec=Faq::model()->findAll();
           $this->render('faqlisting',array('model'=>$model,'list'=>$rec));

       }
       // function to show the faq listing ends here

       // function to add the faq content starts here
        
        public function actionAddFaq()
        {

        	
        	$model=new Faq;

        	 if(isset($_POST['Faq']))
    	    {
            
		            $model->attributes=$_POST['Faq'];
		            
		            if($model->validate())
		            {

		            	$q=$_REQUEST['Faq']['question'];
		            	$desc=$_REQUEST['Faq']['answer'];
		            	$date=date('Y-m-d');
		            	$model->date=$date;
		            	
		                if($model->save(false))
		                {
		                	
			            	 $this->redirect(array('faqlisting'));

		                }	
		                
		            }
		            else
		            {
		              $errors=$model->getErrors();
                       //var_dump($errors);
		            }	

    	   }
        	$this->render('addfaq',array('model'=>$model));
        }

       // function to add the faq content ends here

        // function to delete the faq starts here

        public function actionAjaxDeleteFaq()
        {
        	 $id=$_REQUEST['id'];
	          $detail=Faq::model()->findByAttributes(array('id'=>$id));
	          
	    	 $detail->delete();
	    	 echo "success";
        }
        // function to delete the faq ends here


        //function to edit the faq details starts here


         public function actionEditFaq($id)
         {

         	
         	$model=new Faq;
         	$rec=Faq::model()->findByPk($id);
             
            if(isset($_POST['Faq']))
            {
                
                $model->attributes=$_POST['Faq'];
                if($model->validate())
                {	
	                $q=$_REQUEST['Faq']['question'];
	                $ans=$_REQUEST['Faq']['answer'];

	                $res=Faq::model()->findByPk($id);

	                $res->question=$q;
	                $res->answer=$ans;
	                if($res->save(false))
	                {
	                	$this->redirect(array('faqlisting'));
	                }	
                }
                else
                {
                	$errors=$model->getErrors();
                	
                }	

            }	

            	
            $this->render('editfaq',array('model'=>$model,'edit'=>$rec));


    	 } 

         
        // function to edit the faq details ends here


       // function to chnage the status for faq starts here

    	 public function actionAjaxFaqStatus()
    	 {
    	 	 $id=$_REQUEST['id'];
	       	 $rec=Faq::model()->findByPk($id);
             //echo "<pre>";print_r($rec);die;
	         if($rec->status==0)
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
      //  function to change the status for faq ends here	

      // function to change the status deactivate starts here

    	 public function actionAjaxFaqDeactivate()
    	 {
    	 	  $id=$_REQUEST['id'];
	       	 $rec=Faq::model()->findByPk($id);

	         if($rec->status==1)
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
      // function to change the status deactivate ends here 

      // function to view the detail for faq starts here
      
      public function actionFaqView($id)
      {
      	
      	$rec=Faq::model()->findByPk($id);

      	$this->render('faqview',array('view'=>$rec));
      }

      // function to view the detail for faq ends here	 

}