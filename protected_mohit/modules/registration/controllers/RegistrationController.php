<?php

class RegistrationController extends Controller
{
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
				'actions'=>array('index','registration','login'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated users to access all actions
				'actions'=>array('dashboard','customerdashboard','logout','updateProfile','Profile','rating','addreview','sendmessage','deleteMsgCompDashboard','replyfromCompany','createmsgFromCompany','replyfromCustomer','deleteMsgCustomerDashboard','DltSentboxCustomerDashboard','DeleteInboxMsgCustomerDashboard','DltSentboxCompanyDashboard','MsgNotiCompany','Relist','AutoRelistJobActiveTab','AutoChkMsgNotiComp','StatusForNewRequestsCompany','ActiveJobsInCompany','Edit','Viewquotes','EditJobQuoteCustomer','ViewquotesDashboard','StatusForNewRequestsCustomer','StatusTypeCompany','UpdatePriceforspecificCustomer','ChnagequotesDashboardSpeciUser','AjaxupdatePrice','ChangestatusServiceByCompany','UpdateGlobalPriceByCompany','SaveGlobalAddiSer','DeclineNewRequestsCustomer','declineNewRequestsCompany','AjaxServiceTypeFieldName','AddCompanyPrice','SaveAdnlPriceCompany','ActiveJobsAddMsgCompany','ActiveJobsMsgList','ActiveJobsCustomerMsgList','ActiveJobsAddMsgCustomer','TicketAddCustomer','TicketCustomerMsgList','replyticketfromCustomer','TicketAddProvider','TicketProviderMsgList','replyticketfromProvider','AddCompanyPriceEndTenancy','AddCompanyPriceDomestic','AddCompanyPriceOffice','JobRequestResPage','updatePriceForQuote','DistanceCoverage','RelistJobCompany','JobsRequestTabRelistJob'),

				'users'=>array('@'),
			),
      array('allow', // allow admin users the admin actions
            'actions' => array('dashboard','customerdashboard','logout','updateProfile','Profile'),
            'users' => array('payment'),
            

        ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionIndex()
	{
		$model= new LoginForm;
		if(isset($_POST['LoginForm']))
		{
       //echo "<pre>";print_r($_REQUEST);
              $model->attributes=$_POST['LoginForm'];
			        if($model->validate() && $model->login())
              {
                   
                   //echo "<pre>";print_r($_REQUEST);die;
                   
                       if($_POST['LoginForm']['logintype']=='company')
                       {
                          //echo "fsfsf";die;
                       	  //$user = Login::model()->exists('email=:email',array('email'=>$$_POST['LoginForm']['email']));
                          $email=$_SESSION['_registration__id'];
                          //echo $email;die;
                           
                           $rec=ServiceUser::model()->findByAttributes(array('email'=>$email));
                           //echo "<pre>";print_r($rec);die;
                           Yii::app()->session['loggedId']=$rec->id;  
                           Yii::app()->session['type'] = 'company';  
                            Yii::app()->session['companyname'] = ucfirst($rec->company_name);

                          $this->redirect(array('dashboard'));
                       }
                       else
                       {
                       	   $email=$_SESSION['_registration__id'];
                           
                           $rec=CustomerUser::model()->findByAttributes(array('email'=>$email));
                           //echo "<pre>";print_r($rec);die;
                           Yii::app()->session['loggedId']=$rec->id;
                       	   
                           Yii::app()->session['type'] = 'customer';
                           Yii::app()->session['customername'] = ucfirst($rec->cname);
                          $this->redirect(array('customerdashboard'));
                       }	
                       //$this->redirect(array('dashboard'));
                   
                   //$this->redirect(array('dashboard'));
				   //$rec=Login::model()->findByAttributes(array('email'=>$email,'password'=>$pass,'status'=>1));
				   //$auth = new UserIdentity($email,$password);
				   //$auth->authenticate();
				  /* if()
                   { 
                   	  //Yii::app()->user->setState('id', $rec->id);
					  //Yii::app()->session->add('id',$rec->id);
                      $this->redirect(array('dashboard'));
                   }
                   else
                   {
                       Yii::app()->user->setFlash('login', "Wrong Email and Password");
                       $this->redirect(array('index'));
                   }*/
              } 
              else
              {
              	$errors=$model->getErrors();
                //var_dump($errors);
              }   
		}	
    $links=CmsPages::model()->findAll();
    Yii::app()->params['MyArray'] = $links;
		$this->render('login',array('model'=>$model));
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

	public function actionRegistration()
	{
		    $model= new Registration; 
        $zip=UkPostcodes::model()->findAll();
        
         //echo "<pre>";print_r($zip);die; 
        foreach($zip as $z)
        {
        	$post[]=$z->postcode;
        } 
        
        $uniquePost=array_unique($post);

         if(isset($_POST['Registration']))
         {
              $rnd = rand(0,9999);
		      $uploadedFile=CUploadedFile::getInstance($model,'company_logo');
		      $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
            
              $model->attributes=$_POST['Registration'];
              if($model->validate())
              {
                 $companyName=$_REQUEST['Registration']['company_name'];
                 
                 $city       =$_REQUEST['Registration']['city'];
                 $zip        =$_REQUEST['Registration']['zipcode'];
                 $phone      =$_REQUEST['Registration']['phone'];
                 $email      =$_REQUEST['Registration']['email'];
                 $password   =trim($_REQUEST['Registration']['password']);
                 

                 $zip=UkPostcodes::model()->findByAttributes(array('postcode'=>$zip));

                 $latitude   =$zip->latitude;
                 $longtitude =$zip->longitude;

                 $date=date('Y-m-d'); 
                 $model->password   =md5($password); 
                 $model->registered =$date;
                 $model->lat        =$latitude;
                 $model->longitude  =$longtitude;



                 if(is_uploaded_file($_FILES['Registration']['tmp_name']['company_logo']))
	               {	
	            	
	                $model->company_logo = $fileName;
                 }
                 
                $cleartext_password = $password;
				        //$model->password = md5($cleartext_password);
				
                 if($model->save())
                 {
	                      if(is_uploaded_file($_FILES['Registration']['tmp_name']['company_logo']))
		                 {
		            	     $uploadedFile->saveAs(Yii::app()->basePath.'/../CompanyLogo/'.$fileName); 
		            	   }


		            	     $signature = md5($model->email . $model->password);
						
      						     $subject = 'Welcome to Wow Cleans';
      						     $body = $this->renderPartial('registrationEmail', array(
                  							'model'=>$model,
                  							'password'=>$cleartext_password,
                  							'url'=>$this->createAbsoluteUrl('login', array('email' => $model->email)),
                  							//'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                  						), true);

						
						        Yii::app()->mailer->send($model->email, $subject, $body);
		            	  Yii::app()->user->setFlash('emailcheck', "Please check you email to activate your account");
		                $this->redirect(array('registration/index'));
                 }	

                

                /*email send code*/


              }	
              else
              { 
                  $errors=$model->getErrors();

              }	
         }	
         $links=CmsPages::model()->findAll();
         Yii::app()->params['MyArray'] = $links;
         $this->render('registration',array('model'=>$model,'Post'=>$uniquePost));
	}

	public function actionLogin()
	{
    
    $model=new LoginForm;  
		//echo "<pre>";print_r($_REQUEST);die;
		$email=$_REQUEST['email'];
    
		$rec=ServiceUser::model()->findByAttributes(array('email'=>$email));
		if(count($rec)>0)
		{
			 $rec->status=1;
			 if($rec->save(false))
			 {	

			   $this->redirect(array('registration/index'));
			  } 
		}	 
		$this->render('index');
	}

	 public function actionDashboard()
    {
       $model        =new ServiceUser;
       $msg          = new ConversationMsg;
       $msgDetail    =new MsgDetails; 
       $admnPrice    =new PriceAdmin;
       $additional   =new AdditionalServicePrice;
       $globalAd     =new AdditionalServices;
       $proadnlPrice =new ProviderAdditionalprices; 
       $distance     =new DistanceCoverage; 
       //$converstion  =new MsgDetails;
       $serviceAd  =new ServicetypeAdditionalservices;

    	 $loggedId   =Yii::app()->session['loggedId'];
    	 //echo $loggedId;die;
    	 $email=$_SESSION['_registration__id'];
    	 //echo $email;die;
    	 //$rec=ServiceUser::model()->with('bookings')->findByAttributes(array('email'=>$email));
    	 $rec=ServiceUser::model()->with('bookings')->findByPk(array('id'=>$loggedId));
    	 
       // echo "<pre>";print_r($loggedId);die;
        // echo "<pre>";print_r($rec);die;
        if(!empty($rec['bookings']))
        {  
             foreach($rec['bookings'] as $to)
            {
                $serviceId[]=$to['customer_id'];
                $companyName[]=$to->customer['cname']." ".$to->customer['clname'];
                 //echo "<pre>";print_r($to);    
            }    //die;
        

           $finalTo=array_combine($serviceId,$companyName);
        }
              $convMsg=ConversationMsg::model()->findAll(array(
                      'condition' => ' reciver_id=:id ',
                      
                      'params' => array(':id'=>$loggedId,),
                    )); 
              //echo "<pre>";print_r($convMsg);die;

              $inbox=MsgDetails::model()->findAll(array(

                      'condition' => 'tomsg=:tomsg AND inbox_dlt_status=:status', 
                      'group'   =>'conversation_id',
                                                  
                      'params' => array(':tomsg'=>$loggedId,':status'=>0),
                    )); 
                

               //echo "<pre>";print_r($inbox);die; 
              foreach($inbox as $conId)
              {
                  $inboxDtal[]=MsgDetails::model()->findAll(array(
                      'condition' => 'conversation_id=:conversation_id AND inbox_dlt_status=:status', 
                      //'group'   =>'conversation_id',                   
                      'params' => array(':conversation_id'=>$conId->conversation_id,':status'=>0),
                    )); 

                   /*$count =MsgDetails::model()->findAll(array('condition'=>'conversation_id=:conversation_id AND tomsg=:tomsg','params'=>array(
                                 
                                   ':conversation_id'=>$conId->conversation_id,
                                   ':tomsg'          =>$loggedId, 
                   	)));*/

                   	$companyN=CustomerUser::model()->findAll(array('condition'=>'id=:id','params'=>array(
                               ':id'=>$conId->user_id,

          	  	    )));    

                    
                    //$numInbox=array_combine($count,$companyName);
                   //$numInbox[]=count($count);
                  //echo "<pre>";print_r($companyN);
                  
              }	//die;//echo "<pre>";print_r($inboxDtal);die;

              //select summ(*) as total from 

               /*$inbox=MsgDetails::model()->findByAttributes(
							    //array('to'=>$loggedId),
							    array(
							        'condition'=>'to=:to', 
							        'params'=>array(':to'=>$loggedId)
							    )
							); */
              //$inbox=MsgDetails::model()->findByAttributes(array('to'=>$loggedId)); 
                             
           //echo "<pre>";print_r($inbox);die;

         
        /*get the details for messages to show on dashboard ends here*/ 
        
         /*code to get the sender name here*/

          $find=ConversationMsg::model()->findAll('sender_id<>'.$loggedId); 
          //echo "<pre>";print_r($find);die;
          foreach($find as $senderId)
          {
               
              $count=MsgDetails::model()->findAll(array('condition'=>'conversation_id=:id AND user_id=:user_id','params'=>array(
                                    
                                    ':id'      =>$senderId['id'],
                                    ':user_id' =>$loggedId,
              	)));
               //echo "<pre>";print_r($count);
               $c=count($count);
               //echo $c;

          	   $comName=CustomerUser::model()->findAll(array('condition'=>'id=:id','params'=>array(
                               ':id'=>$senderId['sender_id'],

          	  	)));
              // echo "<pre>";print_r($comName);
          	  
          } // die;

          //$sntMsg=ConversationMsg::model()->findAll(); 

          /*code to show the list for sent messages*/
          $sentMsg=ConversationMsg::model()->findAll(array('condition'=>'sender_id=:sender_id','params'=>array(
                                  ':sender_id'=>$loggedId,
          )));
          //echo "<pre>";print_r($sentMsg);die;
          $sentbox=MsgDetails::model()->findAll(array('condition'=>'user_id=:user_id','params'=>array(
                                  ':user_id'=>$loggedId,
          ))); 

          $sentBox=MsgDetails::model()->findAll(array('condition'=>'user_id=:user_id AND sent_dlt_status=:status',
                      'group'=>'conversation_id',    
          	          'params'=>array(
                                  ':user_id'=>$loggedId,
                                   ':status'=>0,
          )));
          /*foreach($sentBox as $conId)
          {*/
              /*$sentBoxDtl=MsgDetails::model()->findAll(array('condition'=>'conversation_id=:conversation_id',
                      //'group'=>'conversation_id',    
          	          'params'=>array(
                                  ':conversation_id'=>$conId->conversation_id,
               )));*/
               /*$sentBoxDtl=MsgDetails::model()->findAll(array('condition'=>'user_id=:user_id AND sent_dlt_status=:status',
                      //'group'=>'conversation_id',    
          	          'params'=>array(
          	          	          ':status'=>0,   
                                  ':user_id'=>$loggedId,
               )));*/	
            foreach($sentBox as $conId)
	          {
	               $sentBoxDtl[]=MsgDetails::model()->findAll(array('condition'=>'conversation_id=:conversation_id AND user_id=:user_id AND sent_dlt_status=:status',
	                      //'group'=>'conversation_id',    
	          	          'params'=>array(
	                                  ':user_id'         =>$loggedId,
	                                  ':conversation_id' =>$conId->conversation_id,
	                                  ':status'          =>0,
	               )));
	               $companyName=ServiceUser::model()->findAll(array('condition'=>'id=:id','params'=>array(
	                               ':id'=>$conId->tomsg,

	            	  	    )));
	              // echo "<pre>";print_r($companyName);
	               	    
	          }//die;

          //}	
          //$sentBoxconvID =$inbox[0]['conversation_id'];
          
            
          //echo "<pre>";print_r($outbox);die;
          foreach($sentMsg as $sender_id)
          {
                 
                 $sentFrm=ServiceUser::model()->findAll(array('condition'=>'id=:id','params'=>array(

                                 ':id'=>$sender_id->sender_id,
              	 )));
              	 //echo "<pre>";print_r($sentFrm);
                 /*$sentFrm=CustomerUser::model()->findAll(array('condition'=>'id=:id','params'=>array(

                                 ':id'=>$sender_id->sender_id,
              	)));*/ 	
                //echo "<pre>";print_r($sentTo);
          }	//die;
        
        /*code to get the new pending requests from customers*/
        $companyRequest=CompanyRequest::model()->findAll(array('order'=>'id desc','condition'=>'service_id=:service_id AND job_status=:job_status','params'=>array(
                         ':service_id'=>$loggedId,
                         ':job_status'=>0,
          )));
        

        $Request=CompanyRequest::model()->findAll(array('condition'=>'service_id=:service_id AND job_status=:job_status','params'=>array(
                         ':service_id'=>$loggedId,
                         ':job_status'=>1,
          ))); 
        foreach($Request as $arrReq)
         {
            $request[]=$arrReq['booking_id'];
            //echo "<pre>";print_r($request);
         } //die;
        
          

        //echo "<pre>";print_r($companyRequest);die;

         /*code to edit the services by company from dashboard*/
           $serviceType=ServiceTypes::model()->findAll();
           

           $statusType     =ServicestatusBycompany::model()->findAll(array('condition'=>'status=:status AND service_id=:service_id','params'=>array(
                                ':service_id'=>$loggedId,
                                ':status'    =>1,
           
            )));
            
            $Admin=PriceAdmin::model()->findAll(array('condition'=>'service_id=:service_id','params'=>array(
                                   ':service_id'=>$loggedId
              )));
           //echo "<pre>";print_r($Admin);die;

          /*check the price for particular starts here*/
            
          $additionSerPrice=AdditionalServicePrice::model()->findAll(array('condition'=>'service_id=:service_id','params'=>array(
                                ':service_id'=>$loggedId,
          )));
          
          //echo "<pre>";print_r($additionSerPrice);die; 
        /*code to get the details for zipcodes */
        $zip=UkPostcodes::model()->findAll();
        
        foreach($zip as $z)
        {
          $post[]=$z->postcode;
        } 
        
        $uniquePost=array_unique($post); 
        /*code to get the details for zipcodes ends */

        /*code to get the global price for additional services starts here*/
          
          $gpAdditional=AdditionalServices::model()->findAll();

          $chkgPAdmin  =PriceAdmin::model()->findAll(array('condition'=>'service_id=:service_id','params'=>array(
                                    ':service_id'=>$loggedId,

          )));
          //echo "<pre>";print_r($chkgPAdmin);die;
          //echo "<pre>";print_r($gpAdditional);die;
        /*code to get the global price for additional services ends here */
        
         $providerPrice = ProviderAdditionalprices::model()->findAll(array('condition'=>'service_id=:service_id  ','params'=>array(
	                            ':service_id'               =>$loggedId,
	                            //':service_type_id'          =>$_REQUEST['type'],
	                            //':servicetype_additional_id'=>$k 

	        )));
          
          



         //$servicetypeAdnlser=ServicetypeAdditionalservices::
        // code to get the prices details for additional services for particular service type
        
        // code to get the price from priceadmin table and update the price by provider
         
        $endofTenancy    =PriceAdmin::model()->find(array('condition'=>'service_id=:service_id AND service_type_id=:service_type_id','params'=>array(
                          ':service_id'     =>$loggedId,
                          ':service_type_id' =>1,

        	)));
        $domesticCleaning =PriceAdmin::model()->find(array('condition'=>'service_id=:service_id AND service_type_id=:service_type_id','params'=>array(
                          ':service_id'     =>$loggedId,
                          ':service_type_id' =>2,

        	)));

        $officeCleaning =PriceAdmin::model()->find(array('condition'=>'service_id=:service_id AND service_type_id=:service_type_id','params'=>array(
                          ':service_id'     =>$loggedId,
                          ':service_type_id' =>3,

        	)));

        $coverage       =DistanceCoverage::model()->find(array('condition'=>'service_id=:service_id','params'=>array(
                                      ':service_id'=>$loggedId,
                        )));
        //echo "<pre>";print_r($coverage);die;
        //echo "<pre>";print_r($domesticCleaning);die;
         // company Request find here to show the completed jobs 
        $comRest=CompanyRequest::model()->findAll(array('condition'=>'service_id=:service_id AND job_status=:job_status','params'=>array(
                            ':service_id'=>$loggedId,
                            ':job_status'=>1,
          )));
        //echo "<pre>";print_r($comRest);die;
        $links=CmsPages::model()->findAll();
        Yii::app()->params['MyArray'] = $links;
    	 

       $this->render('dashboard',array('model'=>$model,'dashboard'=>$rec,'convMsg'=>$convMsg,
    	 	'msg'=>$msg,'msgDetail'=>$msgDetail,'finalTo'=>$finalTo,'companyName'=>$companyName,
    	 	'count'=>$c,'frm'=>$sentFrm,'sent'=>$sentMsg,'inbox'=>$inbox,'out'=>$sentbox,
    	 	'inboxDtal'=>$inboxDtal,'sentBox'=>$sentBox,'sentBoxDtl'=>$sentBoxDtl,'numInbox'=>$numInbox,
        'comName'=>$comName,'companyN'=>$companyN,'companyRequest'=>$companyRequest,'request'=>$request,
        'serviceTy'=>$serviceType,'statusType'=>$statusType,'admnPrice'=>$admnPrice,'Admin'=>$Admin,'addnal'=>$additional,
        'additionSerPrice'=>$additionSerPrice,'uniquePost'=>$uniquePost,'gpAdditional'=>$gpAdditional,'chkgPAdmin'=>$chkgPAdmin,
        'globalAd'=>$globalAd,'serviceAd'=>$serviceAd,'providerPrice'=>$providerPrice,'endofTenancy'=>$endofTenancy,'domesticCleaning'=>$domesticCleaning,'officeCleaning'=>$officeCleaning,'distance'=>$distance,'coverage'=>$coverage,'comRest'=>$comRest,'converstion'=>$converstion));
    }
    
    // function to get the jobs request tab record when relist the completed job
    public function actionJobsRequestTabRelistJob()
    {
       //echo "<pre>";print_r($_REQUEST);die;
       $loggId=$_REQUEST['loggedId'];
       $companyRequest=CompanyRequest::model()->findAll(array('order'=>'id desc','condition'=>'service_id=:service_id AND job_status=:job_status','params'=>array(
                         ':service_id'=>$loggId,
                         ':job_status'=>0,
          )));

        
         $this->renderPartial('dashboardJobRequestRelist',array('companyRequest'=>$companyRequest));
      
    }
    
    /*function to delet the messages from customer dashboard*/
    public function actionDeleteMsgCustomerDashboard()
    {
       $ids=$_REQUEST['ids'];
       //echo "<pre>";print_r($ids);die;
         foreach($ids as $id)
         {
            /*$msgDetail=MsgDetails::model()->findAll(array('condition'=>'conversation_id=:conversation_id',

                        'params'=>array(':conversation_id'=>$id),

              )); */
              
              $msgDetail=MsgDetails::model()->findByAttributes(array('conversation_id'=>$id));
              //echo "<pre>";print_r($msgDetail);die;
              if(!empty($msgDetail))
              {  
                  
                 $msgDetail->delete();
              }
             /*$convMsg=ConversationMsg::model()->findAll(array('condition'=>'id=:id',
             
                        'params'=>array(':id'=>$id),

              ));*/
              $convMsg= ConversationMsg::model()->findByAttributes(array('id'=>$id));
              $convMsg->delete();    
             //echo "<pre>";print_r($convMsg);
             
         } //die;
          echo "success";die;
    }


    // function to update the company profile 
    public function actionUpdateProfile()
    {
    	//echo "<pre>";print_r($_REQUEST);die;
    	$model=new ServiceUser;
    	$email =$_SESSION['_registration__id'];
    	//echo $email;die;
      
    	if(isset($_POST['ServiceUser'])  )
    	{
         
           //$model->attributes=$_POST['ServiceUser'];
              //echo "<pre>";print_r($_POST['image']);die; 
           //if($model->validate())
           //{
               //echo "<pre>";print_r($_FILES['image']);    
               //$email=$_REQUEST['ServiceUser']['email'];
               $rec=ServiceUser::model()->findByAttributes(array('email'=>$email));
               //echo "<pre>";print_r($rec);die;
               $rec->company_name=$_REQUEST['ServiceUser']['company_name'];
               $rec->email=$_REQUEST['ServiceUser']['email'];
               $rec->city=$_REQUEST['ServiceUser']['city'];
               $rec->phone=$_REQUEST['ServiceUser']['phone'];
               $rec->zipcode=$_REQUEST['ServiceUser']['zipcode'];

               /*code to upadate company logo*/ 
                $rnd = rand(0,9999);
               $uploadedFile=CUploadedFile::getInstance($model,'company_logo');
               
               $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
               //echo $_FILES['ServiceUser']['tmp_name']['company_logo'];die;
               if(is_uploaded_file($_FILES['ServiceUser']['tmp_name']['company_logo']))
               {
                 // echo $fileName;die;
                  $rec->company_logo = $fileName;
                  $uploadedFile->saveAs(Yii::app()->basePath.'/../CompanyLogo/'.$fileName); 
                            
                  
               }
               if(!empty($_REQUEST['ServiceUser']['password']) )
               {
                   /*if($_REQUEST['ServiceUser']['password']==$_REQUEST['ServiceUser']['cpassword'])
	               {*/
	                $rec->password=md5($_REQUEST['ServiceUser']['password']);
	                   if($rec->save(false))
                     { 

                         if(is_uploaded_file($_FILES['ServiceUser']['tmp_name']['company_logo']))
                         {
                           $uploadedFile->saveAs(Yii::app()->basePath.'/../CompanyLogo/'.$fileName); 
                           //$uploadedFile->saveAs(Yii::app()->basePath.'/../HomeImages/'.$fileName); 
                         }
                      }
                      //echo Yii::app()->request->baseUrl.'/CompanyLogo/'.$fileName;die;
	                echo "Changes Saved";
	               //}
               }
               else
               {
                  /*code to upadate company logo*/
                  //echo "fsfs";die; 
                   $rnd = rand(0,9999);
                   $uploadedFile=CUploadedFile::getInstance($model,'company_logo');
                   //echo $uploadedFile;die;
                   $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                 if($rec->save(false))
                 {        
						//echo "Saved ".$_SESSION['_registration__id']."<pre>";print_r($_POST)."<pre>";print_r($_FILES);die;
                         if(is_uploaded_file($_FILES['ServiceUser']['tmp_name']['company_logo']))
                         {
                            $rec->company_logo = $fileName;

                            $uploadedFile->saveAs(Yii::app()->basePath.'/../CompanyLogo/'.$fileName); 
                            
                         } 
                         //echo  Yii::app()->request->baseUrl.'/CompanyLogo/'.$fileName;die;
                   echo "Changes Saved";
                 }
               }
               

               	
           //}
	      /* else
	    	{  
	            
	            $err=$model->getErrors();    	
	            

	    	} */
    	}	
    	
    	//$this->render('dashboard',array('model'=>$model));
    } 


    // customer dashboard
     public function actionCustomerDashboard()
    {
           $model     = new CustomerUser;
           $msg       = new ConversationMsg;
           $msgDetail = new MsgDetails; 

    	   $email       =$_SESSION['_registration__id'];
    	   $loggedId    =Yii::app()->session['loggedId'];
    	 //echo $loggedId;die;
    	 
    	 //$rec=CustomerUser::model()->with('bookings')->findByAttributes(array('email'=>$email));
    	 
           $review=ServiceReview::model()->findAll(array('condition'=>'status=:status','params'=>array(
                            ':status'=>1,

           	)));

	       foreach($review as $bookingIds)
	       {
	         	 $bookIds[]=$bookingIds['booking_id'];
	         	 //$status[] =$bookingIds['status'];
	         	 
	       }	
           //echo "<pre>";print_r($bookIds);die;
    	   $rec=CustomerUser::model()->with('bookings')->findByAttributes(array('id'=>$loggedId));
           //echo "<pre>";print_r($rec);die;
    	   $bookings=Booking::model()->with('customer')->findAll(array('condition'=>'customer_id=:customer_id','params'=>array(
                        
                                ':customer_id'=>$loggedId
    	  
    	   	)));
    	   //echo "<pre>";print_r(count($rec));die;
           /*code to pagination*/
          /* $criteria=new CDbCriteria();

           $count=count($bookings);
                
           $pages=new CPagination($count);
                
           $pages->pageSize=4;
           $pages->applyLimit($criteria);
           $result = Booking::model()->findAll($criteria);
           echo "<pre>";print_r($result);die;
           $dataProvider = new CArrayDataProvider($result);
           */

            $criteria = new CDbCriteria();
			$criteria->condition = 'customer_id = :id';
			//$criteria->with      ='customer'; 
			$criteria->params = array (':id'=> $loggedId);
			//$criteria->order = 'ac_name asc';
			 
			//get count
			$count = Booking::model()->count($criteria);
			 
			//pagination
			$pages = new CPagination($count);
			$pages->setPageSize(5);
			$pages->applyLimit($criteria);
			 
			//result to show on page
			$dataProvider = Booking::model()->findAll($criteria);
			//echo "<pre>";print_r($result);die;
			//$dataProvider = new CArrayDataProvider($result);
           // echo "<pre>";print_r($dataProvider);die;
          // echo "<pre>";print_r($pages);die;

            
	       foreach($rec['bookings'] as $to)
	       {
	            $serviceId[]=$to['service_id'];
	            $companyNam[]=$to->service['company_name'];
	                 
	       }    

           $finalTo=array_combine($serviceId,$companyNam);
         
	       $convMsg=ConversationMsg::model()->findAll(array(
	                  'condition' => ' reciver_id=:id',
	                  
	                  'params' => array(':id'=>$loggedId,),
	                )); 

           /*$inbox=MsgDetails::model()->findAll(array('condition'=>'to=:to','params'=>array(
                                ':to'=>$loggedId

          	)));*/
            $inbox=MsgDetails::model()->findAll(array(
                      'condition' => 'tomsg=:tomsg  AND inbox_dlt_status=:status', 
                      'group'   =>'conversation_id',                    
                      'params' => array(':tomsg'=>$loggedId,':status'=>0),
                    )); 
            //$convID =$inbox[0]['conversation_id'];
            //echo "<pre>";print_r($inbox);die;
             foreach($inbox as $conId)
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
                   
             } //die;

          
          /*code to get the sent messages list*/

          $sentMsg=ConversationMsg::model()->findAll(array('condition'=>'sender_id=:sender_id','params'=>array(
                                  ':sender_id'=>$loggedId,
          ))); 

          $sentBox=MsgDetails::model()->findAll(array('condition'=>'user_id=:user_id AND sent_dlt_status=:status',
                      'group'=>'conversation_id',    
          	          'params'=>array(
                                  ':user_id'=>$loggedId,
                                  ':status' =>0,
          )));
          //echo "<pre>";print_r($sentBox);die;
          foreach($sentBox as $conId)
          {
               $sentBoxDtl[]=MsgDetails::model()->findAll(array('condition'=>'conversation_id=:conversation_id AND user_id=:user_id AND sent_dlt_status=:status',
                      //'group'=>'conversation_id',    
          	          'params'=>array(
                                  ':user_id'         =>$loggedId,
                                  ':conversation_id' =>$conId->conversation_id,
                                  ':status'          =>0,
               )));
               $companyName=ServiceUser::model()->findAll(array('condition'=>'id=:id','params'=>array(
                               ':id'=>$conId->tomsg,

            	  	    )));
               //echo "<pre>";print_r($companyName);
               	    
          }	//die;

           
          //echo "<pre>";print_r($sentBox);die;
          foreach($sentMsg as $sender_id)
          {
                 $custName=$sender_id->sender_id;
                 /* $sentTo=ServiceUser::model()->findAll(array('condition'=>'id=:id','params'=>array(

                                 ':id'=>$sender_id->reciver_id,
              	 )));*/
                 $sentFrm=CustomerUser::model()->findAll(array('condition'=>'id=:id','params'=>array(

                                 ':id'=>$sender_id->sender_id,
              	))); 	
                //echo "<pre>";print_r($sentTo);
          }	//die;
          //echo "<pre>";print_r($sentMsg);die; 
          
           $Request=CompanyRequest::model()->findAll(array('condition'=>'job_status=:job_status','params'=>array(
                         
                         ':job_status'=>1,
          ))); 
        foreach($Request as $arrReq)
         {
            $request[]=$arrReq['booking_id'];
            //echo "<pre>";print_r($request);
         }      
          
         /*code to edit the job quotes starts here*/
          $mod=new CleaningTime;
          $service=new ServiceTypes;
          $list  =CleaningTime::model()->findAll();
        
          $zip=UkPostcodes::model()->findAll();

         //echo "<pre>";print_r($zip);die; 
          foreach($zip as $z)
          {
            $post[]=$z->postcode;
          } 
        
          $uniquePost=array_unique($post); 
        
          $record=CompanyRequest::model()->find(array('condition'=>'booking_id=:booking_id AND job_status=:job_status','params'=>array(
                              
                              ':booking_id'=>$_REQUEST['id'],
                              ':job_status'=>1,
          )));
         //echo "<pre>";print_r($rec->booking);die;
           $ser=ServiceTypes::model()->findAll();
           foreach($ser as $se)
           {
             $ids[]    =$se['id'];
             $serNam[]=$se['service_name'];
             $serName=array_combine($ids, $serNam);
           }

           $additionalSer=AdditionalServices::model()->findAll();
           foreach($additionalSer as $ser)
           {
                $addnlSer[]=$ser['service_name'];
           }//echo "<pre>";print_r($addnlSer);die;


         /*code to edit the job quotes ends here*/
           
           /*code to get the new pending requests for company*/
        $companyRequest=CompanyRequest::model()->findAll(array('order'=>'id desc','condition'=>'customer_id=:customer_id AND job_status=:job_status','params'=>array(
                         ':customer_id'=>$loggedId,
                         ':job_status'=>0,
          )));
        

        $Request=CompanyRequest::model()->findAll(array('condition'=>'customer_id=:customer_id AND job_status=:job_status','params'=>array(
                         ':customer_id'=>$loggedId,
                         ':job_status'=>1,
          ))); 
        foreach($Request as $arrReq)
         {
            $req[]=$arrReq['booking_id'];
            //echo "<pre>";print_r($request);
         }


          $links=CmsPages::model()->findAll();
         Yii::app()->params['MyArray'] = $links;
    	 $this->render('customerdashboard',array('model'=>$model,'bookingDetails'=>$rec,'bookIds'=>$bookIds,
    	 	'review'=>$review,'msg'=>$msg,'msgDetail'=>$msgDetail,'finalTo'=>$finalTo,'convMsg'=>$convMsg,
    	 	'companyName'=>$companyName,'c'=>$num,'sent'=>$sentMsg,'Frm'=>$sentFrm,'inbox'=>$inbox,
    	 	'inboxDtal'=>$inboxDtal,'sentBox'=>$sentBox,'sentBoxDtl'=>$sentBoxDtl,'pages'=>$pages,'dataProvider'=>$dataProvider,'request'=>$request,
        'list'=>$list,'mod'=>$mod,'Post'=>$uniquePost,'rec'=>$record,'serName'=>$serName,'service'=>$service,'addnlSer'=>$addnlSer,'companyRequest'=>$companyRequest,'req'=>$req));
    }

    // customer profile

     public function actionProfile()
    {
      
      $model=new CustomerUser;
      $email =$_SESSION['_registration__id'];
      $loggedId =Yii::app()->session['loggedId'];
        
      if(isset($_POST['CustomerUser']))
      {
        //echo "<pre>";print_r($_REQUEST);die;  
           $model->attributes=$_POST['CustomerUser'];
           if($model->validate())
           {

               //$email=$_REQUEST['ServiceUser']['email'];
               //$rec=CustomerUser::model()->findByAttributes(array('email'=>$email));
                 //$cname=explode(" ", $_REQUEST['CustomerUser']['cname']);
                 //echo "<pre>";print_r($cname);die;
                 $cname  =$_REQUEST['CustomerUser']['cname'];
                 $clname =$_REQUEST['CustomerUser']['clname'];
                 $email  =$_REQUEST['CustomerUser']['email'];
                 $city   =$_REQUEST['CustomerUser']['city'];
                
                 $phone  =$_REQUEST['CustomerUser']['phone'];
                 $add    =$_REQUEST['CustomerUser']['caddress'];


                 $rec=CustomerUser::model()->findByAttributes(array('id'=>$loggedId));
              // echo "<pre>";print_r($rec);die;
                 
                  /*foreach($cname as $k=>$c)
                 {
                   if($k==0)
                   { 
                     $rec->cname=$c;
                   }
                   else
                   { 
                    
                     if($k!=0)
                     {
                       $rec->clname .=$c;
                     } 
                     
                   }
                 } */


                 //$rec->cname=$_REQUEST['CustomerUser']['cname'];
                 $rec->email=$_REQUEST['CustomerUser']['email'];
               if(!empty($_REQUEST['CustomerUser']['password']) )
               {

                   /*if(trim($_REQUEST['CustomerUser']['password'])==trim($_REQUEST['ServiceUser']['cpassword']))
                 {*/
                 	//echo "fsfsf";die;
                  $rec->password=md5($_REQUEST['CustomerUser']['password']);
                  $rec->save(false);
                  echo "Changes Saved";die;
                 //}
               }
               else
               {
                 $rec->cname   =$cname;
                 $rec->clname  =$clname;
                 $rec->email   =$email;
                 $rec->city    =$city;
                 $rec->phone   =$phone;
                 $rec->caddress=$add; 
                 if($rec->save(false))
                 {

                   echo "Changes Saved";die;
                 }
               }
               
                
           }
         else
        {  
              
              $err=$model->getErrors();
          //echo "<pre>";print_r($err);die;
          //var_dump($err);die;
              

        } 
      } 
      
      //$this->render('dashboard',array('model'=>$model));
    }   

    // function for logout
    public function actionLogout()
    {
         Yii::app()->user->logout();
         $this->redirect('index');
    }
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
  
  /*function to rate the company*/
  public function actionRating()
  {
  	 //echo $_POST['rate'];die; 
     $ratingAjax=isset($_POST['rate']) ? $_POST['rate'] : 0;
         echo "You are voting: $ratingAjax";
  }

  /*function to add review and rating to db*/
  public function actionAddReview()
  {
  	$review     =$_REQUEST['text'];
  	$rate       =$_REQUEST['rate'];
  	$bookingId  =$_REQUEST['bookingId'];
    $loggedCustomerId =Yii::app()->session['loggedId'];
    $model=new ServiceReview;
	    if(isset($_REQUEST['text']))
	    {
		       //echo $loggedCustomerId;die;
		       $rec=Booking::model()->findByPk(array('id'=>$bookingId));
		       //echo "<pre>";print_r($rec);die;	
		       $serviceId     =$rec->service_id;
		       $serviceTypeId =$rec->service_type_id; 


		       $model->customer_id=$loggedCustomerId;
		       $model->booking_id =$bookingId; 
		       $model->service_id =$serviceId;
		       $model->rating     =$rate;
		       $model->review     =$review;
		       $model->date       =date('y-m-d');
		       $model->status     =1;

		       if($model->save())
		       {
               
               $companyDetail=ServiceUser::model()->find(array('condition'=>'id=:id','params'=>array(
                                 ':id'=>$rec['service_id'],
                )));

               $custDetail   =CustomerUser::model()->find(array('condition'=>'id=:id','params'=>array(
                                 ':id'=>$rec['customer_id'],
                )));
               // mail to company
                $subject = 'Welcome to Wow Cleans';
                                $body = $this->renderPartial('companyReviewEmail', array(
                                
                                'copmDetail'=>$companyDetail,
                                'custDetail'=>$custDetail,                                
                                'review'    =>$review,
                ), true);                                                          
              Yii::app()->mailer->send($companyDetail->email, $subject, $body);  
  

               // mail to customer
                $subject = 'Welcome to Wow Cleans';
                                $body = $this->renderPartial('customerReviewEmail', array(
                                
                                'copmDetail'=>$companyDetail,
                                'custDetail'=>$custDetail,                                
                                'review'    =>$review,
                ), true);                                                          
               Yii::app()->mailer->send($custDetail->email, $subject, $body);  

		           echo "success";die;
		       }

         
        }  

  }

  /*function to send message to company*/

  public function actionSendMessage()
  {
       $model       = new ConversationMsg;
       $msg =new MsgDetails; 

       
        if(isset($_POST['ConversationMsg']) && isset($_POST['MsgDetails']))
        {
                  //$model->attributes=$_POST['ConversationMsg'];
                  //$msg->attributes=$_POST['MsgDetails'];
                 


                                  $companyRecvierId    =$_POST['ConversationMsg']['reciver_id']; 
                                  $subject             =$_POST['ConversationMsg']['subject'];
                                  //echo $companyRecvierId;die;
                                  $date                =date('Y-m-d'); 
                                  $loggedIdSender      =Yii::app()->session['loggedId'];
                                  $model->date         =$date;  
                                  $model->sender_id    =$loggedIdSender;
                                  $model->sender_type  ='customer';
                                  $model->reciver_id   =$companyRecvierId;
                                  $model->reciver_type ='company';
                                  $model->subject      =$subject; 
                                  
                                  $model->save(false);
                                  
                                  $conversationId = Yii::app()->db->getLastInsertID();

                                  $text=$_REQUEST['MsgDetails']['msg'];

                                  $msg->conversation_id=$conversationId;
                                  $msg->user_type='customer';
                                  $msg->msg=$text;
                                  $msg->tomsg =$companyRecvierId;
                                  $msg->user_id=$loggedIdSender;
                                  $date=date('Y-m-d'); 
                                  $msg->date=$date;
                                  $msg->save(false);

                       echo "success";die;           
                  
        } 


       //echo "<pre>";print_r($_REQUEST);die;

      //$this->render('customerdashboard',array());
       

  }
 
 /*function to create message for customer from company*/


public function actionCreatemsgFromCompany()
  {
       $model       = new ConversationMsg;
       $msg =new MsgDetails; 
        
       
        if(isset($_POST['ConversationMsg']) && isset($_POST['MsgDetails']))
        {
                  //$model->attributes=$_POST['ConversationMsg'];
                  //$msg->attributes=$_POST['MsgDetails'];
                 
             //echo "<pre>";print_r($_REQUEST);die;

                                  $companyRecvierId    =$_POST['ConversationMsg']['reciver_id']; 
                                  $subject             =$_POST['ConversationMsg']['subject'];
                                  //echo $companyRecvierId;die;
                                  $date                =date('Y-m-d'); 
                                  $loggedIdSender      =Yii::app()->session['loggedId'];
                                  $model->date         =$date;  
                                  $model->sender_id    =$loggedIdSender;
                                  $model->sender_type  ='company';
                                  $model->reciver_id   =$companyRecvierId;
                                  $model->reciver_type ='customer';
                                  $model->subject      =$subject; 
                                  
                                  $model->save(false);
                                  
                                  $conversationId = Yii::app()->db->getLastInsertID();

                                  $text=$_REQUEST['MsgDetails']['msg'];

                                  $msg->conversation_id=$conversationId;
                                  $msg->user_type='company';
                                  $msg->msg=$text;
                                  $msg->tomsg =$companyRecvierId;
                                  $msg->user_id=$loggedIdSender;
                                  $date=date('Y-m-d'); 
                                  $msg->date=$date;
                                  $msg->save(false);

                                  echo "success";die;
                  
        } 


       //echo "<pre>";print_r($_REQUEST);die;

      //$this->render('customerdashboard',array());
       

  }

    /*function reply from comapny */
       public function actionReplyfromCompany()
       {
           
          // echo "<pre>";print_r($_REQUEST);die;
       	   $model       = new ConversationMsg;
           $msg        =new MsgDetails; 
              
          //echo "<pre>";print_r($_REQUEST);die;
          $senderId        =$_REQUEST['loggedId'];
          $reciverId       =$_REQUEST['receiverId'];
          $subject         =$_REQUEST['subject'];
          $text            =$_REQUEST['text'];
          $conversationID  =$_REQUEST['conversionId'];
          $loggedId        =Yii::app()->session['loggedId'];
          $bookingId       =$_REQUEST['replysectionBookingId'];      
       //echo "<pre>";print_r($_REQUEST);die;
          if(!empty($_REQUEST))
          {
          	 //echo "fsfsfs";die;
            /* $date                =date('Y-m-d');
             $model->date         =$date;
             $model->sender_id    =$senderId;
             $model->sender_type  ='company';
             $model->reciver_id   =$reciverId;
             $model->reciver_type ='customer';
             $model->subject      =$subject; 

             $model->save(false);*/
             
             $name=ServiceUser::model()->findByPk(array('id'=>$loggedId));
             $proname=$name->company_name;

             //$conversationId         = Yii::app()->db->getLastInsertID();
             $msg->conversation_id   =$conversationID;
             $msg->user_type         ='company';
	           $msg->msg               =$text;
	           $msg->user_id           =$loggedId;
	           $msg->tomsg             =$reciverId;
             $msg->booking_id        =$bookingId;
	          // $date                   =date('Y-m-d'); 
             //$msg->date              =$date;
             $msg->save(false);
             
             $msgConverLastId        = Yii::app()->db->getLastInsertID();
             $re=MsgDetails::model()->findByPk(array('id'=>$msgConverLastId));
             echo "<div class='name'>";
             echo $proname;
             echo "</div>";
             echo "<div class='leftMsg appendmsg".$re['id']."'>";    
             echo "<div class='time'>";
             //echo $re['date'];
             echo date('jS \of F Y  H:i:s',strtotime($re['date'])); 
             echo "</div>";
             echo $re['msg'];
             
             echo "</div> ";
             
             //echo "<pre>";print_r($re);die;
             

              
          } 
      
       }

       public function actionReplyfromCustomer()
       {
       	  $model       = new ConversationMsg;
          $msg           =new MsgDetails; 
          
          $senderId       =$_REQUEST['loggedId'];
          $reciverId      =$_REQUEST['receiverId'];
          $subject        =$_REQUEST['subject'];
          $text           =$_REQUEST['text'];
          $conversationID =$_REQUEST['conversionId'];
          $loggedId       =Yii::app()->session['loggedId'];
          $bookingId     =$_REQUEST['replysectionBookingId'];
       //echo "<pre>";print_r($_REQUEST);die;
          if(!empty($_REQUEST))
          {
          	 
             /*$date                =date('Y-m-d');
             $model->date         =$date;
             $model->sender_id    =$senderId;
             $model->sender_type  ='customer';
             $model->reciver_id   =$reciverId;
             $model->reciver_type ='company';
             $model->subject      =$subject; 

             $model->save(false);*/
                                  
             //$conversationId         = Yii::app()->db->getLastInsertID();
             
             $name=CustomerUser::model()->findByPk(array('id'=>$loggedId));
             $custname=$name->cname;



             $msg->conversation_id   =$conversationID;
             $msg->user_type         ='customer';
	           $msg->msg               =$text;
	           $msg->user_id           =$loggedId;
	           $msg->tomsg                =$reciverId;
	           //$date                   =date('Y-m-d'); 
             //$msg->date              =$date;
             $msg->booking_id        =$bookingId;
             $msg->save(false);
             $msgConverLastId        = Yii::app()->db->getLastInsertID();
             $re=MsgDetails::model()->findByPk(array('id'=>$msgConverLastId));
             
             echo "<div class='name'>";
             echo $custname;
             echo "</div>";
             echo "<div class='leftMsg appendmsg".$re['id']."'>"; 
              echo "<div class='time'>";
             //echo $re['date']; 
             echo date('jS \of F Y  H:i:s',strtotime($re['date']));
             echo "</div>";
             echo "<div class='inrmsg'>";
             echo $re['msg'];
             echo "</div>";
             echo "</div> ";
              
             

             //echo "success";die;

          } 
       }
       

       // code to reply from customer to admin in ticket tab
       public function actionReplyticketfromCustomer()
       {
          $model       = new ConversationMsg;
          $msg           =new MsgDetails; 
          
          //$senderId       =$_REQUEST['loggedId'];
          //$reciverId      =$_REQUEST['receiverId'];
          $subject        =$_REQUEST['subject'];
          $text           =$_REQUEST['text'];
          $conversationID =$_REQUEST['conversionId'];
          $loggedId       =Yii::app()->session['loggedId'];
          //$bookingId     =$_REQUEST['replysectionBookingId'];
       //echo "<pre>";print_r($_REQUEST);die;
          if(!empty($_REQUEST))
          {
                          
             $name=CustomerUser::model()->findByPk(array('id'=>$loggedId));
             $custname=$name->cname;



             $msg->conversation_id   =$conversationID;
             $msg->user_type         ='customer';
             $msg->msg               =$text;
             $msg->user_id           =$loggedId;
             $msg->tomsg             =0;
             $msg->logged_id         =$loggedId;
             //$date                   =date('Y-m-d'); 
             //$msg->date              =$date;
             $msg->booking_id        =0;
             $msg->save(false);
             $msgConverLastId        = Yii::app()->db->getLastInsertID();
             $re=MsgDetails::model()->findByPk(array('id'=>$msgConverLastId));
             
            
             echo "<div class='name'>";
             echo $custname;
             echo "</div>";
             
             echo "<div class='leftMsg appendmsg".$re['id']."'>"; 
             echo "<div class='time'>";
             //echo $re['date']; 
             echo date('jS \of F Y  H:i:s',strtotime($re['date']));
             echo "</div>"; 
             echo $re['msg'];
             
             echo "</div> ";
              
             

             //echo "success";die;

          } 
       }
       /*delete msg from sent box from customer dashboard*/
      public function actionDltSentboxCustomerDashboard()
      {
          $id        =$_REQUEST['ids'];
          $loggedId  =$_REQUEST['loggedId'];
          //echo "<pre>";print_r($id);die;
          foreach($id as $ids)
          {
          	  $rec=MsgDetails::model()->findAll(array('condition'=>'conversation_id=:conversation_id AND user_id=:user_id','params'=>array(
                                
                               ':conversation_id'=>$ids,
                               ':user_id'           =>$loggedId,

          	  	)));
          	
          	 foreach ($rec as  $value) {
          	 	
          	 	 $value['sent_dlt_status']=1;
                 $value->save(); 
          	 }

          } 
          echo "success";die;
      } 
      
      /*delete inbox message from customer dashboard*/  
      public function actionDeleteInboxMsgCustomerDashboard()
      {
      	 $id        =$_REQUEST['ids'];
          $loggedId  =$_REQUEST['loggedId'];
          //echo "<pre>";print_r($_REQUEST);die;
          foreach($id as $ids)
          {
          	  $rec=MsgDetails::model()->findAll(array('condition'=>'conversation_id=:conversation_id AND tomsg=:tomsg  ','params'=>array(
                                
                               ':conversation_id'=>$ids,
                               ':tomsg'           =>$loggedId,
                               //':status'          =>0,

          	  	)));
          	// echo "<pre>";print_r($rec);
          	 foreach ($rec as  $value) {
          	 	
          	 	 $value->inbox_dlt_status=1;
                $value->save(); 
          	 }

          	 
          } //die;
          /*foreach($id as $ids)
          {

		          $rec=MsgDetails::model()->findAll(array('condition'=>'conversation_id=:conversation_id AND tomsg=:tomsg','params'=>array(
                                
                               ':conversation_id'=>$ids,
                               ':tomsg'           =>$loggedId,

          	  	)));
		            //$convID =$inbox[0]['conversation_id'];
		            echo "<pre>";print_r($inbox);die;
		             foreach($rec as $conId)
		             {
		             	  //echo $conId->conversation_id;
		                   $inboxDtal=MsgDetails::model()->findAll(array(
		                      'condition' => 'conversation_id=:conversation_id  AND tomsg=:tomsg', 
		                      //'group'   =>'conversation_id',                   
		                      'params' => array(':conversation_id'=>$ids,':tomsg'=>$loggedId),
		                    ));  

		                  echo "<pre>";print_r($inboxDtl);  	 
		                   
		             }
           }  */
          echo "success";die;
      }

      /*delete msg from sent box from company dashboard*/
      public function actionDltSentboxCompanyDashboard()
      {
          $id        =$_REQUEST['ids'];
          $loggedId  =$_REQUEST['loggedId'];
          //echo "<pre>";print_r($_REQUEST);die;
          foreach($id as $ids)
          {
          	  $rec=MsgDetails::model()->findAll(array('condition'=>'conversation_id=:conversation_id AND user_id=:user_id','params'=>array(
                                
                               ':conversation_id'=>$ids,
                               ':user_id'           =>$loggedId,

          	  	)));
          	
          	 foreach ($rec as  $value) {
          	 	
          	 	 $value['sent_dlt_status']=1;
                 $value->save(); 
          	 }

          } 
          echo "success";die;
      } 

      /* function to delet the msg from company dashboard*/
    public function actionDeleteMsgCompDashboard()
    {
         $id        =$_REQUEST['ids'];
          $loggedId  =$_REQUEST['loggedId'];
         // echo "<pre>";print_r($_REQUEST);die;
          foreach($id as $ids)
          {
          	  $rec=MsgDetails::model()->findAll(array('condition'=>'conversation_id=:conversation_id AND tomsg=:tomsg ','params'=>array(
                                
                               ':conversation_id'=>$ids,
                               ':tomsg'           =>$loggedId,

          	  	)));
          	//echo "<pre>";print_r($rec);
          	 foreach ($rec as  $value) {
          	 	
          	 	 $value->inbox_dlt_status=1;
                $value->save(); 
          	 }

          	 
          } die;
          echo "success";die;
    }	

    /*code to calculate the count for msgNotiCompany company*/
    public function actionMsgNotiCompany()
    {
         //echo "<pre>";print_r($_REQUEST);die;
         $loggedId=$_REQUEST['loggedId'];
         $last    =$_REQUEST['last'];
         //echo "<pre>";print_r($_REQUEST);die;
         $rec=MsgDetails::model()->findAll(array('condition'=>'id > :id AND tomsg=:tomsg','params'=>array(
                          ':id'        =>$last,
                           ':tomsg'    =>$loggedId, 

         )));
         $final==count($rec);
         /*$arr   = array();
         $arr[0] =count($rec);
         $arr[1] =$rec['msg'];
   
         echo json_encode($arr);
         exit();*/
         echo $final;die; 
         //echo "<pre>";print_r($rec);die;
    } 

    public function actionRelist()
    {
    	$model     =new ServiceReview;  
    	$book      =$_REQUEST['bookingId'];
    	$loggedId  =$_REQUEST['loggedId'];

    	$booking=Booking::model()->findByPk(array('id'=>$book));
    	
    	foreach($booking->serviceReviews as $reviewsId)
    	{
            $reviewsId->status=0;
            $reviewsId->save();
    	}	//die;
    	echo "success";die;
        //$booking['serviceReviews'][0]['status'];
        
    }

    public function actionAutoRelistJobActiveTab()
    {
    	$loggedId=$_REQUEST['loggedId'];

    	$bookingDetails=Booking::model()->findAll(array('condition'=>'customer_id=:customer_id ','params'=>array(

                          ':customer_id'=>$loggedId, 
                          //':status'     =>1,
    		)));
        echo $bookingDetails;die;

    }

    /*code to chnage the status for new request in company Dashboard*/
    public function actionStatusForNewRequestsCompany()
    {
      $id        =$_REQUEST['id'];
      $loggedId  =$_REQUEST['loggedId'];
      $chgStatus =CompanyRequest::model()->findByPk(array('id'=>$id));

      $chgStatus->job_status=1;
      $chgStatus->save();
      echo "success";die;      

    }
    /*code to decline the request from company dashboard */
    public function actionDeclineNewRequestsCompany()
    {
       $id        =$_REQUEST['id'];
       $loggedId  =$_REQUEST['loggedId'];
       $chgStatus =CompanyRequest::model()->findByPk(array('id'=>$id));

       //$chgStatus->job_status=1;
       $chgStatus->delete();
       echo "success";die; 
    }
    /*code to decline the request from customer dashboard */
    public function actionDeclineNewRequestsCustomer()
    {
       $id        =$_REQUEST['id'];
       $loggedId  =$_REQUEST['loggedId'];
       $chgStatus =CompanyRequest::model()->findByPk(array('id'=>$id));

       //$chgStatus->job_status=1;
       $chgStatus->delete();
       echo "success";die; 
    }
    /*code to chnage the ststu from customer dashboard accept*/
    public function actionStatusForNewRequestsCustomer()
    {
       $id        =$_REQUEST['id'];
       $loggedId  =$_REQUEST['loggedId'];
       $chgStatus =CompanyRequest::model()->findByPk(array('id'=>$id));

       $chgStatus->job_status=1;
       $chgStatus->save();
       echo "success";die;
    } 

    /*code to chk the inbox message without reload the page in company dashboard*/
    public function actionAutoChkMsgNotiComp()
    {
    	echo "<pre>";print_r($_REQUEST);die;
    }

    /*function to check the active jobs in company dashboard*/
    public function actionActiveJobsInCompany()
    {
       $loggedId   =$_REQUEST['ajaxlogId'];
       $id         =$_REQUEST['id'];
       $activeJobs =CompanyRequest::model()->findByPk(array('id'=>$id));
       
       $bookId     =$activeJobs['booking_id']; 
       $bookingRec =Booking::model()->findByPk(array('id'=>$bookId));
       
       /*email to customer starts here*/
          $subject = 'Welcome to Wow Cleans';
                                $body = $this->renderPartial('customerNotificationEmail', array(
                                'model'=>$bookingRec,
                               
                                //'password'=>$cleartext_password,
                                //'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
                                //'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                              ), true); 
                                                         
         Yii::app()->mailer->send($bookingRec->customer['email'], $subject, $body);  
       /*email to customer ends here */

       $url=Yii::app()->request->baseUrl;
        echo '
          <div id="active">
          <div class="active_left">
                  <div class="left-1"> <img src="'.  $url.'/banner/$bookingRec->serviceType["image"] " alt=""> </div>
                      <div class="right-2">
                        <h4>'.  $bookingRec->customer["cname"].' '.  $d->customer["clname"].' </h4>
                        <p>'. $bookingRec->service["city"].' to '. $bookingRec->customerAddress["address"].'</p>
           
                      </div>
          </div>
          </div>

        '; die;
           
        
       
       
       //echo "<pre>";print_r($activeJobs);die;
    }
     /*edit quote with ajax */
     public function actionEditJobQuoteCustomer()
     {
           echo "<pre>";print_r($_REQUEST);die;
           if(!empty($_REQUEST))
           {
                $id=$_REQUEST['book'];

                $postcode       =$_REQUEST['CleaningTime']['PostCode'];
                $cleaningDate   =date('y-m-d',strtotime($_REQUEST['CleaningTime']['CleaningDate']));
                $time           =$_REQUEST['CleaningTime']['time'];

                $compnyReq=CompanyRequest::model()->find(array('condition'=>'booking_id=:booking_id','params'=>array(
                                      ':booking_id'=>$id,
                )));

                $compReq->cleaningtime =$time;
                $compReq->cleaningdate =$cleaningDate;
                $compReq->postcode     =$postcode;
                
                $compReq->save();

                $service_type_id   =$_REQUEST['ServiceTypes']['service_name']; 


           } 
     }
    /*Edit quote in customer dashboard*/
    public function actionEdit()
    {  


        $model=new CleaningTime;
		    $service=new ServiceTypes;
		    $list  =CleaningTime::model()->findAll();
        
        $zip=UkPostcodes::model()->findAll();
 
         //echo "<pre>";print_r($zip);die; 
        foreach($zip as $z)
        {
        	$post[]=$z->postcode;
        } 
        
        $uniquePost=array_unique($post); 
        
        $record=CompanyRequest::model()->find(array('condition'=>'booking_id=:booking_id AND job_status=:job_status','params'=>array(
                              
                              ':booking_id'=>$_REQUEST['id'],
                              ':job_status'=>1,
        )));
         //echo "<pre>";print_r($rec->booking);die;
         $ser=ServiceTypes::model()->findAll();
         foreach($ser as $se)
         {
         	 $ids[]    =$se['id'];
         	 $serNam[]=$se['service_name'];
         	 $serName=array_combine($ids, $serNam);
         }	
            
         //echo "<pre>";print_r($serName);die; 
         if(isset($_POST['CleaningTime']))
         {

         	 //echo "<pre>";print_r($_REQUEST);die;
         	  $id=$_REQUEST['book'];
              
              $re=CompanyRequest::model()->find(array('condition'=>'booking_id=:booking_id ','params'=>array(
                              
                              ':booking_id'=>$_REQUEST['book'],
                              
              ))); 
         	  $re->postcode     =$_REQUEST['CleaningTime']['PostCode'];
         	  $re->cleaningtime =$_REQUEST['CleaningTime']['time'];
         	  $re->cleaningdate =date('y-m-d',strtotime($_REQUEST['CleaningTime']['CleaningDate']));

         	  $re->save(false);


            $booking =Booking::model()->findByPk(array('id'=>$id));

            $service_type_id=$_REQUEST['ServiceTypes']['service_name'];
            
            $booking->service_type_id= $service_type_id;
            /*if(!empty($_REQUEST['Booking']))
            {  */
                 if($service_type_id==3)
                 { 
                 foreach ($_REQUEST['Booking'] as  $key=>$value) {
                      
                       //$r.=$value."-".$key.",";
                    $newAr[] = $value."-".$key;
                           
                  }
                  $data = implode(',', $newAr);
                  //echo "<pre>";print_r($data);die;
                 $booking->cleaningDetail=$data;
                 }
                 else
                 {

                 foreach (array_slice($_REQUEST['Booking'],0,2) as  $key=>$value) {
                      
                       //$r.=$value."-".$key.",";
                    $newAr[] = $value."-".$key;
                           
                  }
                  $data = implode(',', $newAr);
                  //echo "<pre>";print_r($data);die;
                 $booking->cleaningDetail=$data;
                 }
           //}
             //echo "<pre>";print_r($r);die;
            if(!empty($_REQUEST['Additional']))
            {  
              //$booking->cleaningDetail=$r;
              foreach ($_REQUEST['Additional'] as  $key=>$value) {
                  //echo "<pre>";print_r($value);
                   $res[]=$value."-".$key;
                       
              }
              $data1 = implode(',', $res);
              $booking->additional=$data1;
              
            }
            
            /*email to customer starts here*/
          $subject = 'Welcome to Wow Cleans';
                                $body = $this->renderPartial('updatedquoteEmail', array(
                                'model'=>$booking,
                               
                                //'password'=>$cleartext_password,
                                //'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
                                //'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                              ), true); 
                                                         
         Yii::app()->mailer->send($booking->service['email'], $subject, $body);  
       /*email to customer ends here */



            $booking->save(false);


         	  $this->redirect(array('customerdashboard')); 
         }	
       

    	 $links=CmsPages::model()->findAll();
         Yii::app()->params['MyArray'] = $links;

    	 $this->render('edit',array('list'=>$list,'model'=>$model,'Post'=>$uniquePost,'rec'=>$record,'serName'=>$serName,'service'=>$service));
    } 
    

    /*function to view the view quotes in customer dashboard*/
    public function actionViewquotes()
    {
    	 $id         =$_REQUEST['id'];
    	 $bookingRec =Booking::model()->with('companyRequests')->findByPk(array('id'=>$id));
    		//die;
          //echo $r;die;

          /*listing all the quotes*/


    	 $links=CmsPages::model()->findAll();
         Yii::app()->params['MyArray'] = $links; 
    	 $this->render('viewquotes',array('bookingRec'=>$bookingRec));
    }
    /*view quotes for company dashboard*/
    public function actionViewquotesDashboard()
    {
        $id         =$_REQUEST['id'];
       $bookingRec =Booking::model()->with('companyRequests')->findByPk(array('id'=>$id));
        //die;
          //echo $r;die;

          /*listing all the quotes*/


       $links=CmsPages::model()->findAll();
         Yii::app()->params['MyArray'] = $links; 
       $this->render('viewquotesDashboard',array('bookingRec'=>$bookingRec));
    }
     

     /*update price for specific user from comapny dashboard*/
     public function actionUpdatePriceforspecificCustomer()
     {
         $id    =$_REQUEST['updateId'];
         $price =$_REQUEST['val'];
         if(!empty($_REQUEST))
         {
             $booking=Booking::model()->findByPk(array('id'=>$id));
             $booking->price=$price;
             
             /*email to customer starts here*/
          $subject = 'Welcome to Wow Cleans';
                                $body = $this->renderPartial('companyEditQuoteForSpecific', array(
                                'model'=>$booking,
                               
                                //'password'=>$cleartext_password,
                                //'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
                                //'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                              ), true); 
                                                         
         Yii::app()->mailer->send($booking->customer['email'], $subject, $body);  
       /*email to customer ends here */  

             $booking->save(false);
             echo "success";die;
         }
     }
    /*change the status for service type in company dashboard*/
    public function actionStatusTypeCompany()
    {
       $loggedId=$_REQUEST['loggedId'];
       $typeId  =$_REQUEST['id'];
       $model   =new ServicestatusBycompany;  
       $servcStatus=ServicestatusBycompany::model()->find(array('condition'=>'service_id=:service_id AND service_type_id=:service_type_id','params'=>array(
                                    ':service_id'     =>$loggedId,
                                    ':service_type_id'=>$typeId,

        )));

       if(!empty($servcStatus))
       {
           echo "Mohit";
       }
       else
       {
              $model->service_id       =$loggedId;
              $model->service_type_id  =$typeId;
              $model->status           =1;
              $model->date             =date('y-m-d');
              $model->save(false);
              echo "success";
       } 



    }
    // public function to get the details for job quotes on the same page
    public function actionJobRequestResPage()
    {
       //echo "<pre>";print_r($_REQUEST);die;
       $id            =$_REQUEST['id'];
       $loggedId      =$_REQUEST['loggedId']; 
       //echo $id;die;
       //$compnyRestId  =CompanyRequest::model()->findByPk(array('id'=>$id));
       //$bookingId     =$compnyRestId['booking_id'];
       $admin         =new ParticularPrice;  
       $adnl          =new AdditionalParticularPrice; 
       $price         =new ParticularPrice;
       $loggedId      =Yii::app()->session['loggedId'];
       $providerId    =CompanyRequest::model()->findByPk(array('id'=>$id));
       $bookId        =$providerId['booking_id'];

       $conversation =new MsgDetails;
       $conver       =new ConversationMsg;

       $bookingrec   =Booking::model()->findByPk(array('id'=>$bookId));

          //echo "<pre>";print_r($bookingrec);die;
          $servicetype  =$bookingrec['service_type_id'];
          $provId       =$bookingrec['service_id'];   
        

            


          
          // echo $bookingId;die; 

          $priceAdmin   =PriceAdmin::model()->find(array('condition'=>'service_id=:service_id AND service_type_id=:service_type_id','params'=>array(
                                 
                            ':service_id'       =>$provId,
                            ':service_type_id'  =>$servicetype,
          )));
          
          

          $addPriceDetl= AdditionalServicePrice::model()->findAll(array('condition'=>'service_id=:service_id','params'=>array(
                             ':service_id'     =>$provId,
         
            )));
           
           $particularRec=ParticularPrice::model()->find(array('condition'=>'booking_id=:booking_id','params'=>array(
                             ':booking_id'=>$_REQUEST['booking_id'],
            )));
           

          /*code to save the particular quote*/
          if(isset($_REQUEST['ParticularPrice']))
          {
              
              $partiRecord=ParticularPrice::model()->find(array('condition'=>'booking_id=:booking_id','params'=>array(
                               ':booking_id'=>$_REQUEST['booking_id'],
              )));
               
               if(!empty($partiRecord))
               {
                    //echo "<pre>";print_r($_REQUEST);die;
                       $priceParticular=ParticularPrice::model()->find(array('condition'=>'booking_id=:booking_id','params'=>array(
                                 ':booking_id'=>$_REQUEST['booking_id'],
                     )));

                     foreach($_REQUEST['ParticularPrice'] as  $k=>$p)
                    {
                       if($k == "bedroom") $modifiedKey = "Bedrooms";
                       else if($k == "bathroom") $modifiedKey = "Bathrooms";
                       else if($k == "property") $modifiedKey = "Property";
                       else if($k == "desk") $modifiedKey = "Desk";                 

                       $firstArrayVal = $_REQUEST['noBedBathDesk'][$modifiedKey];                
                     
                      
                        $newAr[] = $firstArrayVal * $p;
                        $priceParticular->$k=$p;
                        
                           

                       // $k++;
                    } 

                    $result=array_sum($newAr);
                    $priceParticular->particular_price=$result;
                    $priceParticular->save(false);

                          /*chnage the details for additional particular prices*/

                    $additionalPartiPrice=AdditionalParticularPrice::model()->findAll(array('condition'=>'booking_id=:booking_id','params'=>array(

                                             ':booking_id'=>$_REQUEST['booking_id'],
                    )));
                          
                          //foreach($additionalPartiPrice) 
                    //echo "<pre>";print_r($additionalPartiPrice);die;
                  if(!empty($_REQUEST['AdditionalParticularPrice']))
                  { 
                     //echo "<pre>";print_r($_REQUEST);die;
                     
                       foreach($additionalPartiPrice as $key=>$edit)
                       {
                           foreach($_REQUEST['AdditionalParticularPrice'] as $k=>$adnlprice)
                             {
                                
                                   $edit->price                =$adnlprice;
                                
                                                                 
                                 $total = array();
                                 foreach($_REQUEST['AdditionalParticularPrice'] as $key=>$adnlpr)
                                 {
                                     $total[] = $adnlpr * $_REQUEST['adnl'][$key];
                                                      
                                    //echo "<pre>";print_r($total);    
                                 } //die;
                                  $sum1=array_sum($total);
                                  $edit->total_price=$sum1+$result;
                                 $edit->save(false);
                             }
                        } 

                  }  
                 
                 /* mail to customer*/
                         $subject = 'Welcome to Wow Cleans';
                                $body = $this->renderPartial('chnagequoteparticularCustomerEmail', array(
                                'model'=>$partiRecord,
                               
                                //'password'=>$cleartext_password,
                                //'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
                                //'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                              ), true); 
                                                         
                         Yii::app()->mailer->send($partiRecord->customer['email'], $subject, $body);  
                       /*mail to company */
                        $subject = 'Welcome to Wow Cleans';
                                $body = $this->renderPartial('chnagequoteparticularCustomerEmail', array(
                                'model'=>$partiRecord,
                               
                                //'password'=>$cleartext_password,
                                //'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
                                //'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                              ), true); 
                                                         
                         Yii::app()->mailer->send($partiRecord->customer['email'], $subject, $body);  
                                      
                    $this->redirect(array('dashboard'));

               }  
               else
               {

                      
                    $price->customer_id=$_REQUEST['customer_id'];
                    $price->service_id =$loggedId;
                    $price->booking_id =$_REQUEST['booking_id'];
                    $price->date       =date('Y-m-d');
                    //$k=0;
                    foreach($_REQUEST['ParticularPrice'] as  $k=>$p)
                    {
                       if($k == "bedroom") $modifiedKey = "Bedrooms";
                       else if($k == "bathroom") $modifiedKey = "Bathrooms";               
                       else if($k == "property") $modifiedKey = "Property";
                       else if($k == "desk") $modifiedKey = "Desk";  

                       $firstArrayVal = $_REQUEST['noBedBathDesk'][$modifiedKey];                
                     
                      
                        $newAr[] = $firstArrayVal * $p;
                        $price->$k=$p;
                        
                           

                       // $k++;
                    } 

                    $result=array_sum($newAr);
                    $price->particular_price=$result;
                    $price->save(false);
                     
                    if(!empty($_REQUEST['AdditionalParticularPrice']))
                    {
                         
                         //$total = array();
                         foreach($_REQUEST['AdditionalParticularPrice'] as $k=>$adnlprice)
                         {
                            $adnl    =new AdditionalParticularPrice; 
                            $adnl->service_id           =$loggedId;
                            $adnl->customer_id          =$_REQUEST['customer_id'];
                            $adnl->booking_id           =$_REQUEST['booking_id']; 
                            $adnl->date                 =date('Y-m-d'); 
                            $adnl->additional_service_id=$k;
                            
                             $adnl->price                =$adnlprice;

                             $total = array();
                             foreach($_REQUEST['AdditionalParticularPrice'] as $key=>$adnlpr)
                             {
                                 $total[] = $adnlpr * $_REQUEST['adnl'][$key];
                                                  
                                //echo "<pre>";print_r($total);    
                             } //die;
                              $sum1=array_sum($total);
                              $adnl->total_price=$sum1+$result;
                             $adnl->save(false);
                         } //die;
                          
                    } 
                     
                    //die("fsdfsd"); 
                    /* mail to customer*/
                          $subject = 'Welcome to Wow Cleans';
                                $body = $this->renderPartial('chnagequoteparticularCustomerEmail', array(
                                'model'=>$particularRec,
                               
                                //'password'=>$cleartext_password,
                                //'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
                                //'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                              ), true); 
                                                         
                         Yii::app()->mailer->send($partiRecord->customer['email'], $subject, $body);  
                       /*mail to company */
                        $subject = 'Welcome to Wow Cleans';
                                $body = $this->renderPartial('chnagequoteparticularCustomerEmail', array(
                                'model'=>$particularRec,
                               
                                //'password'=>$cleartext_password,
                                //'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
                                //'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                              ), true); 
                                                         
                         Yii::app()->mailer->send($partiRecord->customer['email'], $subject, $body);
                    
                         $this->redirect(array('dashboard'));   
              
               }





              //$price
             // echo "<pre>";print_r($_REQUEST);die;
          }  
          //echo "<pre>";print_r($particularRec);die;
          //$links=CmsPages::model()->findAll();
         //Yii::app()->params['MyArray'] = $links; 
          $this->renderPartial('chnagequotesDashboardSpeciUser',array('bookingrec'=>$bookingrec,'priceAdmin'=>$priceAdmin,'admin'=>$admin,'addPriceDetl'=>$addPriceDetl,'adnl'=>$adnl,'particularRec'=>$particularRec,'id'=>$id,'conversation'=>$conversation));
      
              
    }

    // update the price for quote with ajax
    public function actionUpdatePriceForQuote()
    {
        //echo "<pre>";print_r($_REQUEST);die;
        $id            =$_REQUEST['id']; 
       //$compnyRestId  =CompanyRequest::model()->findByPk(array('id'=>$id));
       //$bookingId     =$compnyRestId['booking_id'];
       $admin         =new ParticularPrice;  
       $adnl          =new AdditionalParticularPrice; 
       $price         =new ParticularPrice;
       $conver        =new ConversationMsg;
       $conversation  =new MsgDetails; 
        $loggedId      =Yii::app()->session['loggedId'];
         if(isset($_REQUEST['ParticularPrice']))
          {
             
             // add record to msg converstion table and msg details
            $senderId          =$loggedId;
            $reciverId         =$_REQUEST['customer_id'];
            $booID             =$_REQUEST['booking_id'];

            $conver->sender_id     =$senderId;
            $conver->sender_type   ='company';
            $conver->reciver_id    =$reciverId;
            $conver->booking_id    =$booID;
            $conver->reciver_type  ='customer';
            $conver->sender_status =1;
            $conver->subject       ='Update Quote';
            $conver->save(false);

            $insert_idConver = Yii::app()->db->getLastInsertID();
            
            $conversation->conversation_id =$insert_idConver;
            $conversation->user_type       = 'company';
            $conversation->user_id         =$loggedId;
            $conversation->booking_id      =$booID;
            $conversation->tomsg           =$reciverId;
            $conversation->msg             =$_REQUEST['MsgDetails']['msg'];
            $conversation->save(false);
            // add record to msg conversation table and msg details

              $partiRecord=ParticularPrice::model()->find(array('condition'=>'booking_id=:booking_id','params'=>array(
                               ':booking_id'=>$_REQUEST['booking_id'],
              )));
               
               if(!empty($partiRecord))
               {
                    //echo "<pre>";print_r($_REQUEST);die;
                       $priceParticular=ParticularPrice::model()->find(array('condition'=>'booking_id=:booking_id','params'=>array(
                                 ':booking_id'=>$_REQUEST['booking_id'],
                     )));

                     foreach($_REQUEST['ParticularPrice'] as  $k=>$p)
                    {
                       if($k == "bedroom") $modifiedKey = "Bedrooms";
                       else if($k == "bathroom") $modifiedKey = "Bathrooms";
                       else if($k == "property") $modifiedKey = "Property";
                       else if($k == "desk") $modifiedKey = "Desk";                 

                       $firstArrayVal = $_REQUEST['noBedBathDesk'][$modifiedKey];                
                     
                      
                        $newAr[] = $firstArrayVal * $p;
                        $priceParticular->$k=$p;
                        
                           

                       // $k++;
                    } 

                    $result=array_sum($newAr);
                    $priceParticular->particular_price=$result;
                    $priceParticular->save(false);

                          /*chnage the details for additional particular prices*/

                    $additionalPartiPrice=AdditionalParticularPrice::model()->findAll(array('condition'=>'booking_id=:booking_id','params'=>array(

                                             ':booking_id'=>$_REQUEST['booking_id'],
                    )));
                          
                          //foreach($additionalPartiPrice) 
                    //echo "<pre>";print_r($additionalPartiPrice);die;
                  if(!empty($_REQUEST['AdditionalParticularPrice']))
                  { 
                     
                       foreach($additionalPartiPrice as $key=>$edit)
                       {
                           foreach($_REQUEST['AdditionalParticularPrice'] as $k=>$adnlprice)
                             {
                                
                                   $edit->price                =$adnlprice;
                                
                                                                 
                                 $total = array();
                                 foreach($_REQUEST['AdditionalParticularPrice'] as $key=>$adnlpr)
                                 {
                                     $total[] = $adnlpr * $_REQUEST['adnl'][$key];
                                                      
                                    //echo "<pre>";print_r($total);    
                                 } //die;
                                  $sum1=array_sum($total);
                                  $edit->total_price=$sum1+$result;
                                 $edit->save(false);
                             }
                        } 

                  }  
                 
                 /* mail to customer*/
                         $subject = 'Welcome to Wow Cleans';
                                $body = $this->renderPartial('chnagequoteparticularCustomerEmail', array(
                                'model'=>$partiRecord,
                               
                                //'password'=>$cleartext_password,
                                //'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
                                //'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                              ), true); 
                                                         
                         Yii::app()->mailer->send($partiRecord->customer['email'], $subject, $body);  
                       /*mail to company */
                        
                    echo "success";die;

               }  
               else
               {
                  //echo "fsfsf";die;
                      
                    $price->customer_id=$_REQUEST['customer_id'];
                    $price->service_id =$loggedId;
                    $price->booking_id =$_REQUEST['booking_id'];
                    $price->date       =date('Y-m-d');
                    //$k=0;
                    foreach($_REQUEST['ParticularPrice'] as  $k=>$p)
                    {
                       if($k == "bedroom") $modifiedKey = "Bedrooms";
                       else if($k == "bathroom") $modifiedKey = "Bathrooms";               
                       else if($k == "property") $modifiedKey = "Property";
                       else if($k == "desk") $modifiedKey = "Desk";  

                       $firstArrayVal = $_REQUEST['noBedBathDesk'][$modifiedKey];                
                     
                      
                        $newAr[] = $firstArrayVal * $p;
                        $price->$k=$p;
                        
                           

                       // $k++;
                    } 

                    $result=array_sum($newAr);
                    $price->particular_price=$result;
                    $price->save(false);
                     
                    if(!empty($_REQUEST['AdditionalParticularPrice']))
                    {
                          
                         //$total = array();
                         foreach($_REQUEST['AdditionalParticularPrice'] as $k=>$adnlprice)
                         {
                            $adnl    =new AdditionalParticularPrice; 
                            $adnl->service_id           =$loggedId;
                            $adnl->customer_id          =$_REQUEST['customer_id'];
                            $adnl->booking_id           =$_REQUEST['booking_id']; 
                            $adnl->date                 =date('Y-m-d'); 
                            $adnl->additional_service_id=$k;
                            
                             $adnl->price                =$adnlprice;

                             $total = array();
                             foreach($_REQUEST['AdditionalParticularPrice'] as $key=>$adnlpr)
                             {
                                 $total[] = $adnlpr * $_REQUEST['adnl'][$key];
                                                  
                                //echo "<pre>";print_r($total);    
                             } //die;
                              $sum1=array_sum($total);
                              $adnl->total_price=$sum1+$result;
                             $adnl->save(false);
                         } //die;
                          
                    } 
                     
                    //die("fsdfsd"); 
                    /* mail to customer*/
                          $subject = 'Welcome to Wow Cleans';
                                $body = $this->renderPartial('chnagequoteparticularCustomerEmail', array(
                                'model'=>$particularRec,
                               
                                //'password'=>$cleartext_password,
                                //'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
                                //'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                              ), true); 
                                                         
                         Yii::app()->mailer->send($partiRecord->customer['email'], $subject, $body);  
                       echo "success";die;
              
               }
             

          }
    }
    /*chnage quotes for specific user dashboard*/

    public function actionChnagequotesDashboardSpeciUser()
    {

           //$id      =$_REQUEST['id'];
           $admin   =new ParticularPrice;  
           $adnl    =new AdditionalParticularPrice; 
           $price   =new ParticularPrice;
          $loggedId =Yii::app()->session['loggedId'];
          $providerId   =CompanyRequest::model()->findByPk(array('id'=>$id));
          $bookId       =$providerId['booking_id'];

          $bookingrec   =Booking::model()->findByPk(array('id'=>$bookId));

          //echo "<pre>";print_r($bookingrec);die;
          $servicetype  =$bookingrec['service_type_id'];
          $provId       =$bookingrec['service_id'];   
         
          
          // echo $bookingId;die; 

          $priceAdmin   =PriceAdmin::model()->find(array('condition'=>'service_id=:service_id AND service_type_id=:service_type_id','params'=>array(
                                 
                            ':service_id'       =>$provId,
                            ':service_type_id'  =>$servicetype,
          )));
          
          

          $addPriceDetl= AdditionalServicePrice::model()->findAll(array('condition'=>'service_id=:service_id','params'=>array(
                             ':service_id'     =>$provId,
         
            )));
           
           $particularRec=ParticularPrice::model()->find(array('condition'=>'booking_id=:booking_id','params'=>array(
                             ':booking_id'=>$_REQUEST['booking_id'],
            )));
           

          /*code to save the particular quote*/
          if(isset($_REQUEST['ParticularPrice']))
          {
              
	            $partiRecord=ParticularPrice::model()->find(array('condition'=>'booking_id=:booking_id','params'=>array(
	                             ':booking_id'=>$_REQUEST['booking_id'],
	            )));
               
               if(!empty($partiRecord))
               {
               	    //echo "<pre>";print_r($_REQUEST);die;
	                     $priceParticular=ParticularPrice::model()->find(array('condition'=>'booking_id=:booking_id','params'=>array(
		                             ':booking_id'=>$_REQUEST['booking_id'],
		                 )));

		                 foreach($_REQUEST['ParticularPrice'] as  $k=>$p)
			              {
			                 if($k == "bedroom") $modifiedKey = "Bedrooms";
			                 else if($k == "bathroom") $modifiedKey = "Bathrooms";
                       else if($k == "property") $modifiedKey = "Property";
                       else if($k == "desk") $modifiedKey = "Desk";                 

			                 $firstArrayVal = $_REQUEST['noBedBathDesk'][$modifiedKey];                
			               
			                
			                  $newAr[] = $firstArrayVal * $p;
			                  $priceParticular->$k=$p;
			                  
			                     

			                 // $k++;
			              } 

			              $result=array_sum($newAr);
			              $priceParticular->particular_price=$result;
			              $priceParticular->save(false);

                          /*chnage the details for additional particular prices*/

			              $additionalPartiPrice=AdditionalParticularPrice::model()->findAll(array('condition'=>'booking_id=:booking_id','params'=>array(

                                             ':booking_id'=>$_REQUEST['booking_id'],
			              )));
                          
                          //foreach($additionalPartiPrice) 
			              //echo "<pre>";print_r($additionalPartiPrice);die;
			            if(!empty($_REQUEST['AdditionalParticularPrice']))
			            { 
			            	 //echo "<pre>";print_r($_REQUEST);die;
				             /* foreach($additionalPartiPrice as $key=>$edit)
				              {
				              	  //echo "<pre>";print_r($edit);
				              	       foreach($_REQUEST['AdditionalParticularPrice'] as $k=>$adnlprice)
						              {
						                  //echo "<pre>";print_r($adnlprice);      
						                  if($edit['additional_service_id']==$k)
						                  {	
						                     $edit->price                =$adnlprice;
						                  } 
						                  // $sum = 0;
						                  foreach($_REQUEST['adnl'] as $tot)
						                  {
						                      $arr[] =$tot*$adnlprice;
						                      $res =array_sum($arr);

						                  }
						                   $edit->total_price=$res+$result;
						                   $edit->save(false);
						                                  
						                      $res=array(); 
						                      $arr=array(); 
						                 					                 
						              }
				              	 
				              } */
                       foreach($additionalPartiPrice as $key=>$edit)
                       {
                           foreach($_REQUEST['AdditionalParticularPrice'] as $k=>$adnlprice)
                             {
                                
                                   $edit->price                =$adnlprice;
                                
                                                                 
                                 $total = array();
                                 foreach($_REQUEST['AdditionalParticularPrice'] as $key=>$adnlpr)
                                 {
                                     $total[] = $adnlpr * $_REQUEST['adnl'][$key];
                                                      
                                    //echo "<pre>";print_r($total);    
                                 } //die;
                                  $sum1=array_sum($total);
                                  $edit->total_price=$sum1+$result;
                                 $edit->save(false);
                             }
                        } 

			            }  
			           
			           /* mail to customer*/
                         $subject = 'Welcome to Wow Cleans';
                                $body = $this->renderPartial('chnagequoteparticularCustomerEmail', array(
                                'model'=>$partiRecord,
                               
                                //'password'=>$cleartext_password,
                                //'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
                                //'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                              ), true); 
                                                         
                         Yii::app()->mailer->send($partiRecord->customer['email'], $subject, $body);  
	                     /*mail to company */
	                      $subject = 'Welcome to Wow Cleans';
                                $body = $this->renderPartial('chnagequoteparticularCustomerEmail', array(
                                'model'=>$partiRecord,
                               
                                //'password'=>$cleartext_password,
                                //'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
                                //'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                              ), true); 
                                                         
                         Yii::app()->mailer->send($partiRecord->customer['email'], $subject, $body);  
	                      	            
			              $this->redirect(array('dashboard'));

               }	
               else
               {

               	      
			              $price->customer_id=$_REQUEST['customer_id'];
			              $price->service_id =$loggedId;
			              $price->booking_id =$_REQUEST['booking_id'];
			              $price->date       =date('Y-m-d');
			              //$k=0;
			              foreach($_REQUEST['ParticularPrice'] as  $k=>$p)
			              {
			                 if($k == "bedroom") $modifiedKey = "Bedrooms";
			                 else if($k == "bathroom") $modifiedKey = "Bathrooms";               
                       else if($k == "property") $modifiedKey = "Property";
                       else if($k == "desk") $modifiedKey = "Desk";  

			                 $firstArrayVal = $_REQUEST['noBedBathDesk'][$modifiedKey];                
			               
			                
			                  $newAr[] = $firstArrayVal * $p;
			                  $price->$k=$p;
			                  
			                     

			                 // $k++;
			              } 

			              $result=array_sum($newAr);
			              $price->particular_price=$result;
			              $price->save(false);
			               
			              if(!empty($_REQUEST['AdditionalParticularPrice']))
			              {
			              	    /*   foreach($_REQUEST['AdditionalParticularPrice'] as $k=>$adnlprice)
					               {
					                  $adnl    =new AdditionalParticularPrice; 
					                  $adnl->service_id           =$loggedId;
					                  $adnl->customer_id          =$_REQUEST['customer_id'];
					                  $adnl->booking_id           =$_REQUEST['booking_id']; 
					                  $adnl->date                 =date('Y-m-d'); 
					                  $adnl->additional_service_id=$k;
					                  
					                  $adnl->price                =$adnlprice;
					                  // $sum = 0;
					                  foreach($_REQUEST['adnl'] as $tot)
					                  {
					                      $arr[] =$tot*$adnlprice;
					                      $res =array_sum($arr);

					                  }
					                   $adnl->total_price=$res+$result;
					                   $adnl->save(false);
					                                  
					                      $res=array(); 
					                      $arr=array(); 
					                  
					                 
					              } */
                         //$total = array();
                         foreach($_REQUEST['AdditionalParticularPrice'] as $k=>$adnlprice)
                         {
                            $adnl    =new AdditionalParticularPrice; 
                            $adnl->service_id           =$loggedId;
                            $adnl->customer_id          =$_REQUEST['customer_id'];
                            $adnl->booking_id           =$_REQUEST['booking_id']; 
                            $adnl->date                 =date('Y-m-d'); 
                            $adnl->additional_service_id=$k;
                            
                             $adnl->price                =$adnlprice;

                             $total = array();
                             foreach($_REQUEST['AdditionalParticularPrice'] as $key=>$adnlpr)
                             {
                                 $total[] = $adnlpr * $_REQUEST['adnl'][$key];
                                                  
                                //echo "<pre>";print_r($total);    
                             } //die;
                              $sum1=array_sum($total);
                              $adnl->total_price=$sum1+$result;
                             $adnl->save(false);
                         } //die;
                          
			              } 
			               
			              //die("fsdfsd"); 
			              /* mail to customer*/
                          $subject = 'Welcome to Wow Cleans';
                                $body = $this->renderPartial('chnagequoteparticularCustomerEmail', array(
                                'model'=>$particularRec,
                               
                                //'password'=>$cleartext_password,
                                //'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
                                //'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                              ), true); 
                                                         
                         Yii::app()->mailer->send($partiRecord->customer['email'], $subject, $body);  
	                     /*mail to company */
	                      $subject = 'Welcome to Wow Cleans';
                                $body = $this->renderPartial('chnagequoteparticularCustomerEmail', array(
                                'model'=>$particularRec,
                               
                                //'password'=>$cleartext_password,
                                //'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
                                //'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                              ), true); 
                                                         
                         Yii::app()->mailer->send($partiRecord->customer['email'], $subject, $body);
			              
                         $this->redirect(array('dashboard'));   
              
               }





              //$price
             // echo "<pre>";print_r($_REQUEST);die;
          }  
          $links=CmsPages::model()->findAll();
         Yii::app()->params['MyArray'] = $links; 
          $this->render('chnagequotesDashboardSpeciUser',array('bookingrec'=>$bookingrec,'priceAdmin'=>$priceAdmin,'admin'=>$admin,'addPriceDetl'=>$addPriceDetl,'adnl'=>$adnl,'particularRec'=>$particularRec));
      
    }

    /*ajax update price for specific quote*/
    public function actionAjaxupdatePrice()
    {
    	  $partiRecord=ParticularPrice::model()->find(array('condition'=>'booking_id=:booking_id','params'=>array(
	                             ':booking_id'=>$_REQUEST['booking_id'],
	            )));
               //echo "<pre>";print_r($_REQUEST['booking_id']);die; 
               if(!empty($partiRecord))
               {
               	    //echo "<pre>";print_r($_REQUEST);die;
	                     $priceParticular=ParticularPrice::model()->find(array('condition'=>'booking_id=:booking_id','params'=>array(
		                             ':booking_id'=>$_REQUEST['booking_id'],
		                 )));

		                 foreach($_REQUEST['ParticularPrice'] as  $k=>$p)
			              {
                       //echo "<pre>";print_r($k);
			                 if($k == "bedroom") $modifiedKey = "Bedrooms";
			                 else if($k == "bathroom") $modifiedKey = "Bathrooms";
                       else if($k == "property") $modifiedKey = "Property";
                       else if($k == "desk") $modifiedKey = "Desk";               

			                 $firstArrayVal = $_REQUEST['noBedBathDesk'][$modifiedKey];                
			               
			                
			                  $newAr[] = $firstArrayVal * $p;
			                  //$priceParticular->$k=$p;
			                  
			                     
                        
			                 // $k++;
			              } //die;
                    //echo "<pre>";print_r($newAr); 
			              $firstsum=array_sum($newAr);
			              //echo "<pre>";print_r($firstsum);

                          /*chnage the details for additional particular prices*/

			              $additionalPartiPrice=AdditionalParticularPrice::model()->findAll(array('condition'=>'booking_id=:booking_id','params'=>array(

                                             ':booking_id'=>$_REQUEST['booking_id'],
			              )));
                          
                          //echo "<pre>";print_r($additionalPartiPrice);die;
                          
			            if(!empty($_REQUEST['AdditionalParticularPrice']))
			            { 
			            	    
                          $total = array();
                         foreach($_REQUEST['AdditionalParticularPrice'] as $k=>$adnlprice)
                         {
                             $total[] = $adnlprice * $_REQUEST['adnl'][$k];
                                              
                            
                         } //echo "<pre>";print_r($total);    die;
                          $sum1=array_sum($total);
                          //echo $sum1;die;
						              
						       
			            }  
                      $sumRes1=$sum1+$firstsum;
                    //echo $sumRes;
                    echo "Total Price:";
                    echo $sumRes1; die;
			          
               }
               else
               {
               	    //echo "gdgd";die;
                    foreach($_REQUEST['ParticularPrice'] as  $k=>$p)
			              {
			                 if($k == "bedroom") $modifiedKey = "Bedrooms";
			                 else if($k == "bathroom") $modifiedKey = "Bathrooms";               
                       else if($k == "property") $modifiedKey = "Property";
                       else if($k == "desk") $modifiedKey = "Desk"; 
			                 $firstArrayVal = $_REQUEST['noBedBathDesk'][$modifiedKey];                
			               
			                
			                  $newAr[] = $firstArrayVal * $p;
			                  //$price->$k=$p;
			                  
			                 // $k++;
			              } 
                     //echo "<pre>";print_r($newAr);
			              $result=array_sum($newAr);
                  			               
			              if(!empty($_REQUEST['AdditionalParticularPrice']))
			              {
                         $total = array();
			              	   foreach($_REQUEST['AdditionalParticularPrice'] as $k=>$adnlprice)
					              {
					                   $total[] = $adnlprice * $_REQUEST['adnl'][$k];
					                                    
					                  //echo "<pre>";print_r($total);    
					              } //echo "<pre>";print_r($total); 
                          $sum=array_sum($total);
                          
					              // echo "Total Price:"." ".$sum+$result; 
			              } 
                    //echo $sum;die;
                    $sumRes=$sum+$result;
                    //echo $sumRes;
                    echo "Total Price:";
                    echo $sumRes; die;
               }	
    	
        }
      /*function to change the status  by company to choose service */  
     public function actionChangestatusServiceByCompany()
     {
     	 $typeId   =$_REQUEST['typeId'];
     	 $loggedId =$_REQUEST['loggedId'];
     	 $status   =new ServicestatusBycompany;
     	 $find     =ServicestatusBycompany::model()->find(array('condition'=>'service_type_id=:service_type_id AND service_id=:service_id','params'=>array(
                                           ':service_type_id'=>$typeId,
                                           ':service_id'     =>$loggedId,
     	 )));

     	 if(empty($find))
     	 {
            $status->service_id      =$loggedId;
            $status->service_type_id =$typeId;
            $status->status          =1; 
            $status->date            =date('Y-m-d');
            $status->save(false);
            echo "success";die;
     	 }	
     	 else
     	 {
     	 	if($find->status==0)
     	 	{	
     	 	  $find->status=1;
     	 	  $find->save(false);
            }
            else
            {
              $find->status=0;
     	 	  $find->save(false);	
            }  
     	 	echo "success";die;
     	 }
     }

     /*function to update the global prices by compnay for particular service*/
     public function actionUpdateGlobalPriceByCompany()
     {
     	   //echo "<pre>";print_r($_REQUEST);die;
           $priceadminId=$_REQUEST['priceadminId'];
           $priceRec    =PriceAdmin::model()->findByPk(array('id'=>$priceadminId));
           //echo "<pre>";print_r($priceRec['bedroom']);die;

           if(!empty($_REQUEST))
           {
           	    $Rec    =PriceAdmin::model()->findByPk(array('id'=>$priceadminId));
           	    //echo "<pre>";print_r($Rec);die;
                foreach($_REQUEST['PriceAdmin'] as $k=>$val)
                {
                   $Rec->$k=$val;
                   $Rec->save(false);
                } 
                /*foreach($Rec->service->additionalServicePrices as $adnlValues)
                {    
                	  //echo "<pre>";print_r($adnlValues);
                	 foreach($_REQUEST['AdditionalServicePrice'] as $key=>$value)
                     {
                     	 if($adnlValues->additional_service_id==$key)
                     	 {	
                           $adnlValues->price=$value;
                           $adnlValues->save(fasle);
                         }	 
                     }	

                } *///die;	

                echo "success";die;
           }
     }

     /*code to update the additional service price like firdge ,etc*/
     public function actionSaveGlobalAddiSer()
     {
            $loggedId    =Yii::app()->session['loggedId'];
             
            $extraServices=AdditionalServicePrice::model()->findAll(array('condition'=>'service_id=:service_id','params'=>array(
                                     ':service_id'=>$loggedId,
            ))); 
            foreach($extraServices as $extra)
            {
                      foreach($_REQUEST['AdditionalServicePrice'] as $key=>$value)
                      {
                          if($extra->additional_service_id==$key)
                         {  
                           $extra->price=$value;
                           $extra->save(fasle);
                         }
                      }
            }
            echo "success";die;  
            //echo "<pre>";print_r($_REQUEST);die;
     }

     // code to set the price for services from service provider dashboard
     public function actionAjaxServiceTypeFieldName()
    {
         
               $serviceTypeId=$_REQUEST['serviceTypeId'];
               $companyId=$_REQUEST['companyId'];

               //$rec=PriceAdmin::model()->findAll(array("condition"=>"service_type_id=".$serviceTypeId."&& service_id=".$companyId));
               
               $rec=PriceAdmin::model()->findAll(array("condition"=>"service_type_id=:serviceTypeId AND service_id=:serviceId",
                                 "params"=>array(
                                             'serviceTypeId'=>$serviceTypeId,
                                             ':serviceId'=>$companyId,

                                  )

                           ));
                 
                if(!empty($rec))
                {
                    $arr = array();
                    $arr['type']=$serviceTypeId;
                    $arr['id'] = $rec[0]['id'];
                    $arr['bedroom'] = $rec[0]['bedroom'];
                    $arr['bathroom'] = $rec[0]['bathroom'];
                    $arr['property']=$rec[0]['property'];
                    $arr['desk']=$rec[0]['desk'];
                    $arr['cleaning_material_price']=$rec[0]['cleaning_material_price'];

                    $arr['living_room']               =$rec[0]['living_room'];
                    $arr['kitchen_staircases']        =$rec[0]['kitchen_staircases'];
                    $arr['carpets_interior_windows']  =$rec[0]['carpets_interior_windows'];
                    $arr['cupboards']                 =$rec[0]['cupboards'];
                    $arr['kitchen']                   =$rec[0]['kitchen'];
                    $arr['staircases']                =$rec[0]['staircases'];
                    $arr['elevator']                  =$rec[0]['elevator'];  

                    echo json_encode($arr);
                    exit();
                } 
                else
                {
                    $arr = array();
                    $arr['type']=0;
                    $arr['id'] = '';
                    $arr['bedroom'] = '';
                    $arr['bathroom'] = '';
                    $arr['property']='';
                    $arr['desk']='';
                    $arr['cleaning_material_price']='';

                    $arr['living_room']               ='';
                    $arr['kitchen_staircases']        ='';
                    $arr['carpets_interior_windows']  ='';
                    $arr['cupboards']                 ='';
                    $arr['kitchen']                   ='';
                    $arr['staircases']                ='';
                    $arr['elevator']                  ='';

                    echo json_encode($arr);
                    exit();
                } 
       
      }

      // code to add the company price from service provider
      public function actionAddCompanyPrice()
      {
           //echo "<pre>";print_r($_REQUEST);die;
           $priceAdmin=new PriceAdmin;
           $loggedId=Yii::app()->session['loggedId'];
           
           $recPriceAdmin=PriceAdmin::model()->findAll(array('condition'=>'service_id=:service_id AND service_type_id=:service_type_id','params'=>array(
                               ':service_id'    =>$loggedId,
                               'service_type_id'=>$_REQUEST['PriceAdmin']['service_type_id'], 
            )));  
            //echo "<pre>";print_r($recPriceAdmin);die;
           if(!empty($_REQUEST))
           {   
               if(empty($recPriceAdmin))
               { 
                     foreach($_REQUEST['PriceAdmin'] as $k=>$price)
                     {   
                         $priceAdmin->service_id=$loggedId; 
                         $priceAdmin->$k        =$price;
                         $priceAdmin->date      =date('Y-m-d');
                         $priceAdmin->save(false); 
                     }  //die;
                     echo "success";die;
                }
                else
                {
                    foreach($_REQUEST['PriceAdmin'] as $k=>$price)
                     {   
                          
                          foreach($recPriceAdmin as $up)
                          {  
                            $up->$k        =$price;
                            $up->save(false);
                          }
                          
                     }  //die;
                     echo "success1";die;
                }     
           } 
      }
      
     // code to update the price for end of tenancy cleaning
      public function actionAddCompanyPriceEndTenancy()
      {
          //echo "<pre>";print_r($_REQUEST);die;
          $model=new PriceAdmin;
      	  $loggedId                    =$_REQUEST['loggedId'];
      	  $service_type_id             =$_REQUEST['service_type_id'];

      	  $result                      =PriceAdmin::model()->find(array('condition'=>'service_id=:service_id AND service_type_id=:service_type_id','params'=>array(
                             
                             ':service_id'       =>$loggedId,
                             ':service_type_id'  =>$service_type_id,
      	  	)));
          
          if(!empty($result))
          {
              $result->bedroom                  =$_REQUEST['PriceAdmin']['bedroom'];
              $result->bathroom                 =$_REQUEST['PriceAdmin']['bathroom'];
              $result->kitchen_staircases       =$_REQUEST['PriceAdmin']['kitchen_staircases'];
              $result->carpets_interior_windows =$_REQUEST['PriceAdmin']['carpets_interior_windows'];
              $result->cleaning_material_price  =$_REQUEST['PriceAdmin']['cleaning_material_price'];
              
              $result->bedroom_hr                  =$_REQUEST['PriceAdmin']['bedroom_hr'];
              $result->bathroom_hr                 =$_REQUEST['PriceAdmin']['bathroom_hr'];
              $result->kitchen_staircases_hr       =$_REQUEST['PriceAdmin']['kitchen_staircases_hr'];
              $result->carpets_interior_windows_hr =$_REQUEST['PriceAdmin']['carpets_interior_windows_hr'];
              $result->cleaning_material_price_hr  =$_REQUEST['PriceAdmin']['cleaning_material_price_hr'];
              
              if($result->save())
              {
                 echo "success";die;
              }
          }
          else
          {
              $model->service_id               =$loggedId;
              $model->service_type_id          =$service_type_id;
              $model->bedroom                  =$_REQUEST['PriceAdmin']['bedroom'];
              $model->bathroom                 =$_REQUEST['PriceAdmin']['bathroom'];
              $model->kitchen_staircases       =$_REQUEST['PriceAdmin']['kitchen_staircases'];
              $model->carpets_interior_windows =$_REQUEST['PriceAdmin']['carpets_interior_windows'];
              $model->cleaning_material_price  =$_REQUEST['PriceAdmin']['cleaning_material_price'];
              
              $model->bedroom_hr                  =$_REQUEST['PriceAdmin']['bedroom_hr'];
              $model->bathroom_hr                 =$_REQUEST['PriceAdmin']['bathroom_hr'];
              $model->kitchen_staircases_hr       =$_REQUEST['PriceAdmin']['kitchen_staircases_hr'];
              $model->carpets_interior_windows_hr =$_REQUEST['PriceAdmin']['carpets_interior_windows_hr'];
              $model->cleaning_material_price_hr  =$_REQUEST['PriceAdmin']['cleaning_material_price_hr'];
              
              if($model->save())
              {
                 echo "success";die;
              }
          }  
      	  	
      	  
      }
      // code to update the price for doemstic cleaning
      public function actionAddCompanyPriceDomestic()
      {
          $model=new PriceAdmin;
      	  $loggedId                    =$_REQUEST['loggedId'];
      	  $service_type_id             =$_REQUEST['service_type_id'];

      	  $result                      =PriceAdmin::model()->find(array('condition'=>'service_id=:service_id AND service_type_id=:service_type_id','params'=>array(
                             
                             ':service_id'       =>$loggedId,
                             ':service_type_id'  =>$service_type_id,
      	  	)));
          
          if(!empty($result))
          {
                $result->bedroom                  =$_REQUEST['PriceAdmin']['bedroom'];
                $result->bathroom                 =$_REQUEST['PriceAdmin']['bathroom'];
                $result->kitchen_staircases       =$_REQUEST['PriceAdmin']['kitchen_staircases'];
                $result->carpets_interior_windows =$_REQUEST['PriceAdmin']['carpets_interior_windows'];
                $result->cleaning_material_price  =$_REQUEST['PriceAdmin']['cleaning_material_price'];
                
                $result->bedroom_hr                  =$_REQUEST['PriceAdmin']['bedroom_hr'];
                $result->bathroom_hr                 =$_REQUEST['PriceAdmin']['bathroom_hr'];
                $result->kitchen_staircases_hr       =$_REQUEST['PriceAdmin']['kitchen_staircases_hr'];
                $result->carpets_interior_windows_hr =$_REQUEST['PriceAdmin']['carpets_interior_windows_hr'];
                $result->cleaning_material_price_hr  =$_REQUEST['PriceAdmin']['cleaning_material_price_hr'];
                
                if($result->save())
                {
                   echo "success";die;
                }  
          }  
          else
          {   
                $model->service_id               =$loggedId;
                $model->service_type_id          =$service_type_id;
                $model->bedroom                  =$_REQUEST['PriceAdmin']['bedroom'];
                $model->bathroom                 =$_REQUEST['PriceAdmin']['bathroom'];
                $model->kitchen_staircases       =$_REQUEST['PriceAdmin']['kitchen_staircases'];
                $model->carpets_interior_windows =$_REQUEST['PriceAdmin']['carpets_interior_windows'];
                $model->cleaning_material_price  =$_REQUEST['PriceAdmin']['cleaning_material_price'];
                
                $model->bedroom_hr                  =$_REQUEST['PriceAdmin']['bedroom_hr'];
                $model->bathroom_hr                 =$_REQUEST['PriceAdmin']['bathroom_hr'];
                $model->kitchen_staircases_hr       =$_REQUEST['PriceAdmin']['kitchen_staircases_hr'];
                $model->carpets_interior_windows_hr =$_REQUEST['PriceAdmin']['carpets_interior_windows_hr'];
                $model->cleaning_material_price_hr  =$_REQUEST['PriceAdmin']['cleaning_material_price_hr'];
                
                if($model->save())
                {
                   echo "success";die;
                }

          }
      	  
      }
      // code to update the price for office
      public function actionAddCompanyPriceOffice()
      {
          //echo "<pre>";print_r($_REQUEST);die;
          $model=new PriceAdmin;
          $loggedId                    =$_REQUEST['loggedId'];
      	  $service_type_id             =$_REQUEST['service_type_id'];

      	  $result                      =PriceAdmin::model()->find(array('condition'=>'service_id=:service_id AND service_type_id=:service_type_id','params'=>array(
                             
                             ':service_id'       =>$loggedId,
                             ':service_type_id'  =>$service_type_id,
      	  	)));
          if(!empty($result))
          {
              $result->bedroom                  =$_REQUEST['PriceAdmin']['bedroom'];
              $result->bathroom                 =$_REQUEST['PriceAdmin']['bathroom'];
              $result->property                 =$_REQUEST['PriceAdmin']['property'];
              $result->desk                     =$_REQUEST['PriceAdmin']['desk'];
              $result->cupboards                =$_REQUEST['PriceAdmin']['cupboards'];
              $result->kitchen                  =$_REQUEST['PriceAdmin']['kitchen'];
              $result->staircases               =$_REQUEST['PriceAdmin']['staircases'];
              $result->elevator                 =$_REQUEST['PriceAdmin']['elevator'];
              $result->cleaning_material_price  =$_REQUEST['PriceAdmin']['cleaning_material_price'];
              
              $result->bedroom_hr                  =$_REQUEST['PriceAdmin']['bedroom_hr'];
              $result->bathroom_hr                 =$_REQUEST['PriceAdmin']['bathroom_hr'];
              $result->property_hr                 =$_REQUEST['PriceAdmin']['property_hr'];
              $result->desk_hr                     =$_REQUEST['PriceAdmin']['desk_hr'];
              $result->cupboards_hr                =$_REQUEST['PriceAdmin']['cupboards_hr'];
              $result->kitchen_hr                  =$_REQUEST['PriceAdmin']['kitchen_hr'];
              $result->staircases_hr               =$_REQUEST['PriceAdmin']['staircases_hr'];
              $result->elevator_hr                 =$_REQUEST['PriceAdmin']['elevator_hr'];
              $result->cleaning_material_price_hr  =$_REQUEST['PriceAdmin']['cleaning_material_price_hr'];
              
              if($result->save())
              {
                 echo "success";die;
              }   
          } 
          else
          {
              $model->service_id               =$loggedId;
              $model->service_type_id          =$service_type_id;
              $model->bedroom                  =$_REQUEST['PriceAdmin']['bedroom'];
              $model->bathroom                 =$_REQUEST['PriceAdmin']['bathroom'];
              $model->property                 =$_REQUEST['PriceAdmin']['property'];
              $model->desk                     =$_REQUEST['PriceAdmin']['desk'];
              $model->cupboards                =$_REQUEST['PriceAdmin']['cupboards'];
              $model->kitchen                  =$_REQUEST['PriceAdmin']['kitchen'];
              $model->staircases               =$_REQUEST['PriceAdmin']['staircases'];
              $model->elevator                 =$_REQUEST['PriceAdmin']['elevator'];
              $model->cleaning_material_price  =$_REQUEST['PriceAdmin']['cleaning_material_price'];
              
              $model->bedroom_hr                  =$_REQUEST['PriceAdmin']['bedroom_hr'];
              $model->bathroom_hr                 =$_REQUEST['PriceAdmin']['bathroom_hr'];
              $model->property_hr                 =$_REQUEST['PriceAdmin']['property_hr'];
              $model->desk_hr                     =$_REQUEST['PriceAdmin']['desk_hr'];
              $model->cupboards_hr                =$_REQUEST['PriceAdmin']['cupboards_hr'];
              $model->kitchen_hr                  =$_REQUEST['PriceAdmin']['kitchen_hr'];
              $model->staircases_hr               =$_REQUEST['PriceAdmin']['staircases_hr'];
              $model->elevator_hr                 =$_REQUEST['PriceAdmin']['elevator_hr'];
              $model->cleaning_material_price_hr  =$_REQUEST['PriceAdmin']['cleaning_material_price_hr'];
              
              if($model->save())
              {
                 echo "success";die;
              }
          }
      	  
      }
      // code to add the price for additional services by company
      public function actionSaveAdnlPriceCompany()
      {
      	   //echo "<pre>";print_r($_REQUEST);die;
      	   
      	 $loggedId=Yii::app()->session['loggedId'];
      	 
	           $proPrice = ProviderAdditionalprices::model()->findAll(array('condition'=>'service_id=:service_id AND service_type_id=:service_type_id ','params'=>array(
	                            ':service_id'               =>$loggedId,
	                            ':service_type_id'          =>$_REQUEST['type'],
	                            //':servicetype_additional_id'=>$k 

	           	)));
	       
           if(empty($proPrice))
           {
                foreach($_REQUEST['ServicetypeAdditionalservices'] as $k=>$value)
                {
	           	   $proadnlPrice=new ProviderAdditionalprices;
	           	   $proadnlPrice->date                             =date('Y-m-d');
	               $proadnlPrice->service_id                       =$loggedId;
	               $proadnlPrice->service_type_id                  =$_REQUEST['type'];
	               $proadnlPrice->servicetype_additional_id        =$k;
	               $proadnlPrice->provider_adnlprice               =$value;
	               $proadnlPrice->provideradditional_service_name  =$proadnlPrice->servicetypeAdditional['additional_service_name'];

	               $proadnlPrice->save(false);
                }
                echo "success1";die;	
           }
           else
           {       
               //echo "<pre>";print_r($_REQUEST['ServicetypeAdditionalservices']);die;          
           	   foreach($proPrice as $price)
           	   {
           	   		$serviceTypeId = $price['servicetype_additional_id'];           	   		
           	   		$newVal = $_REQUEST['ServicetypeAdditionalservices'][$serviceTypeId];
           	   		$price->provider_adnlprice = $newVal;
           	   		
           	   		$price->save(false); 
           	   } 
           	   echo "success";die;

           } 
           

      }

      // add the messages from company dashboard for particulr booking
      public function actionActiveJobsAddMsgCompany()
      {
      	// echo "<pre>";print_r($_REQUEST);die;
       	   $model       = new ConversationMsg;
            $msg        =new MsgDetails; 
              
         // echo "<pre>";print_r($_REQUEST);die;
          $reciverId       =$_REQUEST['reciverId'];
          $senderId        =$_REQUEST['senderId'];
          $bookingId       =$_REQUEST['bookingId'];
          $text             =$_REQUEST['MsgDetails']['msg'];
          $conversationMsg =$_REQUEST['ConversationMsg']['subject'];
          if(!empty($_REQUEST))
          {
	          	  $model->sender_type         ='company';
	          	  $model->reciver_type        ='customer';
	              $model->subject             =$conversationMsg;
	              $model->booking_id          =$bookingId;  
	              $model->reciver_id          =$reciverId;
	              $model->sender_id           =$senderId; 
		            //$date                       =date('Y-m-d'); 
	              //$model->date                =$date;
	              $model->save(false);
	              $conversationId = Yii::app()->db->getLastInsertID();

	             $msg->conversation_id    =$conversationId;
		         $msg->user_type          ='company';
			     $msg->msg                =$text;
			     $msg->user_id            =$senderId;
			     $msg->tomsg              =$reciverId;
			         //$date                    =date('Y-m-d'); 
		           //$msg->date               =$date;
		         $msg->booking_id         =$bookingId;
		         $msg->save(false);
                 $msgDetailLastId         = Yii::app()->db->getLastInsertID();
	             //echo "success";die;

	             // show the latest create messages
	             $inbox=MsgDetails::model()->findAll(array(

                      'condition' => 'inbox_dlt_status=:status AND booking_id=:booking_id', 
                      'group'   =>'conversation_id',
                                                  
                      'params' => array(':status'=>0,':booking_id'=>$bookingId),
                    ));
               
              foreach($inbox as $conId)
              {
                  $inboxDtal[]=MsgDetails::model()->findAll(array(
                      'condition' => 'conversation_id=:conversation_id AND inbox_dlt_status=:status', 
                      //'group'   =>'conversation_id',                   
                      'params' => array(':conversation_id'=>$conId->conversation_id,':status'=>0),
                    )); 

                  
                    $companyN=CustomerUser::model()->findAll(array('condition'=>'id=:id','params'=>array(
                               ':id'=>$conId->user_id,

                    )));  
                                    
              }       
               
             $this->renderPartial('renderdashboardMsgList',array('inbox'=>$inbox,'inboxDtal'=>$inboxDtal,'companyN'=>$companyN,'bookingId'=>$bookingId));
              

          }	
         
      }
      public function actionActiveJobsMsgList()
      {
        //echo "<pre>";print_r($_REQUEST);die;
        $bookingId  =$_REQUEST['bookingId'];
        $loggedId   =$_REQUEST['loggedId'];
             $inbox=MsgDetails::model()->findAll(array(

                     // 'condition' => 'tomsg=:tomsg AND inbox_dlt_status=:status AND booking_id=:booking_id', 
                      'condition' => 'inbox_dlt_status=:status AND booking_id=:booking_id', 
                     
                      'group'   =>'conversation_id',
                                                  
                      'params' => array(':status'=>0,':booking_id'=>$bookingId),
                    ));




              foreach($inbox as $conId)
              {
                  $inboxDtal[]=MsgDetails::model()->findAll(array(
                      'condition' => 'conversation_id=:conversation_id AND inbox_dlt_status=:status', 
                      //'group'   =>'conversation_id',                   
                      'params' => array(':conversation_id'=>$conId->conversation_id,':status'=>0),
                    )); 

                  
                    $companyN=CustomerUser::model()->findAll(array('condition'=>'id=:id','params'=>array(
                               ':id'=>$conId->user_id,

                    )));  
                                    
              }       
             if(!empty($inbox))
             {
             	 $this->renderPartial('renderdashboardMsgList',array('inbox'=>$inbox,'inboxDtal'=>$inboxDtal,'companyN'=>$companyN,'bookingId'=>$bookingId));
             
             }
             else
             {
                echo " ";die;
             } 
              

      }
      // code to get the details for messages list for customer dashboard
      public function actionActiveJobsCustomerMsgList()
      {

           //echo "<pre>";print_r($_REQUEST);die;
              $bookingId  =$_REQUEST['bookingId'];
             $loggedId   =$_REQUEST['loggedId'];
             $inbox=MsgDetails::model()->findAll(array(

                      //'condition' => 'tomsg=:tomsg AND inbox_dlt_status=:status AND booking_id=:booking_id', 
                     'condition' => 'inbox_dlt_status=:status AND booking_id=:booking_id AND tomsg <>:tomsg', 

                      'group'   =>'conversation_id',
                                                  
                      'params' => array(':status'=>0,':booking_id'=>$bookingId,'tomsg'=>0),
                    ));

              foreach($inbox as $conId)
              {
                  $inboxDtal[]=MsgDetails::model()->findAll(array(
                      'condition' => 'conversation_id=:conversation_id AND inbox_dlt_status=:status', 
                      //'group'   =>'conversation_id',                   
                      'params' => array(':conversation_id'=>$conId->conversation_id,':status'=>0),
                    )); 

                  
                    $companyN=CustomerUser::model()->findAll(array('condition'=>'id=:id','params'=>array(
                               ':id'=>$conId->user_id,

                    )));  
                                    
              }       
             if(!empty($inbox))
             { 
                $this->renderPartial('renderCustomerDashMsgList',array('inbox'=>$inbox,'inboxDtal'=>$inboxDtal,'companyN'=>$companyN,'bookingId'=>$bookingId));
             }
             else
             {
                echo " ";die;
             } 
      }

      // function to add create the new message from customer to company starts here
      public function actionActiveJobsAddMsgCustomer()
      {
         $model       = new ConversationMsg;
            $msg        =new MsgDetails; 
              
         // echo "<pre>";print_r($_REQUEST);die;
          $reciverId       =$_REQUEST['reciverId'];
          $senderId        =$_REQUEST['senderId'];
          $bookingId       =$_REQUEST['bookingId'];
          $text             =$_REQUEST['MsgDetails']['msg'];
          $conversationMsg =$_REQUEST['ConversationMsg']['subject'];
          if(!empty($_REQUEST))
          {
              $model->sender_type         ='customer';
              $model->reciver_type        ='company';
              $model->subject             =$conversationMsg;
              $model->booking_id          =$bookingId;  
              $model->reciver_id          =$reciverId;
              $model->sender_id           =$senderId; 
             // $date                       =date('Y-m-d'); 
              //$model->date                =$date;
              $model->save(false);
              $conversationId = Yii::app()->db->getLastInsertID();

             $msg->conversation_id    =$conversationId;
             $msg->user_type          ='customer';
             $msg->msg                =$text;
             $msg->user_id            =$senderId;
             $msg->tomsg              =$reciverId;
            // $date                    =date('Y-m-d'); 
             //$msg->date               =$date;
             $msg->booking_id         =$bookingId;
             $msg->save(false);

             //echo "success";die;
             

             // show the latest create messages
	             $inbox=MsgDetails::model()->findAll(array(

                      'condition' => ' inbox_dlt_status=:status AND booking_id=:booking_id', 
                      'group'   =>'conversation_id',
                                                  
                      'params' => array(':status'=>0,':booking_id'=>$bookingId),
                    ));

              foreach($inbox as $conId)
              {
                  $inboxDtal[]=MsgDetails::model()->findAll(array(
                      'condition' => 'conversation_id=:conversation_id AND inbox_dlt_status=:status', 
                      //'group'   =>'conversation_id',                   
                      'params' => array(':conversation_id'=>$conId->conversation_id,':status'=>0),
                    )); 

                  
                    $companyN=CustomerUser::model()->findAll(array('condition'=>'id=:id','params'=>array(
                               ':id'=>$conId->user_id,

                    )));  
                                    
              }       
               
             $this->renderPartial('renderCustomerDashMsgList',array('inbox'=>$inbox,'inboxDtal'=>$inboxDtal,'companyN'=>$companyN,'bookingId'=>$bookingId));
              

             

          } 
      }

      // function to create the message to admin from customer
      public function actionTicketAddCustomer()
      {
          //echo "<pre>";print_r($_REQUEST);die;
          $model       = new ConversationMsg;
          $msg        =new MsgDetails; 
              
         // echo "<pre>";print_r($_REQUEST);die;
          $reciverId       =$_REQUEST['reciverId'];
          $senderId        =$_REQUEST['senderId'];
          //$bookingId       =$_REQUEST['bookingId'];
          $text             =$_REQUEST['MsgDetails']['msg'];
          $conversationMsg =$_REQUEST['ConversationMsg']['subject'];
          if(!empty($_REQUEST))
          {
              $model->sender_type         ='customer';
              $model->reciver_type        ='admin';
              $model->subject             =$conversationMsg;
              $model->booking_id          =$bookingId;  
              $model->reciver_id          =$reciverId;
              $model->sender_id           =$senderId; 
             // $date                       =date('Y-m-d'); 
              //$model->date                =$date;
              $model->save(false);
              $conversationId = Yii::app()->db->getLastInsertID();

             $msg->conversation_id    =$conversationId;
             $msg->user_type          ='customer';
             $msg->msg                =$text;
             $msg->user_id            =$senderId;
             $msg->tomsg              =$reciverId;
             $msg->logged_id          =$senderId; 
            // $date                    =date('Y-m-d'); 
             //$msg->date               =$date;
             $msg->booking_id         =$bookingId;
             $msg->save(false);

             //echo "success";die;
             

             // show the latest create messages
               $inbox=MsgDetails::model()->findAll(array(

                      'condition' => 'logged_id=:logged_id', 
                      'group'   =>'conversation_id',
                                                  
                      'params' => array(':logged_id'=>$senderId),
                    ));

              foreach($inbox as $conId)
              {
                  $inboxDtal[]=MsgDetails::model()->findAll(array(
                      'condition' => 'conversation_id=:conversation_id AND inbox_dlt_status=:status', 
                      //'group'   =>'conversation_id',                   
                      'params' => array(':conversation_id'=>$conId->conversation_id,':status'=>0),
                    )); 

                  
                    $companyN=CustomerUser::model()->findAll(array('condition'=>'id=:id','params'=>array(
                               ':id'=>$conId->user_id,

                    ))); 
                                    
              }       
               
             $this->renderPartial('renderticketcustomerlist',array('inbox'=>$inbox,'inboxDtal'=>$inboxDtal,'companyN'=>$companyN,'bookingId'=>$bookingId));
             
          }     
      }

      //show the messages list for message click in ticket tab
      public function actionTicketCustomerMsgList()
      {
          //echo "<pre>";print_r($_REQUEST);die;
           //$bookingId  =$_REQUEST['bookingId'];
             $loggedId   =$_REQUEST['loggedId'];
             $inbox=MsgDetails::model()->findAll(array(

                      //'condition' => 'tomsg=:tomsg AND inbox_dlt_status=:status AND booking_id=:booking_id', 
                     'condition' => 'logged_id =:logged_id', 

                      'group'   =>'conversation_id',
                                                  
                      'params' => array(':logged_id'=>$loggedId),
                    ));

              foreach($inbox as $conId)
              {
                  $inboxDtal[]=MsgDetails::model()->findAll(array(
                      'condition' => 'conversation_id=:conversation_id AND inbox_dlt_status=:status', 
                      //'group'   =>'conversation_id',                   
                      'params' => array(':conversation_id'=>$conId->conversation_id,':status'=>0),
                    )); 

                  
                    $companyN=CustomerUser::model()->findAll(array('condition'=>'id=:id','params'=>array(
                               ':id'=>$conId->user_id,

                    )));  
                                    
              }       
             if(!empty($inbox))
             { 
                $this->renderPartial('renderticketcustomerlist',array('inbox'=>$inbox,'inboxDtal'=>$inboxDtal,'companyN'=>$companyN,'bookingId'=>$bookingId));
             }
             else
             {
                echo " ";die;
             }   

      }

      // code to create the message to admin
      public function actionTicketAddProvider()
      {
            $model       = new ConversationMsg;
          $msg        =new MsgDetails; 
              
         // echo "<pre>";print_r($_REQUEST);die;
          $reciverId       =$_REQUEST['reciverId'];
          $senderId        =$_REQUEST['senderId'];
          //$bookingId       =$_REQUEST['bookingId'];
          $text             =$_REQUEST['MsgDetails']['msg'];
          $conversationMsg =$_REQUEST['ConversationMsg']['subject'];
          if(!empty($_REQUEST))
          {
              $model->sender_type         ='company';
              $model->reciver_type        ='admin';
              $model->subject             =$conversationMsg;
              $model->booking_id          =$bookingId;  
              $model->reciver_id          =$reciverId;
              $model->sender_id           =$senderId; 
             // $date                       =date('Y-m-d'); 
              //$model->date                =$date;
              $model->save(false);
              $conversationId = Yii::app()->db->getLastInsertID();

             $msg->conversation_id    =$conversationId;
             $msg->user_type          ='company';
             $msg->msg                =$text;
             $msg->user_id            =$senderId;
             $msg->tomsg              =$reciverId;
             $msg->logged_id          =$senderId; 
            // $date                    =date('Y-m-d'); 
             //$msg->date               =$date;
             $msg->booking_id         =$bookingId;
             $msg->save(false);

             //echo "success";die;
             

             // show the latest create messages
               $inbox=MsgDetails::model()->findAll(array(

                      'condition' => 'logged_id=:logged_id', 
                      'group'   =>'conversation_id',
                                                  
                      'params' => array(':logged_id'=>$senderId),
                    ));

              foreach($inbox as $conId)
              {
                  $inboxDtal[]=MsgDetails::model()->findAll(array(
                      'condition' => 'conversation_id=:conversation_id AND inbox_dlt_status=:status', 
                      //'group'   =>'conversation_id',                   
                      'params' => array(':conversation_id'=>$conId->conversation_id,':status'=>0),
                    )); 

                  
                    $companyN=CustomerUser::model()->findAll(array('condition'=>'id=:id','params'=>array(
                               ':id'=>$conId->user_id,

                    ))); 
                                    
              }       
               
             $this->renderPartial('renderticketproviderlist',array('inbox'=>$inbox,'inboxDtal'=>$inboxDtal,'companyN'=>$companyN,'bookingId'=>$bookingId));
             
          }
      }
      // function to get the messages details for ticket tab in provider
      public function actionTicketProviderMsgList()
      {
           $loggedId   =$_REQUEST['loggedId'];
             $inbox=MsgDetails::model()->findAll(array(

                      //'condition' => 'tomsg=:tomsg AND inbox_dlt_status=:status AND booking_id=:booking_id', 
                     'condition' => 'logged_id =:logged_id', 

                      'group'   =>'conversation_id',
                                                  
                      'params' => array(':logged_id'=>$loggedId),
                    ));

              foreach($inbox as $conId)
              {
                  $inboxDtal[]=MsgDetails::model()->findAll(array(
                      'condition' => 'conversation_id=:conversation_id AND inbox_dlt_status=:status', 
                      //'group'   =>'conversation_id',                   
                      'params' => array(':conversation_id'=>$conId->conversation_id,':status'=>0),
                    )); 

                  
                    $companyN=CustomerUser::model()->findAll(array('condition'=>'id=:id','params'=>array(
                               ':id'=>$conId->user_id,

                    )));  
                                    
              }       
             if(!empty($inbox))
             { 
                $this->renderPartial('renderticketproviderlist',array('inbox'=>$inbox,'inboxDtal'=>$inboxDtal,'companyN'=>$companyN,'bookingId'=>$bookingId));
             }
             else
             {
                echo " ";die;
             }   
      }

      //reply section from provider to admin in ticket tab
      public function actionReplyticketfromProvider()
      {
            $model       = new ConversationMsg;
            $msg           =new MsgDetails; 
          
          //$senderId       =$_REQUEST['loggedId'];
          //$reciverId      =$_REQUEST['receiverId'];
          $subject        =$_REQUEST['subject'];
          $text           =$_REQUEST['text'];
          $conversationID =$_REQUEST['conversionId'];
          $loggedId       =Yii::app()->session['loggedId'];
          //$bookingId     =$_REQUEST['replysectionBookingId'];
       //echo "<pre>";print_r($_REQUEST);die;
          if(!empty($_REQUEST))
          {
                          
             $name=ServiceUser::model()->findByPk(array('id'=>$loggedId));
             $custname=$name->company_name;



             $msg->conversation_id   =$conversationID;
             $msg->user_type         ='company';
             $msg->msg               =$text;
             $msg->user_id           =$loggedId;
             $msg->tomsg             =0;
             $msg->logged_id         =$loggedId;
             //$date                   =date('Y-m-d'); 
             //$msg->date              =$date;
             $msg->booking_id        =0;
             $msg->save(false);
             $msgConverLastId        = Yii::app()->db->getLastInsertID();
             $re=MsgDetails::model()->findByPk(array('id'=>$msgConverLastId));
             
            
             echo "<div class='name'>";
             echo $custname;
             echo "</div>";
             
             echo "<div class='leftMsg appendmsg".$re['id']."'>"; 
              echo "<div class='time'>";
             //echo $re['date']; 
             echo date('jS \of F Y  H:i:s',strtotime($re['date']));
             echo "</div>";
             echo $re['msg'];
            
             echo "</div> ";
              
             

             //echo "success";die;

          } 
      }

      // code to add the distance coverge for company
      public function actionDistanceCoverage()
      {
         //echo "<pre>";print_r($_REQUEST);die;
          $dist    = new DistanceCoverage;
          if(!empty($_REQUEST))
          {
                $distance             =$_REQUEST['DistanceCoverage']['distance'];
                $cost                 =$_REQUEST['DistanceCoverage']['price_per_mile'];
                $dist->service_id     =$_REQUEST['loggedId'];
                $dist->distance       =$distance;
                $dist->price_per_mile =$cost;
                $dist->date           =date('Y-m-d');
                if($dist->save())
                {
                  echo "success" ;die;
                } 
 
          } 
      } 

      //cdoe to relist the company job
      public function actionRelistJobCompany()
      {
           //echo "<pre>";print_r($_REQUEST);die;
            $conver           =new ConversationMsg;
            $conversation     =new MsgDetails;
            $loggedId       =Yii::app()->session['loggedId'];
            if(!empty($_REQUEST))
            {  
                    $senderId          =$_REQUEST['loggedId'];
                    $reciverId         =$_REQUEST['customer_id'];
                    $booID             =$_REQUEST['booking_id'];

                    $conver->sender_id     =$senderId;
                    $conver->sender_type   ='company';
                    $conver->reciver_id    =$reciverId;
                    $conver->booking_id    =$booID;
                    $conver->reciver_type  ='customer';
                    $conver->sender_status =1;
                    $conver->subject       ='Please Review';
                    $conver->save(false);

                    $insert_idConver = Yii::app()->db->getLastInsertID();
                    
                    $conversation->conversation_id =$insert_idConver;
                    $conversation->user_type       = 'company';
                    $conversation->user_id         =$loggedId;
                    $conversation->booking_id      =$booID;
                    $conversation->tomsg           =$reciverId;
                    $conversation->msg             =$_REQUEST['MsgDetails']['msg'];
                    $conversation->save(false);


                    // chnage the job status in company request table

                    $rec=ServiceReview::model()->find(array('condition'=>'booking_id=:booking_id','params'=>array(
                                          ':booking_id'=>$booID,

                      )));
                    if(!empty($rec))
                    {
                       $rec->status=0;
                       $rec->save(false);
                    }  

                    echo "success";die;
            }
      }

}
