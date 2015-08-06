<?php

class UserController extends Controller
{


    /**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionIndex()
	{
		$model        =new CleaningTime;
		$list         =CleaningTime::model()->findAll();
    $cleanDetails =Yii::app()->session['CleaningDetail'];
    //echo "<pre>";print_r($clean);die;
		//$zip=ServiceUser::model()->findAll();
      $zip=UkPostcodes::model()->findAll();
      //echo "<pre>";print_r($zip);die;
        foreach($zip as $z);
        {
        }
          $post[]=$z->postcode;
        
        $uniquePost=array_unique($post);
       
     //code to get the welcome content
     $welcome=HomeWelcome::model()->find(array('condition'=>'status=1'));
     $why=WhyUsHome::model()->find(array('condition'=>'status=1'));
     $Stypes=ServiceTypes::model()->findAll(array('limit'=>3));
     
     $homeImage=HomeImages::model()->findAll(array('condition'=>'status=1'));
     //echo "<pre>";print_r($homeImage);die;
     //echo "<pre>";print_r($Stypes);die;  

     $ht=HtuseHome::model()->findAll(array(
                      'condition' => 'status=:c',
                      'limit' => 4,
                      'params' => array(':c' =>1),
                    ));
      //echo "<pre>";print_r($ht);die;               
     $links=CmsPages::model()->findAll();
     Yii::app()->params['MyArray'] = $links;
     $this->render('index',array('list'=>$list,'model'=>$model,'Post'=>$uniquePost,'wel'=>$welcome,'why'=>$why,'Stypes'=>$Stypes,'homeImage'=>$homeImage,'ht'=>$ht,'cleanDetails'=>$cleanDetails));
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
	 * Declares class-based actions.
	 */
	public function actionService()
	{
    	//echo "<pre>";print_r($_REQUEST);die; 
		$compare=$_REQUEST;
		//echo "<pre>";print_r($compare);die;
		$clean=Yii::app()->session['CleaningDetail'];
		//echo "<pre>";print_r($clean);die;
		Yii::app()->session['CleaningDetail'] = $compare;
        
        $Stype=ServiceTypes::model()->findAll(array('condition'=>'status=1'));
        //echo "<pre>";print_r($Stype);die;  
    $links=CmsPages::model()->findAll();
    Yii::app()->params['MyArray'] = $links;
		$this->render('service',array('servicetype'=>$Stype));
	}
    
    public function actionCleaning()
    {
    	 //echo "<pre>";print_r($_REQUEST);die;
       $ses = Yii::app()->session['CleaningDetail'];

    	  $serviceTypeId=$_REQUEST['typeId'];
        //echo $serviceTypeId;die;
        $cleaninServices=array($serviceTypeId,Yii::app()->session['requestfrmcleaning']);
        // echo "<pre>";print_r($cleaninServices);die;  


        Yii::app()->session['ServiceTypeId']=$serviceTypeId;
        
        $serviceName=ServiceTypes::model()->findByPk($serviceTypeId);
      
        $serName=strtoupper($serviceName->service_name); 

        $findValues=ServicePrice::model()->findAll(array("condition"=>"service_type_id=".$serviceTypeId));

        //$additionalService=AdditionalServices::model()->findAll(array('condition'=>'status=1'));

        /*code to get the additional services according to service types starts here*/
       
       $additionalService=ServicetypeAdditionalservices::model()->findAll(array(
                      'condition' => 'service_type_id=:id AND status=:status', 
                      //'group'   =>'conversation_id',                   
                      'params' => array(':id'=>$serviceTypeId,':status'=>1),
                    )); 
        //echo "<pre>";print_r($additionalService);die;
        /*code to get the additional services according to service types ends here*/



       //echo "<pre>";print_r($additionalService);die;
       
       $cleanDetails =Yii::app()->session['CleaningDetail'];
        	
        $links=CmsPages::model()->findAll();
        Yii::app()->params['MyArray'] = $links;
        
        $serviceDetails=ServiceTypes::model()->findAll(array("condition"=>"id=".$serviceTypeId));

    	$this->render('cleaning',array('serName'=>$serName,'serviceDetails'=>$serviceDetails,'values'=>$findValues,'adnlService'=>$additionalService,'cleaninServices'=>$cleaninServices, 'cleanDetails'=>$cleanDetails));
    }
    
    // fucntion to get the details in session
    public function actionSesReqstCleaning()
    {
    	 Yii::app()->session['CleaningReqst']=$_REQUEST;
    	 echo "success";
    }
    public function actionCompareQuotes()
    {
    	  $ses = Yii::app()->session['CleaningDetail'];
    	  
    	  $newAr = array();
    	  $userDetail = array();
    	  $companyServiceSum = array();
    	  $sumCompanyAdnlser = array();
    	  $sumadminAdnlser = array();
    	  $sumArrayRatingAvg = array();
    	  $sums = array();
    	  $total = 0;
    	  
    	  
           //$values=$_REQUEST;
    	 
    	  //Yii::app()->session['CleaningReqst'] = $values;
         $requestCleaningPage=Yii::app()->session['CleaningReqst'];
        // echo "<pre>";print_r($requestCleaningPage);die;
          
        $serTypeId=Yii::app()->session['ServiceTypeId'];
        // echo "<pre>";print_r($serTypeId);die;   
        // to keep the values filled on cleaning page if go back on previous page from comapre quotes page

        //$cleaninServices=Yii::app()->session['requestfrmcleaning'];
        // echo "<pre>";print_r($cleaninServices);die; 

        $zip=$ses['CleaningTime']['PostCode'];
        $cleaningDate=$ses['CleaningTime']['CleaningDate'];
        $time=$ses['CleaningTime']['time'];
        
          
        // code to calculate the postcodes within radius
        $detailCleaning=$_REQUEST['Cleaning'];
        


        if(key_exists('Property',$_REQUEST['Cleaning']))
        	$property = $_REQUEST['Cleaning']['Property'];
    	else
        	$property = '';
        $baths=$_REQUEST['Cleaning']['Bathrooms'];
        $beds=$_REQUEST['Cleaning']['Bedrooms']; 
        


         // get the customer lat and long from where we want to calculate other postcodes

        $recUk=UkPostcodes::model()->findByPk($zip);
        $r=3959;//earth radius in miles
        $d=5.6;
        //$d=5.6*60*1.1515; 
        $c=count($recUk);
        if($c>0)
        { 
          $lat1=$recUk->latitude;

          $lon1=$recUk->longitude;


          $nlat1=deg2rad($lat1);
          $nlon1=deg2rad($lon1);

          $latN = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(0))));

            

          $latS = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(180))));
          $lonE = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(90)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));
          $lonW = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(270)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));


         $query = "SELECT * from ccobs_service_user WHERE (lat <= $latN AND lat >= $latS AND longitude <= $lonE AND longitude >= $lonW) AND (lat != $lat1 AND longitude != $lon1) AND city != ' ' ORDER BY   lat, longitude ";

         
          

         $dataReader = Yii::app()->db->createCommand($query)->query();

         $res = $dataReader->readAll();
         
         //echo "<pre>";print_r($res);

         

          /*calculate price here*/
            
            if(!empty($res))
            {  


                        foreach($res as $userIds )
                       {
                          $comp[]=$userIds['company_name'];
                          $id=$userIds['id'];
                        
                          //$finalRes=array_combine($comp,$id);
                          
                          $userDetail[]=ServiceUser::model()->with('priceAdmins')->findAll(array('condition'=>' service_id=:serId AND service_type_id=:sertype','params'=>array(
                                                               
                                                       //':id'=>$userIds['id'],
                                                       ':serId'=>$userIds['id'],
                                                       ':sertype'=>$serTypeId,
                            ),
                             

                          ));
                          //

                          $additionalService[]=AdditionalServicePrice::model()->with('additionalService')->findAll(array('condition'=>'service_id=:serId','params'=>array(

                                            ':serId'=>$userIds['id'],
                          
                              )
                          
                            ));


                       }//die;
                         //echo "<pre>";print_r($additionalService); die;
                        /*loop for additional service starts here*/
                        foreach($additionalService as $adnlService)
                        {
                          
                              foreach($adnlService as $service)
                              {
                                 // echo "<pre>";print_r($service);
                                  $service_id=$service->service_id;
                                  $service_name=$service->additionalService['service_name'];  
                                  $price=$service->price;
                                  
                                    

                                  $adnlarr=array(array($service_id=>array($service_name=>$price)));
                                  foreach($adnlarr[0] as $id => $val)
                                  {
                                      
                                        
	                                 	foreach($val as $serv => $servVal)
	                                 	{
		                                    $newAr[$id][$serv]  = $servVal;
		                                     
		                                 	if(key_exists($serv, $_REQUEST['Additional']))
		                                		$newAr[$id][$serv]=$servVal*$_REQUEST['Additional'][$serv];
										}
                                    
                                  }
                                  
                                 
                              } 
                        }  
           
                        

                    foreach($res as $i=>$noOfUsers)
                    {
                      $noUsrId[]=$noOfUsers['id'];
                      //$compNam[]=$noOfUsers['company_name'];
                      $compNam[]=$noOfUsers['company_name']."+".$noOfUsers['id'];

                      $latitude[]=$noOfUsers['lat'];
                      $longitude[]=$noOfUsers['longitude'];

                      $nlatitude=deg2rad($noOfUsers['lat']);
                      $nlongitude=deg2rad($noOfUsers['longitude']);
                      
                      

                      $delta_lat=$nlatitude-$nlat1;

                      $delta_lon=$nlongitude-$nlon1;  

                      $temp = pow(sin($delta_lat / 2.0), 2) + cos($nlatitude) * cos($lat1) * pow(sin($delta_lon / 2.0), 2);
                      $EARTH_RADIUS = 3956;
                      $distance[] = $EARTH_RADIUS * 2 * atan2(sqrt($temp), sqrt(1 - $temp));

                      $compName=array_combine($distance,$compNam);
                      //$compName=array_combine($distance);
                    }//echo "<pre>";print_r($compName);die;
                    



                 /* calculate the new price for updated fields here*/
                 //echo $serTypeId;die;
                     foreach($res as $nearbycomp)
                     {
                          
                           $serviceTypePrice=PriceAdmin::model()->findAll(array('condition'=>'service_id=:service_id AND service_type_id=:service_type_id','params'=>array(
                                                    
                                                     ':service_id'      =>$nearbycomp['id'],
                                                     ':service_type_id' =>$serTypeId,
                            )));
                            
                           foreach($serviceTypePrice  as $serP)
                           {
                                $array[$serP['service_id']]=array('Bedrooms'=>$serP['bedroom'],'Bathrooms'=>$serP['bathroom'],

                                                         'LivingRoom'             =>$serP['living_room'],
                                                         'KitchenStaircases'      =>$serP['kitchen_staircases'],
                                                         'CarpetsInteriorWindows' =>$serP['carpets_interior_windows'],
                                                         'Property'               =>$serP['property'],
                                                         'Desk'                   =>$serP['desk'],
                                                         'Cupboards'              =>$serP['cupboards'],
                                                         'Kitchen'                =>$serP['kitchen'],
                                                         'Staircases'             =>$serP['staircases'],
                                                         'Elevator'               =>$serP['elevator'], 
                                  );  
                                   
                           } 


                           $providerAdnlPrice=ProviderAdditionalprices::model()->findAll(array('condition'=>'service_id=:service_id AND service_type_id=:service_type_id','params'=>array(
                                                    
                                                      ':service_id'      =>$nearbycomp['id'],
                                                      ':service_type_id' =>$serTypeId,

                            ))); 

                            foreach($providerAdnlPrice as $servicePro)
                            {
                               
                              $getIdSerTyAdnlPrice[$servicePro['service_id']][$servicePro['servicetype_additional_id']]=$servicePro['provider_adnlprice'];
                            }  

                             
                           //echo "<pre>";print_r($providerAdnlPrice);
                     } //die;
                     //echo "<pre>";print_r($array);die;  

                            //price calculation for service types starts here 
                            if(!empty($_REQUEST['Cleaning']))
                            {
                                     foreach($array as $companyId => $values){
                                  foreach($_REQUEST['Cleaning'] as $service => $number){
                                    $serviceVal = $values[$service];

									if(key_exists($companyId, $companyServiceSum))
                                    	$companyServiceSum[$companyId] +=$number*$serviceVal;
                                  }
                                 }  
                            } 
                            else
                            {
                                //echo "fsfs";
                               // echo "<pre>";print_r($requestCleaningPage);
                                //echo "<pre>";print_r($array);die;
                            	   foreach($array as $companyId => $values){
                                  foreach($requestCleaningPage['Cleaning'] as $service => $number){
                                    $serviceVal = $values[$service];

                                    $companyServiceSum[$companyId] +=$number*$serviceVal;
                                    }
                                 }
                            } 
                            
                            //price calculation for service types ends here
                               //echo "<pre>";print_r($_REQUEST);
                               //echo "<pre>";print_r($getIdSerTyAdnlPrice);
                               //echo "<pre>";print_r($companyServiceSum);
                            //price calculation for additionl service having price added by company
                             if(!empty($getIdSerTyAdnlPrice))
                             {
                                 foreach($getIdSerTyAdnlPrice as $cmpnyId=>$priceCompAdnl)
	                             {
	                                 //$companyId[]=$cmpnyId; 
                                   if(!empty($_REQUEST['Additional']))
                                   {
                                         foreach($_REQUEST['Additional'] as $key=>$value)
                                         {
                                            $adnlvalues=$priceCompAdnl[$key];
                                            //echo "<pre>";print_r($key);
                                            if(key_exists($cmpnyId, $sumCompanyAdnlser))
                                            	$sumCompanyAdnlser[$cmpnyId] +=$value*$adnlvalues;
                                         } 
                                   }
                                   else
                                   {
                                   	  foreach($requestCleaningPage['Additional'] as $key=>$value)
                                         {
                                            $adnlvalues=$priceCompAdnl[$key];
                                            //echo "<pre>";print_r($key);
                                            $sumCompanyAdnlser[$cmpnyId] +=$value*$adnlvalues;
                                         }
                                   }	
	                                 
	                             }	
                             }	
                              
                             //echo "<pre>";print_r($sumCompanyAdnlser);   
                            //price calculation for additional service having price added by company
                           
                           
                                              
                           $serTypel=ServicetypeAdditionalservices::model()->findAll(array('condition'=>'service_type_id=:service_type_id','params'=>array(
                                                    ':service_type_id'=>$serTypeId,

                            )));
                            
                          
                          foreach($res as $nearbycomp)
                          {
                                     foreach($serTypel as $priceAdnlAdmin)
                                     {
                                            //if($nearbycomp['id']!=)
                                            $admnAdnlPrice[$nearbycomp['id']][$priceAdnlAdmin['id']]=$priceAdnlAdmin['additional_service_price'];
                                             
                                     }
                                
                          }
                          // echo $companyId;die;
                           //echo "<pre>";print_r($admnAdnlPrice);die;
                           //echo "<pre>";print_r($serTypel);die;

                           foreach($admnAdnlPrice as $Id=>$priceAdminAdnl)
                             {
                                 //$companyId[]=$cmpnyId; 
                                 if(!empty($_REQUEST['Additional']))
                                 {
                                          foreach($_REQUEST['Additional'] as $sky=>$v)
                                         {
                                            $adminadnlvalues=$priceAdminAdnl[$sky];
                                            //echo "<pre>";print_r($key);
                                            if(key_exists($Id, $sumadminAdnlser))
                                            	$sumadminAdnlser[$Id] +=$v*$adminadnlvalues;
                                         }
                                 } 
                                 else
                                 {
                                 	    foreach($requestCleaningPage['Additional'] as $sky=>$v)
                                         {
                                            $adminadnlvalues=$priceAdminAdnl[$sky];
                                            //echo "<pre>";print_r($key);
                                            $sumadminAdnlser[$Id] +=$v*$adminadnlvalues;
                                         }

                                 }
                                   
                             } 
                             
                             //echo "<pre>";print_r($sumadminAdnlser);die;
                              if(!empty($sumCompanyAdnlser))
                              {
                              	 $finalAdnlvalues=array_replace($sumadminAdnlser,$sumCompanyAdnlser);

                              } 
                              

                             // code to sum the service types and additional service
                             if(!empty($finalAdnlvalues))
                             { 
                                   foreach (array_keys($companyServiceSum + $finalAdnlvalues) as $key)
                                   {
                                        $sums[$key] = (isset($companyServiceSum[$key]) ? $companyServiceSum[$key] : 0) + (isset($finalAdnlvalues[$key]) ? $finalAdnlvalues[$key] : 0);
                                   } 
                             }
                             //echo "<pre>";print_r($sums);
                             //get the price for per mile 
                             $dist=DistanceCoverage::model()->findAll();
                             foreach($dist as $dkey=>$dprice)
                             {
                                $distprice[$dprice['service_id']]=$dprice['price_per_mile'];
                             } 
                             
                             if(!empty($sums))
                             {
                                 $total = array();
                                 foreach (array_keys($sums + $distprice) as $k)
                                 {
                                      $total[$k] = (isset($sums[$k]) ? $sums[$k] : 0) + (isset($distprice[$k]) ? $distprice[$k] : 0);
                                 }   
                             } 
                             
                             //echo "<pre>";print_r($total);die;                                                     
                             // code to get the rating 

                             foreach($compName as $ratingIds)
                             {
                                $serIds =explode('+',$ratingIds);
                                $rateIds[]=$serIds['1'];
                                //echo "<pre>";print_r($rateIds);
                             }   //die; 
                             
                             foreach($rateIds as $ratingId)
                             { 
                                  //echo "<pre>";print_r($ratingId);findColumn
                                 $ratingsreview[$ratingId]=ServiceReview::model()->findAll(array("select"=>"rating",'condition'=>'service_id=:service_id','params'=>array(
                                                       ':service_id'=>$ratingId,
                                  )));
                                  
                                 

                             } 
                             $res12=array_combine($rateIds,$ratingsreview);
                             //echo "<pre>";print_r($res12);
                              
                              
                              foreach($res12 as $k1=>$sub)
                              {

                                  foreach($sub as $id=>$value)
                                  {
                                  	if(key_exists($k1, $sumArrayRatingAvg))
                                    	$sumArrayRatingAvg[$k1]+=$value['rating'];
                                  }
                                  if(count($res12[$k1]) && key_exists($k1, $sumArrayRatingAvg))
                                    $sumArrayRatingAvg[$k1] /= count($res12[$k1]);
                              } 
                               //echo "<pre>";print_r($sumArrayRatingAvg);die;
                            /*foreach ($myArray as $k=>$subArray) {
                              foreach ($subArray as $id=>$value) {
                                $sumArray[$id]+=$value;
                              }
                            }*/
                             //echo "<pre>";print_r($res12);die;
                             
                             /*foreach($eachMonth as $month => $values)
                              {
                                 echo $month.' : '.$abc[$month] / count($values);

                              }*/
                             
                                
                             
                              //echo "<pre>";print_r($ratingsreview);die;
                             //echo "<pre>";print_r($companyServiceSum); 
                             //echo "<pre>";print_r($finalAdnlvalues);
                            // echo "<pre>";print_r($withinrange); 
                             //echo "<pre>";print_r($sums);die;
                             
                                 
                 /*calculate the price for updated fields ends here*/

             }
            
          
        }

        // code ends here to calculate the distance between postcodes  





         $arr=$_REQUEST;
         //echo "<pre>";print_r($arr);//die;
         
         if(!empty($arr['Additional']))
         {
              foreach($arr['Additional'] as $k=>$a)
             {  
                  $adnlnames=ServicetypeAdditionalservices::model()->findAll(array('condition'=>'id=:id','params'=>array(
                                        ':id'=>$k,
                    )));
                  foreach($adnlnames as $n)
                  {
                      $arr1[$k]=$n['additional_service_name'];
                     
                  } 
                  
                  
             }
             // foreach to get the adnl service name
             foreach( $arr['Additional'] as $origKey => $value ){
              // New key that we will insert into $newArray with
              $newKey = $arr1[$origKey];
              $newArrayAdnl[$newKey] = $value;
              }  
         } 
         
		 //echo "<pre>";print_r($newArray);die;
        
         Yii::app()->session['detail'] = $arr;

         $faq=Faq::model()->findAll(array('condition'=>'status=1'));
        //echo "<pre>";print_r($faq);die;
        
         $links=CmsPages::model()->findAll();
         Yii::app()->params['MyArray'] = $links;
        
          if(isset($res) && !empty($res))
          { 
             $this->render('comparequotes',array('additionalPrice'=>$newAr,'userDetail'=>$userDetail,'faq'=>$faq,'values'=>$newArrayAdnl,'CompanyName'=>$compName,'property'=>$property,'baths'=>$baths,'beds'=>$beds,'sums'=>$total,'detailCleaning'=>$detailCleaning,'sumArrayRatingAvg'=>$sumArrayRatingAvg,'requestCleaningPage'=>$requestCleaningPage));
           }
         else
         {
           $this->render('comparequotes',array('additionalPrice'=>$newAr,'userDetail'=>$userDetail,'faq'=>$faq,'values'=>$newArrayAdnl,'property'=>$property,'baths'=>$baths,'beds'=>$beds,'sums'=>$total,'detailCleaning'=>$detailCleaning,'sumArrayRatingAvg'=>$sumArrayRatingAvg,'requestCleaningPage'=>$requestCleaningPage));

         }
        
       /* $res=ServiceUser::model()->findAll(array('condition'=>'zipcode =:scode',
                                 'params'=>array(
                                           ':scode'=>$zip,
                                  ),
                                          
                            )); 
       
       
        
        $faq=Faq::model()->findAll(array('condition'=>'status=1'));


         $this->render('comparequotes',array('faq'=>$faq,'values'=>$arr,'CompanyName'=>$compName));*/
          
    }

    // coede to get the result 
    public function actionSerachMiles()
    {
		$companyServiceSum = array();
		$sumCompanyAdnlser = array();
		$sumadminAdnlser = array();
		
        // code to get the miles
    	/*$theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        */

        

       //echo "<pre>";print_r($_REQUEST);die;
         $requestCleaningPage=Yii::app()->session['CleaningReqst'];
         //echo "<pre>";print_r($request['Cleaning']);die;
         $ses = Yii::app()->session['CleaningDetail'];
        
        //echo "<pre>";print_r($ses);die;  
         $serTypeId=Yii::app()->session['ServiceTypeId'];
           
        

        $zip=$ses['CleaningTime']['PostCode'];
        $cleaningDate=$ses['CleaningTime']['CleaningDate'];
        $time=$ses['CleaningTime']['time'];
        
          
        // code to calculate the postcodes within radius
        //echo "<pre>";print_r($_REQUEST);die;

		if( isset($_REQUEST['Cleaning']) && is_array($_REQUEST['Cleaning']) )
		{
	 		if( key_exists('Property', $_REQUEST['Cleaning']) )
        		$property = $_REQUEST['Cleaning']['Property'];
			else
		    	$property = '';
		    $baths=$_REQUEST['Cleaning']['Bathrooms'];
		    $beds=$_REQUEST['Cleaning']['Bedrooms']; 
        }


         // get the customer lat and long from where we want to calculate other postcodes
    
        $recUk=UkPostcodes::model()->findByPk($zip);
        $r=3959;//earth radius in miles
        //$d=5.6;
        $d=$_REQUEST['mile'];
        //$d=$_REQUEST['mile']*60*1.1515; 
        $c=count($recUk);
        if($c>0)
        { 
          $lat1=$recUk->latitude;

          $lon1=$recUk->longitude;


          $nlat1=deg2rad($lat1);
          $nlon1=deg2rad($lon1);

          $latN = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(0))));

            

          $latS = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(180))));
          $lonE = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(90)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));
          $lonW = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(270)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));


         $query = "SELECT * from ccobs_service_user WHERE (lat <= $latN AND lat >= $latS AND longitude <= $lonE AND longitude >= $lonW) AND (lat != $lat1 AND longitude != $lon1) AND city != ' ' ORDER BY   lat, longitude ";

         
          

         $dataReader = Yii::app()->db->createCommand($query)->query();

          $res = $dataReader->readAll(); 
          
             if(!empty($res))
            {

            	  foreach($res as $i=>$noOfUsers)
                    {
                      $noUsrId[]=$noOfUsers['id'];
                      //$compNam[]=$noOfUsers['company_name'];
                      $compNam[]=$noOfUsers['company_name']."+".$noOfUsers['id'];

                      $latitude[]=$noOfUsers['lat'];
                      $longitude[]=$noOfUsers['longitude'];

                      $nlatitude=deg2rad($noOfUsers['lat']);
                      $nlongitude=deg2rad($noOfUsers['longitude']);
                      
                      

                      $delta_lat=$nlatitude-$nlat1;

                      $delta_lon=$nlongitude-$nlon1;  

                      $temp = pow(sin($delta_lat / 2.0), 2) + cos($nlatitude) * cos($lat1) * pow(sin($delta_lon / 2.0), 2);
                      $EARTH_RADIUS = 3956;
                      $distance[] = $EARTH_RADIUS * 2 * atan2(sqrt($temp), sqrt(1 - $temp));
                      
                      $compName=array_combine($distance,$compNam);
                      //$compName=array_combine($distance);
                    }//echo "<pre>";print_r($compName);die;
                    



                 /* calculate the new price for updated fields here*/
                 //echo $serTypeId;die;
                     foreach($res as $nearbycomp)
                     {
                          
                           $serviceTypePrice=PriceAdmin::model()->findAll(array('condition'=>'service_id=:service_id AND service_type_id=:service_type_id','params'=>array(
                                                    
                                                     ':service_id'      =>$nearbycomp['id'],
                                                     ':service_type_id' =>$serTypeId,
                            )));
                            
                           foreach($serviceTypePrice  as $serP)
                           {
                                $array[$serP['service_id']]=array('Bedrooms'=>$serP['bedroom'],'Bathrooms'=>$serP['bathroom'],

                                                         'LivingRoom'             =>$serP['living_room'],
                                                         'KitchenStaircases'      =>$serP['kitchen_staircases'],
                                                         'CarpetsInteriorWindows' =>$serP['carpets_interior_windows'],
                                                         'Property'               =>$serP['property'],
                                                         'Desk'                   =>$serP['desk'],
                                                         'Cupboards'              =>$serP['cupboards'],
                                                         'Kitchen'                =>$serP['kitchen'],
                                                         'Staircases'             =>$serP['staircases'],
                                                         'Elevator'               =>$serP['elevator'], 
                                  );  
                                   
                           } 


                           $providerAdnlPrice=ProviderAdditionalprices::model()->findAll(array('condition'=>'service_id=:service_id AND service_type_id=:service_type_id','params'=>array(
                                                    
                                                      ':service_id'      =>$nearbycomp['id'],
                                                      ':service_type_id' =>$serTypeId,

                            ))); 

                            foreach($providerAdnlPrice as $servicePro)
                            {
                               
                              $getIdSerTyAdnlPrice[$servicePro['service_id']][$servicePro['servicetype_additional_id']]=$servicePro['provider_adnlprice'];
                            }  

                             
                           //echo "<pre>";print_r($providerAdnlPrice);
                     } //die;
                     //echo "<pre>";print_r($getIdSerTyAdnlPrice);die;  

                            //price calculation for service types starts here 
                            

                            foreach($array as $companyId => $values){
                              if(!empty($request['Cleaning']))
                              {
		                              foreach($request['Cleaning'] as $service => $number){
		                                $serviceVal = $values[$service];

		                                $companyServiceSum[$companyId] +=$number*$serviceVal;
		                              }
		                       }
		                       else
		                       {
		                       	  //echo "<pre>";print_r($requestCleaningPage);die;
                                     foreach($requestCleaningPage['Cleaning'] as $service => $number){
		                                $serviceVal = $values[$service];
										if( key_exists($companyId, $companyServiceSum) )
		                                	$companyServiceSum[$companyId] +=$number*$serviceVal;
		                              }
		                       }        
                            }
                            //price calculation for service types ends here
                               //echo "<pre>";print_r($_REQUEST);
                               //echo "<pre>";print_r($getIdSerTyAdnlPrice);
                               //echo "<pre>";print_r($companyServiceSum);
                            //price calculation for additionl service having price added by company
                             
                             foreach($getIdSerTyAdnlPrice as $cmpnyId=>$priceCompAdnl)
                             {
                                 //$companyId[]=$cmpnyId; 
                             	 if(!empty($request['Additional']))
                             	 {
                             	      foreach($request['Additional'] as $key=>$value)
	                                 {
	                                    $adnlvalues=$priceCompAdnl[$key];
	                                    //echo "<pre>";print_r($key);
	                                    if( key_exists($cmpnyId, $sumCompanyAdnlser) )
	                                    	$sumCompanyAdnlser[$cmpnyId] +=$value*$adnlvalues;
	                                 }	
                             	 }
                             	 else
                             	 {
                             	 	  foreach($requestCleaningPage['Additional'] as $key=>$value)
	                                 {
	                                    $adnlvalues=$priceCompAdnl[$key];
	                                    //echo "<pre>";print_r($key);
                                    	if( key_exists($cmpnyId, $sumCompanyAdnlser) )
	                                   		$sumCompanyAdnlser[$cmpnyId] +=$value*$adnlvalues;
	                                 }	
                             	 }	
                                 
                             } 
                             //echo "<pre>";print_r($sumCompanyAdnlser);   
                            //price calculation for additional service having price added by company
                           
                           
                                              
                           $serTypel=ServicetypeAdditionalservices::model()->findAll(array('condition'=>'service_type_id=:service_type_id','params'=>array(
                                                    ':service_type_id'=>$serTypeId,

                            )));
                            
                          
                          foreach($res as $nearbycomp)
                          {
                                     foreach($serTypel as $priceAdnlAdmin)
                                     {
                                            //if($nearbycomp['id']!=)
                                            $admnAdnlPrice[$nearbycomp['id']][$priceAdnlAdmin['id']]=$priceAdnlAdmin['additional_service_price'];
                                             
                                     }
                                
                          }
                          // echo $companyId;die;
                           //echo "<pre>";print_r($admnAdnlPrice);die;
                           //echo "<pre>";print_r($serTypel);die;

                           foreach($admnAdnlPrice as $Id=>$priceAdminAdnl)
                             {
                                 //$companyId[]=$cmpnyId;
                                 if(!empty($request['Additional']))
                                 {
                                         foreach($request['Additional'] as $sky=>$v)
		                                 {
		                                    $adminadnlvalues=$priceAdminAdnl[$sky];
		                                    //echo "<pre>";print_r($key);
		                                    if( key_exists($Id, $sumadminAdnlser) )
		                                    	$sumadminAdnlser[$Id] +=$v*$adminadnlvalues;
		                                 }	
                                 }
                                 else
                                 {
                                 	 foreach($requestCleaningPage['Additional'] as $sky=>$v)
		                                 {
		                                    $adminadnlvalues=$priceAdminAdnl[$sky];
		                                    //echo "<pre>";print_r($key);
		                                    if( key_exists($Id, $sumadminAdnlser) )
		                                    	$sumadminAdnlser[$Id] +=$v*$adminadnlvalues;
		                                 }
                                 } 
                                 
                             } 
                             
                             //echo "<pre>";print_r($sumadminAdnlser);die;

                              $finalAdnlvalues=array_replace($sumadminAdnlser,$sumCompanyAdnlser);


                             // code to sum the service types and additional service
                             $sums = array();
                             foreach (array_keys($companyServiceSum + $finalAdnlvalues) as $key)
                             {
                                  $sums[$key] = (isset($companyServiceSum[$key]) ? $companyServiceSum[$key] : 0) + (isset($finalAdnlvalues[$key]) ? $finalAdnlvalues[$key] : 0);
                             } 
                             //echo "<pre>";print_r($sums);
                             //get the price for per mile 
                             $dist=DistanceCoverage::model()->findAll();
                             foreach($dist as $dkey=>$dprice)
                             {
                                $distprice[$dprice['service_id']]=$dprice['price_per_mile'];
                             } 

                             $total = array();
                             foreach (array_keys($sums + $distprice) as $k)
                             {
                                  $total[$k] = (isset($sums[$k]) ? $sums[$k] : 0) + (isset($distprice[$k]) ? $distprice[$k] : 0);
                             } 
                             //echo "<pre>";print_r($total);die;                                                     
                             // code to get the rating 

                             foreach($compName as $ratingIds)
                             {
                                $serIds =explode('+',$ratingIds);
                                $rateIds[]=$serIds['1'];
                                //echo "<pre>";print_r($rateIds);
                             }   //die; 
                             
                             foreach($rateIds as $ratingId)
                             { 
                                //echo "<pre>";print_r($ratingId);
                                 $ratingsreview[$ratingId]=ServiceReview::model()->findAll(array("select"=>"rating",'condition'=>'service_id=:service_id','params'=>array(
                                                       ':service_id'=>$ratingId,
                                  )));
                                // echo "<pre>";print_r($review);
                                 
                             } //die;
                             
                             $res12=array_combine($rateIds,$ratingsreview);
                             //echo "<pre>";print_r($res12);
                              $sumArrayRatingAvg = array();
                              
                              foreach($res12 as $k1=>$sub)
                              {

                                  foreach($sub as $id=>$value)
                                  {
                      				if( key_exists($k1, $sumArrayRatingAvg) )
                                    	$sumArrayRatingAvg[$k1]+=$value['rating'];
                                  }
                                  if( count($res12[$k1]) && key_exists($k1, $sumArrayRatingAvg) )
                                    $sumArrayRatingAvg[$k1] /= count($res12[$k1]);
                              } 
                             //echo "<pre>";print_r($companyServiceSum); 
                             //echo "<pre>";print_r($finalAdnlvalues);
                            // echo "<pre>";print_r($withinrange); 
                             //echo "<pre>";print_r($sums);die;
                             
                         
                 /*calculate the price for updated fields ends here*/
                    $this->renderPartial('miles',array('sums'=>$total,'CompanyName'=>$compName,'d'=>$d,'sumArrayRatingAvg'=>$sumArrayRatingAvg,'requestCleaningPage'=>$requestCleaningPage));
                    //echo $d;die;

             }
             else
             {

                 $d=$_REQUEST['mile'];
                 $this->renderPartial('milesEmpty',array('d'=>$d));
                    
      
             } 
         } 
         else
         {
                  $d=$_REQUEST['mile'];
                 $this->renderPartial('milesEmpty',array('d'=>$d));
         }      
    }






    public function actionAjaxPropertyChnage()
    {
        $serviceTypeId=$_REQUEST['serviceTypeId'];
        $propSize=$_REQUEST['propSize']; 
    	//echo "<pre>";print_r($_REQUEST);die;
        $bedBaths=ServicePrice::model()->findAll(array(
        	       'condition'=>'service_type_id = :serviceTypeId AND property_size =:property',
					'params'=>array(
						':serviceTypeId'=>$serviceTypeId,
						':property'=>$propSize,
					),
			));  //'condition'=>'title LIKE :t AND area_id = :aid',

    	foreach($bedBaths as $res)
    	{
    		$beds=$res->no_of_beds;
    		$baths=$res->no_of_baths;

    		echo "<div class='controlHolder'>";
                         echo "<div class='tmTextarea'>";
                          echo "<select name='beds' id='beds'>";
                          //echo"<option value='0'>Bedrooms</option>";
                          echo "<option value=".$beds.">".$beds." Bedrooms"."</option>";
                          echo "<select/>";
                        echo "</div>";
                    echo"</div>";
          
    	}	
        
      
    	//echo "<pre>";print_r($beds);die;
    }

    public function actionAjaxPropertyBaths()
    {
        $serviceTypeId=$_REQUEST['serviceTypeId'];
        $propSize=$_REQUEST['propSize']; 
    	//echo "<pre>";print_r($_REQUEST);die;
        $bedBaths=ServicePrice::model()->findAll(array(
        	       'condition'=>'service_type_id = :serviceTypeId AND property_size =:property',
					'params'=>array(
						':serviceTypeId'=>$serviceTypeId,
						':property'=>$propSize,
					),
			));  //'condition'=>'title LIKE :t AND area_id = :aid',

    	foreach($bedBaths as $res)
    	{
    		$beds=$res->no_of_beds;
    		$baths=$res->no_of_baths;

    		/*echo "<div class='controlHolder'>";
                         echo "<div class='tmTextarea'>";
                          echo "<select name='beds' id='beds'>";
                          //echo"<option value='0'>Bedrooms</option>";
                          echo "<option value=".$beds.">".$beds." Bedrooms"."</option>";
                          echo "<select/>";
                        echo "</div>";
                    echo"</div>";*/
            

            echo "<div class='controlHolder'>";
                         echo "<div class='tmTextarea'>";
                          echo "<select name='baths' id='baths'>";
                          //echo"<option value='0'>Bedrooms</option>";
                          echo "<option value=".$baths.">".$baths." Bathrooms"."</option>";
                          echo "<select/>";
                        echo "</div>";
                    echo"</div>";        


    	}	
        
      
    	//echo "<pre>";print_r($beds);die;
    }

    public function actionAjaxBedsChnage()
    {
            	$serviceTypeId=$_REQUEST['serviceTypeId'];
            	$beds=$_REQUEST['beds'];

            	$bed=ServicePrice::model()->findAll(array(
                	       'condition'=>'service_type_id = :serviceTypeId AND no_of_beds =:beds',
        					'params'=>array(
        						':serviceTypeId'=>$serviceTypeId,
        						':beds'=>$beds,
        					),
        			));  
            	foreach($bed as $b)
            	{
            		$prop_size=$b->property_size;
            		$bath=$b->no_of_baths;


            		echo "<div class='controlHolder'>";
                                 echo "<div class='tmTextarea'>";
                                  echo "<select name='property' id='property'>";
                                  //echo"<option value='0'>Bedrooms</option>";
                                  echo "<option value=".$prop_size.">".$prop_size." (sqft)Property Size"."</option>";
                                  echo "<select/>";
                                echo "</div>";
                            echo"</div>";     
            	} 

    }
    // code to get the baths on changing the value for bedrooms starts here
    public function actionAjaxBedsBathChnage()
    {
           $serviceTypeId=$_REQUEST['serviceTypeId'];
              $beds=$_REQUEST['beds'];

              $bed=ServicePrice::model()->findAll(array(
                         'condition'=>'service_type_id = :serviceTypeId AND no_of_beds =:beds',
                  'params'=>array(
                    ':serviceTypeId'=>$serviceTypeId,
                    ':beds'=>$beds,
                  ),
              ));  
              foreach($bed as $b)
              {
                $prop_size=$b->property_size;
                $bath=$b->no_of_baths;


                echo "<div class='controlHolder'>";
                                 echo "<div class='tmTextarea'>";
                                  echo "<select name='baths' id='baths'>";
                                  //echo"<option value='0'>Bedrooms</option>";
                                  echo "<option value=".$bath.">".$bath." Bathrooms"."</option>";
                                  echo "<select/>";
                                echo "</div>";
                            echo"</div>";     
              } 
         
    }
    // code to get the baths on changing the value for bedrooms ends here

    public function actionAjaxBathsChnage()
    {
        //echo "<pre>";print_r($_REQUEST);die;

        $serviceTypeId=$_REQUEST['serviceTypeId'];
        $baths=$_REQUEST['baths'];

         $baths=ServicePrice::model()->findAll(array(
                         'condition'=>'service_type_id = :serviceTypeId AND no_of_baths =:baths',
                  'params'=>array(
                    ':serviceTypeId'=>$serviceTypeId,
                    ':baths'=>$baths,
                  ),
              ));  
              foreach($baths as $b)
              {
                $prop_size=$b->property_size;
                $bed=$b->no_of_beds;


                echo "<div class='controlHolder'>";
                                 echo "<div class='tmTextarea'>";
                                  echo "<select name='property' id='property'>";
                                  //echo"<option value='0'>Bedrooms</option>";
                                  echo "<option value=".$prop_size.">".$prop_size." (sqft)Property Size"."</option>";
                                  echo "<select/>";
                                echo "</div>";
                            echo"</div>";     
              } 

    }

    public function actionAjaxBathsBedChnage()
    {
        $serviceTypeId=$_REQUEST['serviceTypeId'];
        $baths=$_REQUEST['baths'];

         $baths=ServicePrice::model()->findAll(array(
                         'condition'=>'service_type_id = :serviceTypeId AND no_of_baths =:baths',
                  'params'=>array(
                    ':serviceTypeId'=>$serviceTypeId,
                    ':baths'=>$baths,
                  ),
              ));  
              foreach($baths as $b)
              {
                $prop_size=$b->property_size;
                $bed=$b->no_of_beds;


                echo "<div class='controlHolder'>";
                                 echo "<div class='tmTextarea'>";
                                  echo "<select name='beds' id='beds'>";
                                  //echo"<option value='0'>Bedrooms</option>";
                                  echo "<option value=".$bed.">".$bed." Bedrooms"."</option>";
                                  echo "<select/>";
                                echo "</div>";
                            echo"</div>";     
              } 
    }
    

         public function actionCompanyProfile()
        {
           $id=$_REQUEST['id'];

           $rec=ServiceUser::model()->with('serviceImages','serviceReviews')->findByPk($id);
           
           //echo "<pre>";print_r($rec);die;
               //echo "<pre>";print_r($Stype);die;  
            $links=CmsPages::model()->findAll();
            Yii::app()->params['MyArray'] = $links;
           $this->render('companyProfile',array('compDetail'=>$rec));
        }
        // function to view the company profile ends here
        
        // company Detail in pop up box by ajax
        public function actionAjaxPopUpDetailCompany()
        {
          $id=$_REQUEST['id'];
          $compDetail=ServiceUser::model()->with('serviceImages','serviceReviews')->findByPk($id);
          //echo "<pre>";print_r($compDetail);die;
             echo " 
                   <div class='profile_col'>";
                            
                              echo "<div class='d_col'>
                                <h4> Company Name :</h4>";
                                echo "<h5>";echo $compDetail['company_name'];echo "</h5>
                              </div>"; 
                              echo "<div class='d_col'>
                                <h4> ZipCode :</h4>";
                                echo "<h5>"; echo $compDetail['zipcode'];echo "</h5>
                              </div>";
                              echo "<div class='d_col'>
                                <h4> City :</h4>";
                                echo "<h5>";echo $compDetail['city'];echo "</h5>
                              </div>";
                              
                              echo "<div class='d_col'>
                                <h4> Email :</h4>";
                                echo "<h5>"; echo $compDetail['email'];echo "</h5>
                              </div>                   
                    
                     </div>";die;
             
        }

         // function for forgot password starts here

        public function actionForgotPassword()
        {
            $model=new ForgotPassword;
            $getEmail=$_POST['ForgotPassword']['email'];
            $getModel= ServiceUser::model()->findByAttributes(array('email'=>$getEmail));

            $gtModel=CustomerUser::model()->findByAttributes(array('email'=>$getEmail));

            if(isset($_POST['ForgotPassword']))
            {
               $model->attributes=$_POST['ForgotPassword'];
               if($model->validate())
               {
                    if(!empty($getModel))
                    {
                             $p=rand();  
                             $pwd = md5($p);
                             
                             $subject = 'Welcome to Wow Cleans';
                             $body = $this->renderPartial('registrationEmail', array(
                                      'model'=>$model,
                                      'password'=>$p,
                                      //'url'=>$this->createAbsoluteUrl('registration/login', array('email' => $model->email, 'signature' => $signature)),
                                      //'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                                    ), true);
                             
                             $getModel->password=$pwd;
                             if($getModel->save())
                             {
                                $msg=Yii::app()->user->setFlash('serviceforgot',"Please check you email !");
                                Yii::app()->mailer->send($model->email, $subject, $body);
                                
                   
                                $this->redirect(array('registration/registration/index'));
                             } 



                    }  
                    if(!empty($gtModel))
                    {
                             $p=rand();  
                             $pwd = md5($p);
                             
                             $subject = 'Welcome to Wow Cleans';
                             $body = $this->renderPartial('registrationEmail', array(
                                      'model'=>$model,
                                      'password'=>$p,
                                      //'url'=>$this->createAbsoluteUrl('registration/login', array('email' => $model->email, 'signature' => $signature)),
                                      //'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                                    ), true);
                             
                             $gtModel->password=$pwd;
                             if($gtModel->save())
                             {
                                Yii::app()->mailer->send($model->email, $subject, $body);
                                Yii::app()->user->setFlash('forgotc', "Please check you email");
                                $this->redirect(array('registration/registration/index'));
                             } 



                    } 
               }
               else
               {
                 $errors=$model->getErrors();
               }
            }
             $links=CmsPages::model()->findAll();
             Yii::app()->params['MyArray'] = $links;
           $this->render('forgotpassword',array('model'=>$model));
        }

        // function to get the page detail with id starts here
    
    public function actionPages()
    {
       $id=$_REQUEST['id'];

       $rec=CmsPages::model()->findByPk($id);
       //echo "<pre>";print_r($rec);die;
        $links=CmsPages::model()->findAll();
        Yii::app()->params['MyArray'] = $links; 
       
       $this->render('pages',array('page'=>$rec));
    }

    // contact page
     public function actionContact()
    {


          $model=new ContactForm;
          if(isset($_POST['ContactForm']))
          {

              $model->attributes=$_POST['ContactForm'];
              if($model->validate())
              {
                       $subject = 'Welcome to Wow Cleans';
                       $body = $this->renderPartial('contactEmail', array(
                                'model'=>$model,
                                //'password'=>$cleartext_password,
                                //'url'=>$this->createAbsoluteUrl('login', array('email' => $model->email, 'signature' => $signature)),
                                //'imagesPath' => Yii::app()->request->serverName . Yii::app()->theme->baseUrl . '/images/registrationEmail',
                              ), true);
                       //echo "<pre>";print_r($body);die;
            
                    Yii::app()->mailer->send($model->email, $subject, $body);
                    Yii::app()->user->setFlash('success', "Successfully send your message.");
                $this->refresh();
              }
              else
              {
                $errors=$model->getErrors();
                //echo var_dump($errors);
               }
          }
              $links=CmsPages::model()->findAll();
              Yii::app()->params['MyArray'] = $links;
              $this->render('contact',array('model'=>$model));
        }
}
