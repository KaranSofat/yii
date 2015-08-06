<?php

class PriceadminController extends Controller
{
	/*public function actionIndex()
	{
		$this->render('index');
	}*/

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
        'actions'=>array('pricelisting','logout','login','addprice','priceEdit','priceview','delete','AjaxServiceTypeFieldName'),
        'users'=>array('@'),
      ),
      array('deny',  // deny all users
        'users'=>array('*'),
      ),
    );
  } 

    // function to get the listing for price starts here
	public function actionPriceListing()
	{
        //$model=new PriceAdmin;

		$rec=PriceAdmin::model()->findAll();

		//echo "<pre>";prnt_r($rec);die;

		$this->render('pricelisting',array('Plist'=>$rec));
	}


	//function to add the price module starts here

    public function actionAddPrice()
    {
    	$model=new PriceAdmin;
         
        $res=ServiceTypes::model()->findAll();
        $userS=ServiceUser::model()->findAll();


    	if(isset($_POST['PriceAdmin']))
    	{
			$model->attributes=$_POST['PriceAdmin'];
			//echo "<pre>";print_r($_REQUEST);die; 
    		if($model->validate())
    		{
				//echo "<pre>";print_r($_REQUEST);die; 
               	if(!empty($_REQUEST['PriceAdmin']['recid']))
               	{
               	  	$id=$_REQUEST['PriceAdmin']['recid'];
               	  	$findRec=PriceAdmin::model()->findByPk($id);

                   	$findRec->id=$_REQUEST['PriceAdmin']['recid'];
                   
                   	$findRec->bedroom = $_REQUEST['PriceAdmin']['bedroom'];
					$findRec->bathroom = $_REQUEST['PriceAdmin']['bathroom'];
					$findRec->property = $_REQUEST['PriceAdmin']['property'];
					$findRec->desk = $_REQUEST['PriceAdmin']['desk'];
					$findRec->living_room = $_REQUEST['PriceAdmin']['living_room'];
					$findRec->kitchen_staircases = $_REQUEST['PriceAdmin']['kitchen_staircases'];   
					$findRec->carpets_interior_windows = $_REQUEST['PriceAdmin']['carpets_interior_windows'];
					$findRec->cupboards = $_REQUEST['PriceAdmin']['cupboards'];
					$findRec->kitchen = $_REQUEST['PriceAdmin']['kitchen'];
					$findRec->staircases = $_REQUEST['PriceAdmin']['staircases'];
					$findRec->elevator = $_REQUEST['PriceAdmin']['elevator'];
					$findRec->cleaning_material_price = $_REQUEST['PriceAdmin']['cleaning_material_price'];
                   
                   	$findRec->bedroom_hr = $_REQUEST['PriceAdmin']['bedroom_hr'];
					$findRec->bathroom_hr = $_REQUEST['PriceAdmin']['bathroom_hr'];
					$findRec->property_hr = $_REQUEST['PriceAdmin']['property_hr'];
					$findRec->desk_hr = $_REQUEST['PriceAdmin']['desk_hr'];
					$findRec->living_room_hr = $_REQUEST['PriceAdmin']['living_room_hr'];
					$findRec->kitchen_staircases_hr = $_REQUEST['PriceAdmin']['kitchen_staircases_hr'];   
					$findRec->carpets_interior_windows_hr = $_REQUEST['PriceAdmin']['carpets_interior_windows_hr'];
					$findRec->cupboards_hr = $_REQUEST['PriceAdmin']['cupboards_hr'];
					$findRec->kitchen_hr = $_REQUEST['PriceAdmin']['kitchen_hr'];
					$findRec->staircases_hr = $_REQUEST['PriceAdmin']['staircases_hr'];
					$findRec->elevator_hr = $_REQUEST['PriceAdmin']['elevator_hr'];
					$findRec->cleaning_material_price_hr = $_REQUEST['PriceAdmin']['cleaning_material_price_hr'];
                     

                   	if($findRec->save(false))
                   	{
               	  		$this->redirect(array('pricelisting'));
                   	}	

               	}

  			    $date=date('Y-m-d');
  			    $model->date=$date;
  			    
                if($model->save())
                {
                	 $this->redirect(array('pricelisting'));
                }    
    		}	
    		else
    		{
    			$errors=$model->getErrors();

    		}	
    	}	

    	$this->render('addprice',array('model'=>$model,'serType'=>$res,'user'=>$userS));
    }

    // function to delete the price detail for company here 

    public function actionDelete()
    {
    	$id=$_REQUEST['id'];
    	$rec=PriceAdmin::model()->findByPk($id);
    	$rec->delete();
    	echo "success";

    }
    
    //get the value on the basis of servicetype newly added field name
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

  // function to edit the price detail from admin

   public function actionPriceEdit($id)
   {
       $model=new PriceAdmin;  
       $rec=PriceAdmin::model()->findByPk($id);

       if(isset($_POST['PriceAdmin']))
       {
             $model->attributes=$_POST['PriceAdmin'];
             if($model->validate())
             {
                $res=PriceAdmin::model()->findByPk($id);
                
                $res->bedroom=$_REQUEST['PriceAdmin']['bedroom'];
                $res->bathroom=$_REQUEST['PriceAdmin']['bathroom'];
                $res->cleaning_material_price=$_REQUEST['PriceAdmin']['cleaning_material_price'];
                
                $res->living_room              =$_REQUEST['PriceAdmin']['living_room'];
                $res->kitchen_staircases       =$_REQUEST['PriceAdmin']['kitchen_staircases'];
                $res->carpets_interior_windows =$_REQUEST['PriceAdmin']['carpets_interior_windows']; 

                if(!empty($_REQUEST['PriceAdmin']['property']) || !empty($_REQUEST['PriceAdmin']['desk']))
                {
                  $res->property=$_REQUEST['PriceAdmin']['property'];
                  $res->desk=$_REQUEST['PriceAdmin']['desk'];

                  $res->cupboards    =$_REQUEST['PriceAdmin']['cupboards'];
                  $res->kitchen      =$_REQUEST['PriceAdmin']['kitchen'];
                  $res->staircases   =$_REQUEST['PriceAdmin']['staircases'];
                  $res->elevator     =$_REQUEST['PriceAdmin']['elevator'];
                
                } 

                if($res->save(false))
                {
                    $this->redirect(array('pricelisting'));
                }  

             }
             else
             {
               $errors=$model->getErrors();
             }
       }
          


       $this->render('priceEdit',array('model'=>$model,'edit'=>$rec));
       }

       //function to view the detail for added price

       public function actionPriceView($id)
       {
            $rec=PriceAdmin::model()->findByPk($id);


            $this->render('priceview',array('view'=>$rec));
       }
   
}
