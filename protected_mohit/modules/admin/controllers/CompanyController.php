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
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to access all actions
				'actions'=>array('addProvider','providerdetails','providerview','provideredit','export'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}


	public function actionAddProvider()
    {
    	$model=new ServiceUser;
         
        $res=ServiceTypes::model()->findAll();
        $userS=ServiceUser::model()->findAll();


    	if(isset($_POST['Company']))
    	{

            //echo "<pre>";print_r($_POST);die; 

    		$model->attributes = $_POST['ServiceUser'];
    		$model->password = md5($model->password);
    		
    		if($model->validate())
    		{
				if($model->save())
                {
                	 $this->redirect(array('providerdetails'));
                }    
    		}	
    		else
    		{
    			$errors=$model->getErrors();
			}	
    	}	

    	$this->render('addCompany',array('model'=>$model));
    }


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
         
         //echo "<pre>";print_r($rec);die; 

         /*foreach($rec->priceAdmins as $value)
         {
             echo "<pre>";print_r($value);
         }	die; */
         //echo "<pre>";print_r($rec);         
 
        // code to show the messaging section
        $msgDetails=MsgDetails::model()->findAll(array('condition'=>'user_id=:user_id AND tomsg=:tomsg', 'group'   =>'conversation_id','params'=>array(
                                   
                                    ':user_id'=>$rec['id'],
                                    ':tomsg'  =>0,
		
			))); 
		     foreach($msgDetails as $conId)
             {
             	  //echo $conId->conversation_id;
                   $inboxDtal[]=MsgDetails::model()->findAll(array(
                      'condition' => 'conversation_id=:conversation_id AND inbox_dlt_status=:status', 
                      //'group'   =>'conversation_id',                   
                      'params' => array(':conversation_id'=>$conId->conversation_id,':status'=>0),
                    ));  

                    	$companyName=ServiceUser::model()->findAll(array('condition'=>'id=:id','params'=>array(
                               ':id'=>$conId->user_id,

            	  	    )));
            	  	   // echo "<pre>";print_r($companyName);
                   
             } 
        

        $this->render('providerview',array('companyDetail'=>$rec,'inbox'=>$msgDetails,'inboxDtal'=>$inboxDtal));
	}

	//function to view all the details for company ends here

	// function to edit the company details starts here

	public function actionProviderEdit($id)
	{
        
        $model=new ServiceUser;
        $detail=ServiceUser::model()->with('additionalServicePrices')->findByPk(array('id'=>$id));
        
       // echo "<pre>";print_r($detail);die; 
        $additionalService=AdditionalServices::model()->findAll();
        //echo "<pre>";print_r($additionalService);die;
        /*foreach($detail->priceAdmins as $i=>$d)
        {

        	 echo "<pre>";print_r($d);
        }	die;*/
        
        if(isset($_POST['ServiceUser']))
        {
           

            //echo "<pre>";print_r($_REQUEST);die;


        	 $model->attributes=$_POST['ServiceUser'];
        	 
	         $rnd = rand(0,9999);
		     $uploadedFile=CUploadedFile::getInstance($model,'company_logo');
		     $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
		     
             //echo "<pre>";print_r($_FILES);die;

        	if($model->validate())
        	{
        		    $rec=ServiceUser::model()->with('additionalServicePrices')->findByPk(array('id'=>$id));
        		    //echo "<pre>";print_r($_REQUEST);die;
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

                    /*code to save the details for price in db starts here*/
                    foreach($rec->priceAdmins as $editPrice)
                    {
                    	   //echo "<pre>";print_r($editPrice);
                              $editPrice->bedroom=$_REQUEST['PriceAdmin'][$editPrice->service_type_id][0];
                              $editPrice->bathroom=$_REQUEST['PriceAdmin'][$editPrice->service_type_id][1];
                              if(!empty($_REQUEST['PriceAdmin'][$editPrice->service_type_id][2]) || !empty($_REQUEST['PriceAdmin'][$editPrice->service_type_id][3])) 
                              {
	                              $editPrice->property=$_REQUEST['PriceAdmin'][$editPrice->service_type_id][2];
	                              $editPrice->desk=$_REQUEST['PriceAdmin'][$editPrice->service_type_id][3];
	                          }
                              $editPrice->save();
                    } //die;
                    if(empty($rec->additionalServicePrices))
                   {
	                        foreach($additionalService as $i=>$price)
	                   {
	                         $mod= new AdditionalServicePrice;     

	                         $date=date('Y-m-d');
	                         $mod->date=$date;
	                   	     $mod->additional_service_id=$price->id;
	                   	     $mod->price=$_REQUEST['PriceAditional'][$price->service_name];
	                   	     $mod->service_id=$id;
	                   	     $mod->save(false);
	                   }
                   } 	
                   	//die;

                   foreach($rec->additionalServicePrices as $editPrice)
                   {
                   	 //echo "<pre>";print_r($editPrice);
                   	   $serName=$editPrice->additionalService['service_name'];
                   	   $editPrice->price=$_REQUEST['PriceAditional'][$serName];
                   	   $editPrice->save();
                   }	//die;
                    
                      

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
        		//var_dump($errors);
        	}	
        }	

        $this->render('provideredit',array('companyDetail'=>$detail,'model'=>$model,'additionalService'=>$additionalService)); 
	}
	//function to edit the companty details ends here
    
    /*code to export all the details for payment users*/
	public function actionExport()
	{
       
       $re= ServiceUser::model()->with('priceAdmins')->findAll();
      // echo "<pre>";print_r($re);die;
       foreach($re as $res)
       {
       	  
           $compName=$res['company_name'];
           $email   =$res['email'];
           $city    =$res['city'];
           $phone   =$res['phone'];
           $zip     =$res['zipcode'];
           
           
           $company[]=array('Company Name'=>$compName,'Email Address'=>$email,'City'=>$city,'Phone'=>$phone,'Zip'=>$zip,);


       } //die;	//echo "<pre>";print_r($val);die;
        
        $filename="company.csv";
        $csv = new ECSVExport($company);
		$content = $csv->toCSV();   


		                
		Yii::app()->getRequest()->sendFile($filename, $content, "text/csv", false);
		exit();
	 
           

	}
}
