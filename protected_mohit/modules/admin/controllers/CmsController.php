<?php

class CmsController extends Controller
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
        'actions'=>array('cms','logout','login','cmsview','cmslisting','cmsedit'),
        'users'=>array('@'),
      ),
      array('deny',  // deny all users
        'users'=>array('*'),
      ),
    );
  }



	// function to add cms page starts here
	public function actionCms()
	{
        
        $model=new CmsPages;
        
		if(isset($_POST['CmsPages']))
		{	
            	           

                      if($model->validate())
                       $this->redirect(Yii::app()->cms->returnUrl);
                       //echo "<pre>";print_r($_REQUEST);die;
                       if(!empty($_REQUEST['CmsPages']['title']))
                       {	
                       	   
                       	   
                       	   //echo "<pre>";print_r($_REQUEST);die;
                       	   $title=$_REQUEST['CmsPages']['title'];
                       	   $meta=$_REQUEST['CmsPages']['meta_title'];
			               $desc=$_REQUEST['CmsPages']['desc'];
			               $date=date('Y-m-d');

			               $model->title=$title;
			               $model->meta_title=$meta;
			               $model->desc=$desc;
			               $model->date=date('Y-m-d');
			               //$model->save(false);
			               
			               if($model->save(false))
			               {
			               	   $this->redirect('cmslisting');
   			               }
			            
                       }
                   

        } 
        
		    $this->render('cms',array('model'=>$model));
	   
	}
	
    public function actionDelete()
    {
    	 //echo "<pre>";print_r($_REQUEST);die;
    	 $id=$_REQUEST['id'];
    	 $detail=CmsPages::model()->findByAttributes(array('id'=>$id));
    	 $detail->delete();
    	 echo "success";
    }

    public function actionCmsView($id)
    {
    	
          
		$cmsview=CmsPages::model()->findByAttributes(array('id'=>$id));
        //echo "<pre>";print_r($cmsview);die;
        $this->render('cmsview',array('view'=>$cmsview));
    }
    public function actionCmsEdit($id)
    {
        
		$model=new CmsPages;

        // echo "<pre>";print_r($_REQUEST);die;
		$cmsedit=CmsPages::model()->findByAttributes(array('id'=>$id));
		// echo "<pre>";print_r($_REQUEST);die; 
		if(isset($_POST['CmsPages']))
		{

			 $model->attributes=$_POST['CmsPages'];
			 if($model->validate())
			 {

			 	$res=CMSPages::model()->findByAttributes(array('id'=>$id));
			 	$title=$_REQUEST['CmsPages']['title'];
                $meta=$_REQUEST['CmsPages']['meta_title'];
                $desc=$_REQUEST['CmsPages']['desc'];
			 	
			 	$res->title=$title;
			 	$res->meta_title=$meta;
			 	$res->desc=$desc;
                if($res->save())
                {
                	$this->redirect(array('cmslisting'));
                	
                } 
			 	
			 }
			 else
			 {
			 	$errors=$model->getErrors();
			 	var_dump($errors);
			 }	
		}	
		
        
        $this->render('cmsedit',array('edit'=>$cmsedit,'model'=>$model));
    }
     

	public function actionCmslisting()
	{
		
        $model=new CmsPages;
       
		$listing=CMSPages::model()->findAll();
        
		$this->render('cmslisting',array('list'=>$listing));
	}
    
     // function to change the status for cms page starts here
       
     public function actionajaxCmsActive()
     {
     	$id=$_REQUEST['id'];
     	
     	$rec=CmsPages::model()->findByPk($id);
        $status=$rec->status;
        //echo $status;die;
        if($status==0)
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


     // function to chnage the status for cms page ends here 
     

     // function to set the status 0 for cms page starts here

      public function actionAjaxCmsDeactivate()
      {

      	   $id=$_REQUEST['id'];
     	
     	$rec=CmsPages::model()->findByPk($id);
        $status=$rec->status;
        //echo $status;die;
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


     // function to set the status 0 for cms page ends here

}