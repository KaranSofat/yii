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
		

        //$rec=ServiceUser::model()->with('servicePrices','serviceImages','priceAdmins')->findByPk(array('id'=>$id));
        
        //echo "<pre>";print_r($rec);die;

       /* if(!empty($rec->servicePrices))
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
	    	
        }*/
        
        $rec=ServiceUser::model()->with('serviceImages','priceAdmins')->findByPk(array('id'=>$id));
         
        

        $this->render('providerview',array('companyDetail'=>$rec));
	}

	//function to view all the details for company ends here

	// function to edit the company details starts here

	public function actionProviderEdit($id)
	{
        
        $model=new ServiceUser;
        $detail=ServiceUser::model()->with('servicePrices')->findByPk(array('id'=>$id));

        /*foreach($detail->priceAdmins as $i=>$d)
        {

        	 echo "<pre>";print_r($d);
        }	die;*/
        
        if(isset($_POST['ServiceUser']))
        {
           

            // echo "<pre>";print_r($_REQUEST);die;


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
                    $phone=$_REQUEST['ServiceUser']['phone'];
                    
                    $rec->phone=$phone;
		            $rec->company_name=$cname;
		            $rec->city=$city;
		            $rec->zipcode=$zip;
		            if(is_uploaded_file($_FILES['ServiceUser']['tmp_name']['company_logo']))
		            {	
		            	
		                $rec->company_logo = $fileName;
                    }

                    /*code to save the details for price in db starts here*/
                    foreach($rec->priceAdmins as $editPrice)
                    {
                              $editPrice->bedroom=$_REQUEST['PriceAdmin'][$editPrice->service_type_id][0];
                              $editPrice->bathroom=$_REQUEST['PriceAdmin'][$editPrice->service_type_id][1];
                              if(!empty($_REQUEST['PriceAdmin'][$editPrice->service_type_id][2]) || !empty($_REQUEST['PriceAdmin'][$editPrice->service_type_id][3])) 
                              {
	                              $editPrice->property=$_REQUEST['PriceAdmin'][$editPrice->service_type_id][2];
	                              $editPrice->desk=$_REQUEST['PriceAdmin'][$editPrice->service_type_id][3];
	                          }
                              $editPrice->save();
                    } //die;

                      

                    /*code to save the details for price in db ends here*/

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