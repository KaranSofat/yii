<?php

class PaymentController extends Controller
{
    
   
	public function actionIndex()
	{
		$model= new PaymentCustomerUser;
        $booking=new CustomerBooking;
        $address=new CustomerAddress;
        $company =new CompanyRequest;

		$ses           = Yii::app()->session['CleaningDetail'];
		$servicetype   =Yii::app()->session['ServiceTypeId']; 
		$zip           =$ses['CleaningTime']['PostCode'];
        
       // echo "<pre>";print_r(base64_decode($_REQUEST['value']));die;
        //echo "<pre>";print_r($ses);die;
		//$myProducts = Yii::app()->session['detail'];
		
        $detail        =Yii::app()->session['detail'];
        foreach($detail['Additional'] as $k=>$d)
        {
        	$detailadnl[$k]=ServicetypeAdditionalservices::model()->findAll(array('condition'=>'id=:id','params'=>array(
                      ':id'=>$k,
        		)));

                	
        }
        foreach($detailadnl as $key=>$nam)
        {
        	// echo "<pre>";print_r($nam);
        	 foreach($nam as $value)
        	 {
        	 	 $detailadnl[$key]=$value['additional_service_name'];
        	 }	
        	 
        } 

        //echo "<pre>";print_r($detail['Additional']);
        $finalDetailadnl=array_combine($detailadnl,$detail['Additional']);
        //echo "<pre>";print_r($fin);die;
	    //$price         =$_REQUEST['price'];
        // code to get the method from admin %age or fiexd cost  of total amount
        $paymentAdmin  =PaymentToAdmin::model()->find(array('condition'=>'status=1'));
        if(!empty($paymentAdmin))
        {
        	 //echo "adda";die;
        	if($paymentAdmin['type_of_cost']=='Fixed')
        	{
                $price=$paymentAdmin['cost_percentage'];
        	}        	
        	else
        	{
        		if(isset($_REQUEST['value']))
        		{ 

	                $pri  =$paymentAdmin['cost_percentage']*base64_decode($_REQUEST['value']);
	                $pce  =$pri/100;
	                $price=$pce;
	             }
	             else
	             {

	             	 $price=base64_decode($_REQUEST['value1']);
	             }    

        	}	
        } 
        else
        {

           $price         =base64_decode($_REQUEST['value']);
        }  

	    

         //echo $price;die;

	    $service_id    =$_REQUEST['service_id'];
	     
	     $rec          =UkPostcodes::model()->findByattributes(array('postcode'=>$zip));
         
         // detail for logged user
         $loggedId       =Yii::app()->session['loggedId'];
         $customerDetail=PaymentCustomerUser::model()->findByPk(array('id'=>$loggedId)); 
         
         //echo "<pre>";print_r($customerDetail);die;  

        //echo "<pre>";print_r($servicetype);die;
		if(isset($_POST['PaymentCustomerUser']))
		{   
			$logged= Yii::app()->session['loggedId'];
			 //echo "<pre>";print_r($ses);die;
              $model->attributes=$_POST['PaymentCustomerUser'];
              if($model->validate())
              {

                   // echo "<pre>";print_r($_REQUEST);die;
                       $exp=$_REQUEST['PaymentCustomerUser']['expire'];
                       $res=explode ("/", $exp);
                       
                       $month=$res[0];
                       $year=$res[1]; 

                     $cardDetail=  implode(explode(" ",trim($_REQUEST['PaymentCustomerUser']['cardDetail'])));
                     

                      /*if($_REQUEST['value']==0)
                      {
                      	 $price=0;
                      }	*/
                      $paymentInfo = array('Member'=> 
									array( 
										'first_name'=>$_REQUEST['PaymentCustomerUser']['cname'], 
										'last_name'=>$_REQUEST['PaymentCustomerUser']['clname'], 
										'billing_address'=>$_REQUEST['PaymentCustomerUser']['caddress'], 
										'billing_address2'=>$_REQUEST['PaymentCustomerUser']['caddress'], 
										'billing_country'=>$_REQUEST['PaymentCustomerUser']['country'], 
										'billing_city'=>$_REQUEST['PaymentCustomerUser']['city'], 
										 
										'billing_zip'=>$_REQUEST['PaymentCustomerUser']['zipcode'] 
									), 
									'CreditCard'=> 
									array( 
										'card_number'=>$cardDetail, 
			           					'expiration_month'=>trim($month), 
										'expiration_year'=>trim($year), 
										'cv_code'=>$_REQUEST['PaymentCustomerUser']['code'],
										'credit_type'=>$_REQUEST['PaymentCustomerUser']['cardType']  
									), 
									'Order'=> 
									array('theTotal'=>$price) 
								); 

		                     // echo "<pre>";print_r($paymentInfo);
		                      
		                      $result = Yii::app()->Paypal->DoDirectPayment($paymentInfo);
		                      //echo http_build_query($data, 'flags_');
		                    //echo "<pre>";print_r($result);die;
                            if($result['ACK']=='Failure')
                            {
                            	$links=CmsPages::model()->findAll();
                                Yii::app()->params['MyArray'] = $links; 
                                 Yii::app()->user->setFlash('ack', "Please check your card details");
                            	$this->render('index',array('model'=>$model,'town'=>$rec,'price'=>$price,'service_id'=>$service_id));
                            }	



						       if(!Yii::app()->Paypal->isCallSucceeded($result))
				               { 

									if(Yii::app()->Paypal->apiLive === true)
									{
										//Live mode basic error message
										$error = 'We were unable to process your request. Please try again later';
									}
									else
									{
										//Sandbox output the actual error message to dive in.
										$error = $result['L_LONGMESSAGE0'];
									}
									echo $error;
									
					         }
						  else
						 { 
							//Payment was completed successfully, do the rest of your stuff


							// code to register the customer and save  transaction id in differ table 
						         if(!empty($result['TRANSACTIONID']))
						         {
								         	 $model->cname      =$_REQUEST['PaymentCustomerUser']['cname'];
								         	 $model->clname     =$_REQUEST['PaymentCustomerUser']['clname'];
								         	 $model->caddress   =$_REQUEST['PaymentCustomerUser']['caddress'];
								         	 $model->zipcode    =$_REQUEST['PaymentCustomerUser']['zipcode'];
								         	 $model->phone      =$_REQUEST['PaymentCustomerUser']['phone'];
								         	 $model->email      =$_REQUEST['PaymentCustomerUser']['email'];
								         	 $model->city       =$_REQUEST['PaymentCustomerUser']['city'];
								         	 $model->country    =$_REQUEST['PaymentCustomerUser']['country'];
								         	 $model->cregistered=date('Y-m-d');
                                             

                                             $email=$_REQUEST['PaymentCustomerUser']['email'];		                                     
                                              
                                             $user = PaymentCustomerUser::model()->exists('email=:email',array('email'=>$email));
                                            // $user=PaymentCustomerUser::model()->findByAttributes(array('email'=>$email));
                                             //echo "<pre>";print_r($user);die;
                                             //if(count($user)<0)
                                             if(empty($user))
                                             {
                                             	 //echo "hlo";die;
                                                     $cleartext_password = rand(0,9999);
								                     $model->password = md5($cleartext_password);  
										         	 if($model->save())
										         	 {
				                                         
				                                        $signature = md5($model->email . $model->password);
										
													     $subject = 'Welcome to Wow Cleans';
													     $body = $this->renderPartial('registrationEmail', array(
														'model'=>$model,
														'password'=>$cleartext_password,
														'url'=>$this->createAbsoluteUrl('../registration/login', array('email' => $model->email, 'signature' => $signature)),
														//'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
													 ), true);

										
										              Yii::app()->mailer->send($model->email, $subject, $body); 

                                                      
                                                      // booking detail for register customer here

                                                          $custId = Yii::app()->db->getLastInsertID();
                                                         $transId   =$result['TRANSACTIONID'];
                                                         $cust=PaymentCustomerUser::model()->findByAttributes(array('id'=>$custId)); 
                                                  
                                                  
	                                                     $companyDetail=ServiceUser::model()->findByAttributes(array('id'=>$_REQUEST['service_id']));
	                                                     //echo "<pre>";print_r($companyDetail);die;
	                                                     // save address for customer in different table

		                                                $address->address =$_REQUEST['PaymentCustomerUser']['caddress'];
										         	    $address->zipcode  =$_REQUEST['PaymentCustomerUser']['zipcode'];
										         	    $address->date     =date('Y-m-d'); 
		                                                $address->customer_id=$custId;
		                                                
		                                                 $address->save(); 
		                                                 $address_id = Yii::app()->db->getLastInsertID();
		                                                
                                                 
		                                                 $re=CustomerAddress::model()->findByAttributes(array('customer_id'=>$custId));
		                                                 //echo "<pre>";print_r($re);die;
		                                                 $addressId =$re->id; 


		                                                  $booking->customer_id    =$custId;
		                                                  $booking->service_id     =$_REQUEST['service_id'];
		                                                  $booking->service_type_id=$servicetype;
		                                                  //$booking->price          =$_REQUEST['price'];
		                                                  $booking->price          =$price;
		                                                  $booking->trans_id       =$transId;
		                                                  $booking->date           =date('Y-m-d');
		                                                  if(!empty($address_id))
		                                                  {	
		                                                     $booking->customer_address_id=$address_id;
		                                                  }
		                                                  else
		                                                  {
		                                                  	 $booking->customer_address_id=$addressId;

		                                                  }	
		                                                  $detail = Yii::app()->session['detail'];
		                                                 // echo "<pre>";print_r($detail);die;
		                                                  foreach($detail['Cleaning'] as $type => $number)
		                                                  {
		                                                  	 $cleaningDetail .= $number."-".$type.",";
		                                                  }
                                                

		                                                $booking->cleaningDetail = substr($cleaningDetail, 0, -1);
		                                                 
		                                                 /*foreach($detail['Additional'] as $k=>$val)
		                                                  {
		                                                  	  if($val!=0)
		                                                  	  {
		                                                  	  	 $addnl .=$val."-".$k.",";
		                                                  	  }	
		                                                  }	*/
		                                                  foreach($finalDetailadnl as $k=>$val)
		                                                  {
		                                                  	  if($val!=0)
		                                                  	  {
		                                                  	  	 $addnl .=$val."-".$k.",";
		                                                  	  }	
		                                                  }
		                                                  $booking->additional=substr($addnl,0,-1);
		                                                  $booking->additional_details=$detail['AdditionalCustDetail']['AdditionalCustDetail']; 
		                                                  if($booking->save())
		                                                  {
		                                                    
                                                              //booking id for thaks page
                                                              $insert_id = Yii::app()->db->getLastInsertID(); 
                                                              
                                                    $cutId=Booking::model()->findByPk(array('id'=>$insert_id));  
                                                     $customerId=$cutId->customer_id;      
                                                               /*code to enter the company request details in company request table*/

                                                              $company->booking_id    =$insert_id;
                                                              $company->service_id     =$_REQUEST['service_id'];
                                                              $company->customer_id     =$customerId;
                                                              
                                                              $company->cleaningtime  =$ses['CleaningTime']['time'];
                                                              $company->postcode      =$ses['CleaningTime']['PostCode'];
                                                              $company->cleaningdate  =date("Y-m-d",strtotime($ses['CleaningTime']['CleaningDate']));
                                                              $company->date          =date('Y-m-d'); 
                                                              $company->no_of_hours   =$ses['CleaningTime']['noOfhour'];
                                                              $company->no_of_cleaners=$ses['CleaningTime']['noOfCleaners'];  
                                                              $company->save(false);   



                                                              // echo $insert_id;die; 
		                                                      // send mail to customer 
		                                                       
															     $subject = 'Welcome to Wow Cleans';
															     $body = $this->renderPartial('customerEmail', array(
																'model'=>$companyDetail,
																'cust'=>$_REQUEST,
																'detail'=>$detail,
																'adnl'  =>$finalDetailadnl,
																//'price'=>$_REQUEST['id'],
																'price'=>$price,
																'trans'=>$result['TRANSACTIONID'],
																//'password'=>$cleartext_password,
																//'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
																//'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
															), true); 
		                                                     
		                                                    Yii::app()->mailer->send($cust->email, $subject, $body);  
		                                                     

		                                                     // send mail to company

		                                                       $subject = 'Welcome to Wow Cleans';
															     $body = $this->renderPartial('companyEmail', array(
																'model'=>$companyDetail,
																'cust'=>$_REQUEST,
																'detail'=>$detail,
																'adnl'  =>$finalDetailadnl,
																//'price'=>$_REQUEST['id'],
																'price'=>$price,
																'trans'=>$result['TRANSACTIONID'],
																//'password'=>$cleartext_password,
																//'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
																//'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
															), true); 
		                                                     
		                                                    Yii::app()->mailer->send($companyDetail->email, $subject, $body);  
		                                                      
		                                                    //$this->refresh();
                                                              



		                                                  	//$this->redirect(array('../registration/index'));
                                                             
                                                             


		                                                  }	
                                                  

                                                      // booking detail for register customer ends here
                                                          $link=CmsPages::model()->findAll();
                                                          Yii::app()->params['MyArray'] = $link;
		                                                 // $this->redirect('thanks','param1'=>$companyDetail);
		                                                  $this->redirect(array('payment/thanks','param1'=>$insert_id));
		                                                  //exit();
				                                         //$this->refresh();
										         	 	//$this->redirect(array('registration/registration'));
										         	 }	
                                             }	
                                             else
                                             {
                                                // echo "fsf";die;
                                                  //$price     =$_REQUEST['price']; 
                                                  $email     =$_REQUEST['PaymentCustomerUser']['email'];
                                                  $transId   =$result['TRANSACTIONID'];

                                                  $rec=PaymentCustomerUser::model()->findByAttributes(array('email'=>$email));
                                                   //echo "<pre>";print_r($rec);die;
                                                  $custId=$rec->id;
                                                  
                                                  $companyDetail=ServiceUser::model()->findByAttributes(array('id'=>$_REQUEST['service_id']));
                                                 
                                                  // save address for customer in different table

                                                $address->address =$_REQUEST['PaymentCustomerUser']['caddress'];
								         	    $address->zipcode  =$_REQUEST['PaymentCustomerUser']['zipcode'];
								         	    $address->date     =date('Y-m-d'); 
                                                $address->customer_id=$custId;
                                                if(!$user = CustomerAddress::model()->exists('address=:address',array('address'=>$_REQUEST['PaymentCustomerUser']['caddress'])))
                                                { 
                                                 $address->save(); 
                                                 $address_id = Yii::app()->db->getLastInsertID();
                                                }
                                                //$address_id = Yii::app()->db->getLastInsertID();
                                                 
                                                 $re=CustomerAddress::model()->findByAttributes(array('customer_id'=>$custId));
                                                 //echo "<pre>";print_r($rec->id);die;
                                                 $addressId =$re->id; 


                                                  $booking->customer_id    =$custId;
                                                  $booking->service_id     =$_REQUEST['service_id'];
                                                  $booking->service_type_id=$servicetype;
                                                  //$booking->price          =$_REQUEST['price'];
                                                  $booking->price          =$price;
                                                  $booking->trans_id       =$transId;
                                                  $booking->date           =date('Y-m-d');
                                                  if(!empty($address_id))
                                                  {	
                                                     $booking->customer_address_id=$address_id;
                                                  }
                                                  else
                                                  {
                                                  	 $booking->customer_address_id=$addressId;

                                                  }	
                                                  $detail = Yii::app()->session['detail'];
                                                 // echo "<pre>";print_r($detail);die;
                                                  foreach($detail['Cleaning'] as $type => $number)
                                                  {
                                                  	 $cleaningDetail .= $number."-".$type.",";
                                                  }
                                                

                                                $booking->cleaningDetail = substr($cleaningDetail, 0, -1);
                                                //echo "<pre>";print_r($detail['Additional']);die;
                                                


                                                 /*foreach($detail['Additional'] as $k=>$val)
                                                  {
                                                  	  if($val!=0)
                                                  	  {
                                                  	  	 $addnl .=$val."-".$k.",";
                                                  	  }	
                                                  } */	
                                                  foreach($finalDetailadnl as $k=>$val)
                                                  {
                                                  	  if($val!=0)
                                                  	  {
                                                  	  	 $addnl .=$val."-".$k.",";
                                                  	  }	
                                                  }
                                                  $booking->additional=substr($addnl,0,-1);
                                                  $booking->additional_details=$detail['AdditionalCustDetail']['AdditionalCustDetail']; 
		                                                  
                                                  if($booking->save(false))
                                                  {
                                                    $insert_id = Yii::app()->db->getLastInsertID(); 
                                                    
                                                    $cutId=Booking::model()->findByPk(array('id'=>$insert_id));
                                                    //echo "<pre>";print_r($cutId);die;  
                                                     $customerId=$cutId->customer_id;  
                                                     /*code to add the company request details in company request table*/
                                                      $company->booking_id    =$insert_id;
                                                      $company->service_id     =$_REQUEST['service_id'];
                                                      $company->customer_id     =$customerId;
                                                      $company->cleaningtime  =$ses['CleaningTime']['time'];
                                                      $company->postcode      =$ses['CleaningTime']['PostCode'];
                                                      $company->cleaningdate  =date("Y-m-d",strtotime($ses['CleaningTime']['CleaningDate']));
                                                                                
                                                      $company->date          =date('Y-m-d');
                                                      $company->no_of_hours   =$ses['CleaningTime']['noOfhour'];
                                                      $company->no_of_cleaners=$ses['CleaningTime']['noOfCleaners'];  
                                                              
                                                      $company->save(false);

                                                      // send mail to customer 
                                                       
													     $subject = 'Welcome to Wow Cleans';
													     $body = $this->renderPartial('customerEmail', array(
														'model'=>$companyDetail,
														'cust'=>$_REQUEST,
														'detail'=>$detail,
														'adnl'  =>$finalDetailadnl,
														//'price'=>$_REQUEST['id'],
														'price'=>$price,
														'trans'=>$result['TRANSACTIONID'],
														//'password'=>$cleartext_password,
														//'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
														//'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
													), true); 
                                                     
                                                    Yii::app()->mailer->send($rec->email, $subject, $body);  
                                                     

                                                     // send mail to company

                                                       $subject = 'Welcome to Wow Cleans';
													     $body = $this->renderPartial('companyEmail', array(
														'model'=>$companyDetail,
														'cust'=>$_REQUEST,
														'detail'=>$detail,
														'adnl'  =>$finalDetailadnl,
														//'price'=>$_REQUEST['id'],
														'price'=>$price,
														'trans'=>$result['TRANSACTIONID'],
														//'password'=>$cleartext_password,
														//'url'=>$this->createAbsoluteUrl('payment/login', array('email' => $model->email, 'signature' => $signature)),
														//'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
													), true); 
                                                     
                                                    Yii::app()->mailer->send($companyDetail->email, $subject, $body);  
                                                      
                                                    //$this->refresh();
                                                    
                                                    if($logged!='')
                                                    {
                                                        //$this->redirect(array('../registration/customerdashboard'));
                                                         $this->redirect(array('payment/thanks','param1'=>$insert_id));
                                                    } 
                                                    else{ 

                                                    	      $this->redirect(array('payment/thanks','param1'=>$insert_id));
                                                  	          //$this->redirect(array('../registration/index'));
                                                         }
                                                  }	
                                                  
                                                  //echo $servicetype; die;
                                                  //echo "<pre>";print_r($rec);die;
                                                  


                                             }

		                                  
						         }
					         	
					     }

						Yii::app()->end();

              }	
              else
              {
                 $errors=$model->getErrors();
                // var_dump($errors);
              }
		} 
        

        $links=CmsPages::model()->findAll();
        Yii::app()->params['MyArray'] = $links;

		$this->render('index',array('model'=>$model,'town'=>$rec,'price'=>$price,'service_id'=>$service_id,'customerDetail'=>$customerDetail));
	}
    


    public function actionLogin()
	{

		//echo "<pre>";print_r($_REQUEST);die;
		$email=$_REQUEST['email'];

		$rec=PaymentCustomerUser::model()->findByAttributes(array('email'=>$email));
		//echo "<pre>";print_r($rec);die;
		if(count($rec)>0)
		{
			 $rec->status=1;
			 if($rec->save())
			 {	
                 
			    $this->refresh();
			  } 
		}	 
		$this->render('registration/registration');
	}



	// function for auto suggestion address
	public function actionAjaxAddress()
	{
		 $rec=PaymentCustomerUser::model()->findByAttributes(array('email'=>$_REQUEST['email']));

		 $detail=CustomerAddress::model()->findAll(array('condition'=>'customer_id=:cId AND zipcode=:zip ','params'=>array(

		                                           ':cId'=>$rec->id,
		                                           ':zip'=>$_REQUEST['zip']

		                                   	)

		 )); 
        
        foreach($detail as $d)
        {
            $val[]=$d->address;
        }	

        echo json_encode($val);
        exit();
	}


    /*thanks page for payment success*/
    public function actionThanks($param1)
    {
    	$res=CustomerBooking::model()->findByPk($param1);
    	
    	//echo "<pre>";print_r($res);die;
    	$links=CmsPages::model()->findAll();
        Yii::app()->params['MyArray'] = $links;
    	$this->render('thanks',array('detail'=>$res));
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
}