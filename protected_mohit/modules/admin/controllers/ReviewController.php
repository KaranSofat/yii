<?php

class ReviewController extends Controller
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
				'actions'=>array('reviewslisting','Delete','viewreview','ReviewStatus','ReviewDeactivate'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionReviewslisting()
	{
		$model =new ServiceReview;

        $rec   =ServiceReview::model()->findAll();
        //echo "<pre>";print_r($rec);die;
        
		$this->render('reviewslisting',array('model'=>$model,'list'=>$rec));
	}

	// function to delete the review starts here

      /*  public function actionDelete()
        {
        	 $id=$_REQUEST['id'];
	          $detail=ServiceReview::model()->findByAttributes(array('id'=>$id));
	          
	    	 $detail->delete();
	    	 echo "success";
        } */

	 public function actionDelete()
    {
    	 //echo "<pre>";print_r($_REQUEST);die;
    	 $id=$_REQUEST['id'];
    	 $detail=ServiceReview::model()->findByAttributes(array('id'=>$id));
    	 $detail->delete();
    	 echo "success";
    }
	//function to view the reviews
	
	public function actionViewReview($id)
    {
    	
          $viewreview=ServiceReview::model()->findByAttributes(array('id'=>$id));
       // echo "<pre>";print_r($viewreview);die;
        $this->render('viewreview',array('view'=>$viewreview));
    }



        // function to delete the faq ends here


	// function to chnage the status for faq starts here

    	 public function actionReviewStatus()
    	 {
    	 	 $id=$_REQUEST['id'];
	       	 $rec=ServiceReview::model()->findByPk($id);
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

    	 public function actionReviewDeactivate()
    	 {
    	 	  $id=$_REQUEST['id'];
	       	 $rec=ServiceReview::model()->findByPk($id);

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

	

        //function to edit the faq details starts here


        /* public function actionEditReview($id)
         {

         	
         	$model=new ServiceReview;
         	$rec=ServiceReview::model()->findByPk($id);
             
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
	                	$this->redirect(array('reviewslisting'));
	                }	
                }
                else
                {
                	$errors=$model->getErrors();
                	
                }	

            }	

            	
            $this->render('editreview',array('model'=>$model,'edit'=>$rec));


    	 } 

         */
        // function to edit the faq details ends here


}
