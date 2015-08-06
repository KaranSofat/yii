<?php

class CompanyController extends Controller
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
	  public function actionProviderDetails()
    {
       ob_start();
	   Yii::app()->theme='back';
       $model=new ServiceUser;

        //echo "Mohit";die; 
       $user=ServiceUser::model()->findAll();
       $this->render('providerlist',array('list'=>$user));
    } 
	
	 // function to delete the company details starts here
	public function actiondeleteprovider()
	{
		 $id=$_REQUEST['id'];
    	 //echo $id;die;
    	 $detail=ServiceUser::model()->findByAttributes(array('id'=>$id));
    	 //echo "<pre>";print_r($detail);die;
    	 $detail->delete();
    	 echo "success";
	}
	// function to delete the company details ends here 

	//function to view all the details for company starts here

	public function actionProviderView($id)
	{
		

        $rec=ServiceUser::model()->with('servicePrices','serviceImages')->findByPk(array('id'=>$id));
        
        if(!empty($rec->servicePrices))
        {
                   foreach($rec->servicePrices as $viewProvider)
			        {
			            $priceDetail[]=$viewProvider;
			        } 
        
			        foreach($priceDetail as $findServiceTypes)
			        {
			          $serviceTypes[]=$findServiceTypes->service_type_id;	
			        }	
			         
         
			        $unqService=array_unique($serviceTypes);
			       
			        foreach($unqService as $u)
			        {	
			           $service=ServiceTypes::model()->findAll(array('condition'=>'id=:id','params'=>array(':id'=>$u))); 
			        
			           foreach($service as $Service)
			            {
			            	$AllService[]=$Service->service_name;
			            	//echo "<pre>";print_r($res);
			            }	


			        } 
        

        }	
        
        if(!empty($priceDetail) && !empty($AllService))
        { 
   		   $this->render('providerview',array('companyDetail'=>$rec,'price'=>$priceDetail,'service'=>$AllService));
	
        }
        else
        {
           $this->render('providerview',array('companyDetail'=>$rec));
	    	
        } 
	}

	//function to view all the details for company ends here

	// function to edit the company details starts here

	public function actionProviderEdit($id)
	{
        
        $model=new ServiceUser;
        $detail=ServiceUser::model()->with('servicePrices')->findByPk(array('id'=>$id));
        
        if(isset($_POST['ServiceUser']))
        {
           
        	 $model->attributes=$_POST['ServiceUser'];
        	 
	         $rnd = rand(0,9999);
		     $uploadedFile=CUploadedFile::getInstance($model,'company_logo');
		     $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
		     
             //echo "<pre>";print_r($_FILES);die;

        	if($model->validate())
        	{
        		    $rec=ServiceUser::model()->with('servicePrices')->findByPk(array('id'=>$id));
		            $cname=$_REQUEST['ServiceUser']['company_name'];
		            $city=$_REQUEST['ServiceUser']['city'];
		            $zip=$_REQUEST['ServiceUser']['zipcode']; 
                    
                    

		            $rec->company_name=$cname;
		            $rec->city=$city;
		            $rec->zipcode=$zip;
		            if(is_uploaded_file($_FILES['ServiceUser']['tmp_name']['company_logo']))
		            {	
		            	
		                $rec->company_logo = $fileName;
                    }
		            if($rec->save())
		            {     
		            	 if(is_uploaded_file($_FILES['ServiceUser']['tmp_name']['company_logo']))
		                 {
		            	     $uploadedFile->saveAs(Yii::app()->basePath.'/../CompanyLogo/'.$fileName); 
		            	 }
                         
		            	 $this->redirect(array('providerdetails'));	
		            }	
              
        	}	
        	else
        	{
        		$errors=$model->getErrors();
        		var_dump($errors);
        	}	
        }	

        $this->render('provideredit',array('companyDetail'=>$detail,'model'=>$model)); 
	}
	//function to edit the companty details ends here

}