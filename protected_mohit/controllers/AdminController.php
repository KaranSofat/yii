<?php

class AdminController extends Controller
{
	public function actionIndex()
	{
		 //echo Yii::app()->request->baseUrl;die;

		ob_start();
		Yii::app()->theme='back'; 
         $model=new LoginForm;
          
       
		$this->render('index',array('model'=>$model));
	}

	
	public function actionLogin()
	{
		ob_start();
		Yii::app()->theme='back'; 
		$model=new LoginForm;
        //echo "Mohit";die;  
        
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			
			$uName=$_POST['LoginForm']['username'];
			$uPass=$_POST['LoginForm']['password'];
			$pass=md5($uPass);
			$admin = Admin::model()->findByAttributes(array('username'=>$uName,'password'=>$pass));
            $count=count($admin);
            //echo $count;die;

			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
               
				//$this->redirect(Yii::app()->user->returnUrl);
				Yii::app()->session['username']=$uName;
			if($count>0)
			{
			    //Yii::app()->session['username']=$uName;

				$this->redirect('dashboard',array('model'=>$model));
			}
			else
			{
			    $this->render('index',array('model'=>$model));		
		 	}	
             
			
		}
		// display the login form
		//$this->render('index',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		ob_start();
		Yii::app()->theme='back'; 

		Yii::app()->user->logout();
         $this->redirect('index');
		//$this->redirect(Yii::app()->homeUrl);
	}

	public function actionDashboard()
	{
		ob_start();
		Yii::app()->theme='back'; 
         
           $this->render('dashboard');
	}
	public function actionCms()
	{
        ob_start();
		Yii::app()->theme='back';
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
    	ob_start();
		Yii::app()->theme='back';
          
		$cmsview=CmsPages::model()->findByAttributes(array('id'=>$id));
        //echo "<pre>";print_r($cmsview);die;
        $this->render('cmsview',array('view'=>$cmsview));
    }
    public function actionCmsEdit($id)
    {
        ob_start();
		Yii::app()->theme='back';
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
			 	//var_dump($errors);
			 }	
		}	
		
        $this->render('cmsedit',array('edit'=>$cmsedit,'model'=>$model));
    }
     

	public function actionCmslisting()
	{
		ob_start();
		Yii::app()->theme='back';
        $model=new CmsPages;
       
		$listing=CMSPages::model()->findAll();
        
		$this->render('cmslisting',array('list'=>$listing));
	}
    



    public function actionAddPrice()
    {
        ob_start();
		Yii::app()->theme='back';
        $model=new ServicePrice;

        $attr=new NewAttribute;
        
        $resAttr=ServiceUser::model()->with('newAttributes')->findAll();
       // echo "<pre>";print_r($resAttr);die;
        //echo "<pre>";print_r($_REQUEST);die;
        // to get the new added columns
        //echo "<pre>";print_r();die; 
        /*$columns=Yii::app()->db->schema->getTable('ccobs_service_price')->columns;
        $c=count($columns);
        if($c>10)
        {	
	        foreach(array_slice($columns,10) as $c)
	        {
	        	//echo "<pre>";print_r($c);
	        	$arrCol[]=$c->name;
	        } 
       }//die;*/
       //echo "<pre>";print_r($arrCol);die;
       // to get the new added columns ends here


       //echo "<pre>";print_r($arr);die;   
        
        $res=ServiceTypes::model()->findAll();
        $userS=ServiceUser::model()->findAll();
        
        // echo "<pre>";print_r($_REQUEST);die;
        if(isset($_POST['ServicePrice']))
        {	
        	 //echo "mkd"."<pre>";print_r($_POST['ServicePrice']);die;
        	   $model->attributes = $_POST['ServicePrice'];
	           if($model->validate())
	           {

                      //echo "<pre>";print_r($Id);die;
                        //echo "<pre>";print_r($_REQUEST);die;

         	            //$service_type=$_REQUEST['ServicePrice']['service_type_id'];                    	
	                    $service_type=$_REQUEST['ServicePrice']['service_type_id']; 
			            //$companyId=$_REQUEST['ServicePrice']['service_id'];
			            $beds=$_REQUEST['ServicePrice']['no_of_beds'];
			            $baths=$_REQUEST['ServicePrice']['no_of_baths'];
			            $property=$_REQUEST['ServicePrice']['property_size'];
			            if($service_type=='3')
			            {	
			             $area=$_REQUEST['ServicePrice']['area'];
			             $desk=$_REQUEST['ServicePrice']['no_of_desk'];
			            }
			            $money=$_REQUEST['ServicePrice']['price'];
			            $date=date('Y-m-d'); 
			           //to add price for a particular service provided by company
			            $model->service_type_id=$service_type;
			            $model->service_id=$companyId;
			            $model->no_of_beds=$beds;
			            $model->no_of_baths=$baths;
			            $model->property_size=$property;
			            if($service_type=='3')
			            {	
			             $model->area=$area;
			             $model->no_of_desk=$desk;
			            }
			            	
			           // $model->price=$money;
			            $model->date=$date; 
	                   // echo "fsfs";die;
	                                      
			            if($model->save(false))
			            {	
			              //echo "dfsf";die;
			              $PricelastId=Yii::app()->db->getLastInsertId();
                          

                          //$Attrid=$_REQUEST['newAttrTableId'];
                          if(isset($_REQUEST['newAttrTableId']))
                          {	
                          	  $Attrid=$_REQUEST['newAttrTableId'];
	                          $AdditionalValues=$_REQUEST['AdditionalValues'];
	                          //echo "<pre>";print_r($AdditionalValues);die;
	                          $res=array_combine($Attrid,$AdditionalValues);

	                          $date=date('Y-m-d'); 
	                          
	                                foreach($res as $i=>$values)
	                                {

	                                	 $command = Yii::app()->db->createCommand();
	                                	 $command->insert('ccobs_additional_attr', array(
												    'priceTableId'=>$PricelastId,
												    'newAttrId'=>$i,
												    'additionalFieldName'=>$values,
												    'date'=>$date
												));
	                                }          
	                              
                           }  

			              $this->redirect('pricelisting');
			            }
					  
	         		
               }
        
                 else 
                 { 
                 	    
                 	      $errors = $model->getErrors();
                 	      //var_dump($errors);
					       	
		         } 
           

        }
        if(isset($arrCol))
        {	

           $this->render('addserviceprice',array('model'=>$model,'serType'=>$res,'user'=>$userS,'resAttr'=>$resAttr,'arrCol'=>$arrCol));    	
        } 
        else
        {
           $this->render('addserviceprice',array('model'=>$model,'serType'=>$res,'user'=>$userS,'resAttr'=>$resAttr));    	
           //$this->render('addserviceprice',array('model'=>$model,'serType'=>$res,'user'=>$userS));    	
    
 
        }	

    }


    public function actionPriceListing()
    {
        ob_start();
		Yii::app()->theme='back';
        $model=new ServicePrice;
        $ad=new AdditionalAttr;

        $list=ServiceUser::model()->with('servicePrices','newAttributes')->findAll();
        //echo "<pre>";print_r($list);die;
        //echo "<pre>";print_r($list->);die;
        $price=ServicePrice::model()->with('serviceType','additionalAttrs','service')->findAll();
        
        //echo "<pre>";print_r($price);die;  
         
        
       	foreach($list as $res)
       	{
            $companyName[]=$res->company_name;
            $cmpId[]=$res->id;	
            $res=array_combine($cmpId,$companyName);
             
           // $arr=ServiceUser['newAttributes'];            
       	}//echo "<pre>";print_r($arr);die;	
        
       $this->render('pricelisting',array('Plist'=>$price,'compName'=>$res,'attr'=>$list));
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
	

   // code to show the listing of price according service types
	public function actionAjaxPriceLoad()
	{
        $service_id=$_REQUEST['val'];
        //echo $service_id;die;
		$res=ServicePrice::model()->with('serviceType','additionalAttrs')->findAll(array("condition"=>"service_id=".$service_id));
		//$a=$res->serviceType['service_name'];
		// /echo "<pre>";print_r($a);die;
		//echo "<pre>";print_r($res);die;
		/*$baseUrl = Yii::app()->baseUrl; 
        $cs = Yii::app()->getClientScript();      
       	$cs->registerScriptFile($baseUrl.'/themes/back/js/config.js');
       	$cs->registerScriptFile($baseUrl.'/themes/back/js/script.js');*/
		echo "
                
	
             <table class='datatable'>
			
				
				<thead>
					<tr>
					    <th>Sr No</th>
						<th class='sort'>Service Type</th>
						<th>No of Beds</th>
						<th>No of Baths</th>
						<th>Property size</th>
						<th>Area</th>
						<th>No of Desk</th>
						<th>Price</th>
						
						
						
					</tr>
				</thead> ";
				echo " <tbody> ";
					 $i=1; 
					 foreach($res as $r ) { 				 	
				          
				 	    echo "<tr class='gradeX'>";
					    echo"<td>".$i++; "</td>";
						echo"<td>".$r->serviceType['service_name']."</td>";
						echo "<td>".$r['no_of_beds']."</td>";
						echo"<td>".$r['no_of_baths']."</td>";
						echo"<td>".$r['property_size']."</td>";
						echo"<td>".$r['area']."</td>";
						echo"<td>".$r['no_of_desk']."</td>";
						echo"<td>".$r['price']."$"."</td>";
						//echo"<td>".."</td>";
						
					echo"</tr>";
					} 
				echo "</tbody>
			</table>";$baseUrl = Yii::app()->baseUrl; 
        $cs = Yii::app()->getClientScript();      
       	$cs->registerScriptFile($baseUrl.'/themes/back/js/config.js');
       	$cs->registerScriptFile($baseUrl.'/themes/back/js/script.js');die;
		
		
	}


	//function to add new attribute in db 

	public function actionAddColumnAttribute()
	{
        ob_start();
		Yii::app()->theme='back'; 
		//$model=new ServicePrice;
		$model=new NewAttribute; 
       // echo "<pre>";print_r($_REQUEST);die;
		$column=$_REQUEST['attribute'];
		
		if(!empty($_REQUEST['attribute']))
		{
		     
              // to add new column in db
             // Yii::app()->db->createCommand()->addColumn('ccobs_service_price',$column,'int');
               // to add values in attribute table to keep inform which attribute is added under which company
               $date=date('Y-m-d');
               $model->service_id=$_REQUEST['serviceProvider'];
               $model->service_type_id=$_REQUEST['service_type'];
               $model->attribute=$_REQUEST['attribute']; 

               $model->date=$date;
               $model->save(false);
              // $n=getColumn();
               //echo $n;die;
               
               $this->redirect('addprice');

              
		}	
	}


	public function actionAjaxNewAttribute()
	{

          $typeId=$_REQUEST['type'];
          $companyId=$_REQUEST['company'];
          $attribute=$_REQUEST['attribute'];
          
          $model=new NewAttribute; 
          if(!empty($_REQUEST))
          {

               $date=date('Y-m-d');
               $model->service_id=$_REQUEST['company'];
               $model->service_type_id=$_REQUEST['type'];
               $model->attribute=$_REQUEST['attribute']; 

               $model->date=$date;
               $model->save(false);
               echo "success";die;
          	 
          }	

	}


	//get the value on the basis of servicetype newly added field name
	public function actionAjaxServiceTypeFieldName()
	{
         //echo "<pre>";print_r($_REQUEST);die;
         $serviceTypeId=$_REQUEST['serviceTypeId'];
         //$companyId=$_REQUEST['companyId'];

         //$rec=NewAttribute::model()->findAll(array("condition"=>"service_type_id=".$serviceTypeId."&& service_id=".$companyId));

          $rec=NewAttribute::model()->findAll(array("condition"=>"service_type_id=".$serviceTypeId));
 
         

         //echo "<pre>";print_r($rec);die;
        
        foreach($rec as $c)
        {	

                     echo"<label>".$c->attribute."</label>";
		            echo"<div>";
			           
			            
			            echo" <input type='text' value='' class='ajaxAttr required integer' name='AdditionalValues[]'>";
			            echo "<input type='hidden' name='newAttrTableId[]' value=".$c->id.">";
			             echo "   ". "<a href='javascript:void(0)' class='btnDlt ' id=".$c->id.">Delete</a>";
		            echo"</div>"; 
             
       } 
       
	}

	//function for to view the detail of price of any company starts here

     public function actionPriceView($id)
     {
         ob_start();
		 Yii::app()->theme='back';
		 $model=new ServicePrice;

		 $price=ServicePrice::model()->with('serviceType','additionalAttrs','service')->findByAttributes(array("id"=>$id));
         foreach($price->additionalAttrs as $p)
         {
               $additionalValues[]=$p->additionalFieldName;
               $newAttrId[]=$p->newAttrId;
               $resCombine=array_combine($newAttrId,$additionalValues);
         }	//echo "<pre>";print_r($resCombine);die;
         if(!empty($newAttrId))
         {
		         foreach($newAttrId as $id)
		         {	
		              $attrName=NewAttribute::model()->findAll(array("condition"=>"id=".$id));
		              //echo "<pre>";print_r($attrName);
		              foreach($attrName as $name)
		              {
		              	  $resName[]=$name->attribute;
		                  $resNameId[]=$name->id;
		                  $combine=array_combine($resNameId,$resName);
		                  //echo "<pre>";print_r($resNameId);
		              }	
		         }
         }

         if(!empty($newAttrId))
         {          
           $this->render('priceview',array('view'=>$price,'attrName'=>$combine,'additionalValues'=>$resCombine));
         }
         else
         {
         	$this->render('priceview',array('view'=>$price));
         }	

     }

	//function for to view the details of price any company ends here
    
    //function for to delete the details for price Attribute

    public function actionPriceAttributeDelete($id)
    {
         
         $detail=ServicePrice::model()->with('additionalAttrs')->findByAttributes(array('id'=>$id));
         //echo "<pre>";print_r($detail);die;
         foreach($detail->additionalAttrs as $d)
         {
             $d->delete();
             //echo "<pre>";print_r($d);
         }//die;	
         $detail->delete();
    	 echo "success";

    }

    //function for to delete the details for price Attribute 


     // function to delete the added attribute starts here

     public function  actionAjaxAddedAttrDlt()
     {

     	$attrAddedId=$_REQUEST['val'];
     	//$attr=NewAttribute::model()->findByAttributes(array('id'=>$attrAddedId));

     	//echo "<pre>";print_r($attr);die;
     	$res=NewAttribute::model()->with('additionalAttrs')->findByAttributes(array('id'=>$attrAddedId));
        foreach($res->additionalAttrs as $r)
        {
            
            $r->delete();
        }	
       
        $res->delete();
        echo "succes"; 

        //echo "<pre>";print_r($res);die;
     }
     //function to delete the added attribute ends here

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
		ob_start();
		Yii::app()->theme='back';

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
        //ob_start();
		Yii::app()->theme='back';
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

	public function actionserviceTypeListing()
	{
         ob_start();
         Yii::app()->theme='back'; 
         $res=ServiceTypes::model()->findAll();
         //echo "<pre>";print_r($res);die;
         $this->render('servicetypelisting',array('list'=>$res));
	}

	public function actionAddserviceType()
	{
		 ob_start();
         Yii::app()->theme='back'; 
         $model=new ServiceTypes;
        // echo "<pre>";print_r($_REQUEST);die;
           if(isset($_POST['ServiceTypes']))
           {

                /*$path = Yii::app()->basePath . '/../uploads';
		        if (!is_dir($path)) {
		            mkdir($path);
		        }*/
                 // echo "<pre>";print_r($_REQUEST);die;
                  
                   $model->attributes=$_POST['ServiceTypes'];
                   $rnd = rand(0,9999);
                   $uploadedFile=CUploadedFile::getInstance($model,'image');
                   $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                   //$model->image = $fileName;
                    
                   //echo $fileName;die;

	             if($model->validate())
	             {
                 
	                 //echo "<pre>";print_r($_FILES);    
		             $date=date('Y-m-d');
		             $model->service_name=$_REQUEST['ServiceTypes']['service_name'];
		             $model->date=$date;
		             if(is_uploaded_file($_FILES['ServiceTypes']['tmp_name']['image']))
		             {
		             	
                         $model->image = $fileName;  
                      }
		             //echo Yii::app()->basePath . '/ServiceImages'.$fileName;die;
	                 if($model->save())
	                 {   
	                 	 if(is_uploaded_file($_FILES['ServiceTypes']['tmp_name']['image']))
		                 {
	                 	      $uploadedFile->saveAs(Yii::app()->basePath.'/../banner/'.$fileName);  
	                     } 

	                     $this->redirect('servicetypelisting');
	                 }	
	                 

                 }	
	             else
	             {
	             	 
	             	$errors=$model->getErrors();
	             	// var_dump($errors); 
	             }	

         }	
         
         $this->render('addservicetype',array('model'=>$model));
         
	}

	public function actionAjaxServiceTypeDelete()
	{
		//echo "<pre>";print_r($_REQUEST);die;
         $id=$_REQUEST['id'];
    	 //echo $id;die;
    	 $detail=ServiceTypes::model()->findByAttributes(array('id'=>$id));
    	 //echo "<pre>";print_r($detail);die;
    	 $detail->delete();
    	 echo "success";

	}

	public function actionServiceTypeView($id)
	{
         ob_start();
         Yii::app()->theme='back';
         $rec=ServiceTypes::model()->findByPk(array('id'=>$id));

         $this->render('servicetypeview',array('view'=>$rec));
          
	}
     
    //function to edit the details for service type starts here
    public function actionServiceTypeEdit($id)
    {
    	ob_start();
    	Yii::app()->theme='back';
        $model=new ServiceTypes;

    	$rec=ServiceTypes::model()->findByPk(array('id'=>$id));
        //echo "<pre>";print_r($rec);die;

        if(isset($_POST['ServiceTypes']))
        {
        	$model->attributes=$_POST['ServiceTypes'];
        	 
	         $rnd = rand(0,9999);
		     $uploadedFile=CUploadedFile::getInstance($model,'image');
		     $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
		     //echo $fileName;die;
             //echo "<pre>";print_r($_FILES);die;

        	if($model->validate())
        	{
        		    $rec=ServiceTypes::model()->findByPk(array('id'=>$id));
		            $service=$_REQUEST['ServiceTypes']['service_name'];
		            //$city=$_REQUEST['ServiceTypes']['city'];
		            $desc=$_REQUEST['ServiceTypes']['desc']; 
                    
                    

		            $rec->service_name=$service;
		            
		            $rec->desc=$desc;
		            if(is_uploaded_file($_FILES['ServiceTypes']['tmp_name']['image']))
		            {	
		            	
		                $rec->image = $fileName;
                    }
		            if($rec->save())
		            {     
		            	 if(is_uploaded_file($_FILES['ServiceTypes']['tmp_name']['image']))
		                 {
		            	     $uploadedFile->saveAs(Yii::app()->basePath.'/../banner/'.$fileName); 
		            	 }
                         
		            	 $this->redirect(array('servicetypelisting'));	
		            }	
              
        	}	
        	else
        	{
        		$errors=$model->getErrors();
        		var_dump($errors);
        	}	
        }	
    	
    	$this->render('servicetypedit',array('detail'=>$rec,'model'=>$model));

    }
    //function to edit the details for service type ends here
    
        // function to change the status for service type starts here
     
     public function actionajaxServiceTypeStatus()
     {
     	 //echo "<pre>";print_r($_REQUEST);die;
     	 $id=$_REQUEST['id'];
     	 $rec=ServiceTypes::model()->findByPk($id);
     	 $status=$rec->status;
         
         if($status==0)
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
      

    // function to change the status for service type ends here

     // function to change the status deactivate for service type starts here
      
      public function actionAjaxServiceTypeStatusDeactivate()
      {
         $id=$_REQUEST['id'];
     	 $rec=ServiceTypes::model()->findByPk($id);
     	 $status=$rec->status;
         
         if($status==1)
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



     // function to change the status deactive for service type ends here  







    public function actionWelcomeListing()
    {
    	ob_start();
    	Yii::app()->theme='back';
    	$rec=HomeWelcome::model()->findAll();
        //echo "<pre>";print_r($rec);die; 
    	$this->render('welcomelisting',array('list'=>$rec));
    }
    // function to show the listing for welcome module ends here
     
    // function to add the welcome content starts here 
    public function actionAddWelcomecontent()
    {
    	ob_start();
    	Yii::app()->theme='back';
    	$model=new HomeWelcome;
    	if(isset($_POST['HomeWelcome']))
    	{

            $model->attributes=$_POST['HomeWelcome'];
            $rnd = rand(0,9999);
		    $uploadedFile=CUploadedFile::getInstance($model,'image');
		    $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
            
            if($model->validate())
            {

            	$title=$_REQUEST['HomeWelcome']['title'];
            	$desc=$_REQUEST['HomeWelcome']['desc'];
            	$date=date('Y-m-d');
            	$model->date=$date;
            	if(is_uploaded_file($_FILES['HomeWelcome']['tmp_name']['image']))
	            {	
	            	
	                $model->image = $fileName;
                }
                if($model->save())
                {
                	if(is_uploaded_file($_FILES['HomeWelcome']['tmp_name']['image']))
	                 {
	            	     $uploadedFile->saveAs(Yii::app()->basePath.'/../banner/'.$fileName); 
	            	 }
	            	 $this->redirect(array('welcomelisting'));

                }	
                
            }
            else
            {
              $errors=$model->getErrors();

            }	

    	}	
    	$this->render('addwelcomecontent',array('model'=>$model));
    }
   // function to add the welcome content ends here

    // function to chnage the status of welcome content starts here

    public function actionAjaxWelcomeStatus()
    {

       $id=$_REQUEST['id'];
       $rec=HomeWelcome::model()->findByPk(array('id'=>$id));
       $status=$rec->status;
       if($status==0)
       {
       	   $rec->status=1;
       	   $rec->save();
       	  $res=HomeWelcome::model()->findAll("id <>".$id);
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
    // function to chnage the status of welcome content ends here

    // function to  deactivate the status of welcome content
    public function actionajaxWelcomeStatusDeactivate()
    {
    	$id=$_REQUEST['id'];
       $rec=HomeWelcome::model()->findByPk(array('id'=>$id));
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
    // function to deactivate the status of welcome content

    //function to delete the current welcome content starts here
      public function actionAjaxDeleteWelcome()
      {
          $id=$_REQUEST['id'];
    	 //echo $id;die;
    	 $detail=HomeWelcome::model()->findByAttributes(array('id'=>$id));
    	 //echo "<pre>";print_r($detail);die;
    	 $detail->delete();
    	 echo "success";
      }
     
    // function to delete the current welcome content ends here

    //function to edit the welcome content starts here
     
     public function actionWelcomeEdit($id)
     {
         ob_start();
         Yii::app()->theme='back';
         $model=new HomeWelcome;
         $rec=HomeWelcome::model()->findByPk(array('id'=>$id));
         
         if(isset($_POST['HomeWelcome']))
        {
           
        	 $model->attributes=$_POST['HomeWelcome'];
        	 
	         $rnd = rand(0,9999);
		     $uploadedFile=CUploadedFile::getInstance($model,'image');
		     $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
		     
             //echo "<pre>";print_r($_FILES);die;

        	if($model->validate())
        	{
        		    $res=HomeWelcome::model()->findByPk(array('id'=>$id));
		            $title=$_REQUEST['HomeWelcome']['title'];
		            $desc=$_REQUEST['HomeWelcome']['desc']; 
                    
		            $res->title=$title;
		            $res->desc=$desc;
		            
		            if(is_uploaded_file($_FILES['HomeWelcome']['tmp_name']['image']))
		            {	
		            	
		                $res->image = $fileName;
                    }
		            if($res->save())
		            {     
		            	 if(is_uploaded_file($_FILES['HomeWelcome']['tmp_name']['image']))
		                 {
		            	     $uploadedFile->saveAs(Yii::app()->basePath.'/../banner/'.$fileName); 
		            	 }
                         
		            	 $this->redirect(array('welcomelisting'));	
		            }	
              
        	}	
        	else
        	{
        		$errors=$model->getErrors();
        		//var_dump($errors);
        	}	
        } 



         $this->render('welcomeedit',array('edit'=>$rec,'model'=>$model));
     }

    // function to edit the welcome content ends here

     // function to view the details for welcome page starts here
     public function actionWelcomeView($id)
     {
     	ob_start();
     	Yii::app()->theme='back';
     	$rec=HomeWelcome::model()->findByPk($id);
     	$this->render('welcomeview',array('view'=>$rec));
     }
     // function to view the details for welcome page ends here

     //function to show the listing for why us starts here

     public function actionWhyListing()
     {
     	ob_start();
     	Yii::app()->theme='back';
     	$model=new WhyUsHome;
     	$rec=WhyUsHome::model()->findAll();


     	$this->render('whylisting',array('list'=>$rec,'model'=>$model));
     }
     //function to show the listing for why us ends here

     //function to add the why us content starts here

     public function actionAddWhyUsContent()
     {

     	ob_start();
     	Yii::app()->theme='back';
     	$model=new WhyUsHome;
        if(isset($_POST['WhyUsHome']))
    	{

            $model->attributes=$_POST['WhyUsHome'];
            $rnd = rand(0,9999);
		    $uploadedFile=CUploadedFile::getInstance($model,'image');
		    $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
            
            if($model->validate())
            {

            	$title=$_REQUEST['WhyUsHome']['title'];
            	$desc=$_REQUEST['WhyUsHome']['desc'];
            	$date=date('Y-m-d');
            	$model->date=$date;
            	if(is_uploaded_file($_FILES['WhyUsHome']['tmp_name']['image']))
	            {	
	            	
	                $model->image = $fileName;
                }
                if($model->save())
                {
                	if(is_uploaded_file($_FILES['WhyUsHome']['tmp_name']['image']))
	                 {
	            	     $uploadedFile->saveAs(Yii::app()->basePath.'/../banner/'.$fileName); 
	            	 }
	            	 $this->redirect(array('whylisting'));

                }	
                
            }
            else
            {
              $errors=$model->getErrors();

            }	

    	}

        $this->render('addwhyuscontent',array('model'=>$model)); 


     }
     // function to add the why us content ends here

     // function to delete the why us content satrts here
      
      public function actionAjaxDeleteWhy()
      {
      	  $id=$_REQUEST['id'];
    	 //echo $id;die;
    	 $detail=WhyUsHome::model()->findByAttributes(array('id'=>$id));
    	 //echo "<pre>";print_r($detail);die;
    	 $detail->delete();
    	 echo "success";

      }

     // function to delete the why us content ends here

      // function to edit the why content starts here

      public function actionWhyEdit($id)
      {

      	ob_start();
      	Yii::app()->theme='back';
        $model=new WhyUsHome; 
      	$rec=WhyUsHome::model()->findByPk($id);
      	
      	 if(isset($_POST['WhyUsHome']))
        {
           
        	 $model->attributes=$_POST['WhyUsHome'];
        	 
	         $rnd = rand(0,9999);
		     $uploadedFile=CUploadedFile::getInstance($model,'image');
		     $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
		     
             //echo "<pre>";print_r($_FILES);die;

        	if($model->validate())
        	{
        		    $res=WhyUsHome::model()->findByPk(array('id'=>$id));
		            $title=$_REQUEST['WhyUsHome']['title'];
		            $desc=$_REQUEST['WhyUsHome']['desc']; 
                    
		            $res->title=$title;
		            $res->desc=$desc;
		            
		            if(is_uploaded_file($_FILES['WhyUsHome']['tmp_name']['image']))
		            {	
		            	
		                $res->image = $fileName;
                    }
		            if($res->save())
		            {     
		            	 if(is_uploaded_file($_FILES['WhyUsHome']['tmp_name']['image']))
		                 {
		            	     $uploadedFile->saveAs(Yii::app()->basePath.'/../banner/'.$fileName); 
		            	 }
                         
		            	 $this->redirect(array('whylisting'));	
		            }	
              
        	}	
        	else
        	{
        		$errors=$model->getErrors();
        		//var_dump($errors);
        	}	
        } 





      	$this->render('whyedit',array('edit'=>$rec,'model'=>$model));

      }
      // function to edit the why content ends here

      // function to view the why content starts here

      public function actionWhyView($id)
      {
      	ob_start();
      	Yii::app()->theme='back';
      	$rec=WhyUsHome::model()->findByPk($id);
      	$this->render('whyview',array('view'=>$rec));
      }
      // function to view the why content ends here

      // function to change the status for active why us starts here

      public function actionAjaxWhyStatus()
      {
	       $id=$_REQUEST['id'];
	       $rec=WhyUsHome::model()->findByPk(array('id'=>$id));
	       $status=$rec->status;
	       if($status==0)
	       {
	       	   $rec->status=1;
	       	   $rec->save();
	       	  $res=WhyUsHome::model()->findAll("id <>".$id);
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
      // function to chnage the status for active why us ends here

      // function to chnage the status for deactive why us starts here
      public function actionAjaxWhyStatusDeactivate()
      {
	       $id=$_REQUEST['id'];
	       $rec=WhyUsHome::model()->findByPk(array('id'=>$id));
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
      // function to chnage the status for deactive why us ends her

       // function to list the all images starts here

      public function actionImageListing()
      {
      	 ob_start();
      	 Yii::app()->theme='back';
      	 $model=new HomeImages;
          
         $rec= HomeImages::model()->findAll(); 
      	 $this->render('imagelisting',array('model'=>$model,'list'=>$rec));
      } 
      // function to list the all images ends here

      // function to add image for home page starts here

      public function actionAddHomeImage()
      {
      	ob_start();
      	Yii::app()->theme='back';
      	$model=new HomeImages;
      	
        if(isset($_POST['HomeImages']))
    	{

            $model->attributes=$_POST['HomeImages'];
            $rnd = rand(0,9999);
		    $uploadedFile=CUploadedFile::getInstance($model,'image');
		    $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
            
            if(is_uploaded_file($_FILES['HomeImages']['tmp_name']['image']))
	        {

            	$url=$_REQUEST['HomeImages']['url'];
            	
            	$date=date('Y-m-d');
            	$model->date=$date;
            	$model->image = $fileName;
                
                if($model->save())
                {
                	
	            	 $uploadedFile->saveAs(Yii::app()->basePath.'/../HomeImages/'.$fileName); 
	            	
	            	 $this->redirect(array('imagelisting'));

                }	
                
            }
            else
            {
              //$errors=$model->getErrors();
               Yii::app()->user->setFlash('success', "Please Upload Image!"); 
            }	


    	} 



      	$this->render('addhomeimage',array('model'=>$model));
      }
      // function to add image for home page ends here

      // function to delete the home image starts here
      public function actionAjaxDeleteHomeImage()
      {
          $id=$_REQUEST['id'];
          $detail=HomeImages::model()->findByAttributes(array('id'=>$id));
          unlink(Yii::app()->basePath.'/../HomeImages/'. $detail->image);
    	 //echo "<pre>";print_r($detail);die;
    	 $detail->delete();
    	 echo "success";
      }
      // function to delete the home image ends here

      // function to view the home image starts here

      public function actionHomeImageView($id)
      {
      	ob_start();
      	Yii::app()->theme='back';

      	$rec=HomeImages::model()->findByPk($id);
      	//echo "<pre>";print_r($rec);die;
      	$this->render('homeimageview',array('view'=>$rec));

      }
      // function to view the home image ends here

      // function to edit the current image starts  here

       public function actionImage($id)
       {
          ob_start();
          Yii::app()->theme='back';
          $model=new HomeImages;
          //echo $id;die;
          $rec=HomeImages::model()->findByPk($id);
          if(isset($_POST['HomeImages']))
    	  {

            $model->attributes=$_POST['HomeImages'];
            $rnd = rand(0,9999);
		    $uploadedFile=CUploadedFile::getInstance($model,'image');
		    $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
            
            if(is_uploaded_file($_FILES['HomeImages']['tmp_name']['image']))
	        {

            	$url=$_REQUEST['HomeImages']['url'];
            	$res=HomeImages::model()->findByPk($id);
            	$date=date('Y-m-d');
            	$res->url=$url;  
            	$res->image = $fileName;
                
                if($res->save())
                {
                	
	            	 $uploadedFile->saveAs(Yii::app()->basePath.'/../HomeImages/'.$fileName); 
	            	
	            	 $this->redirect(array('imagelisting'));

                }	
                
            }
            else
            {
              //$errors=$model->getErrors();
               Yii::app()->user->setFlash('success', "Please Upload Image!"); 
            }	


    	} 


          $this->render('image',array('edit'=>$rec,'model'=>$model));
       }

      //function to edit the current image ends here

       // function to change the status for image to active starts here

       public function actionAjaxImageActive()
       {
       	 $id=$_REQUEST['id'];
       	 $rec=HomeImages::model()->findByPk($id);

         if($rec->status==0)
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
       // function to chnage the status for image to active ends here

       //function to change the status for image to deactivate

       public function actionAjaxImageDeactivate()
       {
	       	 $id=$_REQUEST['id'];
	       	 $rec=HomeImages::model()->findByPk($id);

	         if($rec->status==1)
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
       //function to change the status for image to deactivate ends her
       // function to list the htuse content starts here
       
       public function actionHTUselisting()
       {
       	 ob_start();
       	 Yii::app()->theme='back';
       	 $rec=HtuseHome::model()->findAll();
       	 $this->render('htuselisting',array('list'=>$rec));
       }


       // function to list the htuse content ends here

       // function to add the the how to use content starts here

       public function actionAddHtUseContent()
       {
          ob_start();
          Yii::app()->theme='back';
          $model=new HtuseHome;
          
          if(isset($_POST['HtuseHome']))
    	 {
            
	            $model->attributes=$_POST['HtuseHome'];
	            $rnd = rand(0,9999);
			    $uploadedFile=CUploadedFile::getInstance($model,'image');
			    $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
	            
	            if($model->validate())
	            {

	            	$title=$_REQUEST['HtuseHome']['title'];
	            	$desc=$_REQUEST['HtuseHome']['desc'];
	            	$date=date('Y-m-d');
	            	$model->date=$date;
	            	if(is_uploaded_file($_FILES['HtuseHome']['tmp_name']['image']))
		            {	
		            	
		                $model->image = $fileName;
	                }
	                if($model->save())
	                {
	                	if(is_uploaded_file($_FILES['HtuseHome']['tmp_name']['image']))
		                 {
		            	     $uploadedFile->saveAs(Yii::app()->basePath.'/../HowToUseImages/'.$fileName); 
		            	 }
		            	 $this->redirect(array('htuselisting'));

	                }	
	                
	            }
	            else
	            {
	              $errors=$model->getErrors();

	            }	

    	}




          $this->render('addhtusecontent',array('model'=>$model)); 
       
       }

       // function to add the how to use content ends here

       //function to delete how to use record starts here

       public function actionAjaxDeleteHtUse()
       {
       	     $id=$_REQUEST['id'];
	          $detail=HtuseHome::model()->findByAttributes(array('id'=>$id));
	         unlink(Yii::app()->basePath.'/../HowToUseImages/'. $detail->image);
	    	 //echo "<pre>";print_r($detail);die;
	    	 $detail->delete();
	    	 echo "success";
       }
       // function to delete how to use record ends here

       // function to edit the how to use record starts here

       public function actionHtEdit($id)
       {
       	     ob_start();
        	 Yii::app()->theme='back';
             $model=new HtuseHome;
             $rec=HtuseHome::model()->findByPk($id);
              if(isset($_POST['HtuseHome']))
            {
           
		        	 $model->attributes=$_POST['HtuseHome'];
		        	 
			         $rnd = rand(0,9999);
				     $uploadedFile=CUploadedFile::getInstance($model,'image');
				     $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
				     
		             //echo "<pre>";print_r($_FILES);die;

		        	if($model->validate())
		        	{
		        		    $res=HtuseHome::model()->findByPk(array('id'=>$id));
				            $title=$_REQUEST['HtuseHome']['title'];
				            $desc=$_REQUEST['HtuseHome']['desc']; 
		                    
				            $res->title=$title;
				            $res->desc=$desc;
				            
				            if(is_uploaded_file($_FILES['HtuseHome']['tmp_name']['image']))
				            {	
				            	
				                $res->image = $fileName;
		                    }
				            if($res->save())
				            {     
				            	 if(is_uploaded_file($_FILES['HtuseHome']['tmp_name']['image']))
				                 {
				            	     $uploadedFile->saveAs(Yii::app()->basePath.'/../HowToUseImages/'.$fileName); 
				            	 }
		                         
				            	 $this->redirect(array('htuselisting'));	
				            }	
		              
		        	}	
		        	else
		        	{
		        		$errors=$model->getErrors();
		        		//var_dump($errors);
		        	}	
           }
              
           $this->render('htedit',array('edit'=>$rec,'model'=>$model));

       }
       // function to edit the how to use record ends here


       // function to view the how to use starts here

       public function actionHtView($id)
       {
           ob_start();
           Yii::app()->theme='back';
           $rec=HtuseHome::model()->findByPk($id);

           $this->render('htview',array('view'=>$rec));

       }
       // function to view the how to use ends here


       // function to active the chnage the status starts here
       
        public function actionAjaxHtStatus()
        {
        	  $id=$_REQUEST['id'];
	       	 $rec=HtuseHome::model()->findByPk($id);

	         if($rec->status==0)
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

       // function to active the status ends here

        //function to deactivate the status starts here

        public function actionAjaxHTDeactivate()
        {
        	$id=$_REQUEST['id'];
	       	 $rec=HtuseHome::model()->findByPk($id);

	         if($rec->status==1)
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
        // function to deactivate the status ends here
        // function to show thw listing for faq content

       public function actionFaqListing()
       {
           ob_start();
           Yii::app()->theme='back';
           $model=new Faq;
           $rec=Faq::model()->findAll();
           $this->render('faqlisting',array('model'=>$model,'list'=>$rec));

       }
       // function to show the faq listing ends here

       // function to add the faq content starts here
        
        public function actionAddFaq()
        {

        	ob_start();
        	Yii::app()->theme='back';
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

         	ob_start();
         	Yii::app()->theme='back';
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
      	ob_start();
      	Yii::app()->theme='back';
      	$rec=Faq::model()->findByPk($id);

      	$this->render('faqview',array('view'=>$rec));
      }

      // function to view the detail for faq ends here	 


    	// function to list the additional services added by admin starts here

    	 public function actionAdditionalListing()
    	 {
    	 	ob_start();
    	 	Yii::app()->theme='back';
            
            $rec=AdditionalServices::model()->findAll();
    	 	$this->render('additionallisting',array('list'=>$rec));
    	 }
    	// function to list the additional services added by admin ends here

    	 //function to add additional service starts here
    	 public function actionAdditionalService()
    	 {
    	 	ob_start();
    	 	Yii::app()->theme='back';
    	 	$model=new AdditionalServices;

    	 	if(isset($_POST['AdditionalServices']))
    	 	{
    	 		$model->attributes=$_POST['AdditionalServices'];
    	 		if($model->validate())
    	 		{
                   $date=date('Y-m-d');
                   $model->date=$date;
                   if($model->save())
                   {
                      $this->redirect(array('additionallisting'));
                   } 
    	 		}	
    	 		else
    	 		{
    	 			$errors=$model->getErrors();
    	 		}
    	 	}	

    	 	$this->render('additionalservice',array('model'=>$model));
    	 }
    	 //function to add additional service ends here


    	 //function to delete the additional service starts here

    	 public function actionAjaxDeleteAdditionalService()
    	 {
                 $id=$_REQUEST['id'];
		          $detail=AdditionalServices::model()->findByAttributes(array('id'=>$id));
		          
		    	 $detail->delete();
		    	 echo "success";
    	 }
    	 //function to delete the additional service ends here

    	 //function to edit the detail for additional service starts here

          public function actionAdditionalServicEdit($id)
          {
              ob_start();
              Yii::app()->theme='back';
              $model=new AdditionalServices;
              $rec=AdditionalServices::model()->findByPk($id);
              
              if(isset($_POST['AdditionalServices']))
              {

              	   $model->attributes=$_POST['AdditionalServices'];
              	   if($model->validate())
              	   {
                       $res=AdditionalServices::model()->findByPk($id);
                       $name=$_REQUEST['AdditionalServices']['service_name'];
                       $res->service_name=$name;
                       if($res->save())
                       {
                       	 $this->redirect(array('additionallisting'));
                       }

              	   }
              	   else
              	   {
              	   	  $errors=$model->getErrors();
              	   	  //var_dump($errors);

              	   }	
              }	


              $this->render('additionalservicedit',array('edit'=>$rec,'model'=>$model));
          }

    	 // function to edit the detail for additional service ends here 

          //function to view the detail for additional service starts here

          public function actionAdditionalView($id)
          {
              ob_start();
              Yii::app()->theme='back';
              $rec=AdditionalServices::model()->findByPk($id);
              //echo "<pre>";print_r($rec);die;
              $this->render('additionalview',array('view'=>$rec));
          }
          //function to view the details for additional service ends here

          // function to change the status for for added service starts here
           public function actionAjaxAdditionalStatus()
           {
           	     $id=$_REQUEST['id'];
		       	 $rec=AdditionalServices::model()->findByPk($id);

		         if($rec->status==0)
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

          // function to chnage the status for added service ends here 

           // function to chnage the status deactivate the service starts here
           
            public function actionAjaxAdditionalDeactivate()
            {
            	 $id=$_REQUEST['id'];
		       	 $rec=AdditionalServices::model()->findByPk($id);

		         if($rec->status==1)
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

           // function to chnage the status deactivate the service ends here

}