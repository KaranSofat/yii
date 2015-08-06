<?php

class CustomerController extends Controller
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
				'actions'=>array('customerlisting','logout','login','customerview','export','replyfromAdminToCustomer'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionCustomerListing()
	{
		$model=new CustomerUser;
		$rec=CustomerUser::model()->findAll();
		//echo "<pre>";print_r($rec);die;
		$this->render('customerlisting',array('list'=>$rec));
	}
    
    // function to replyfromAdminToCustomer starts here
    
    public function actionReplyFromAdminToCustomer()
    {
          //echo "<pre>";print_r($_REQUEST);die;
           $model       = new ConversationMsg;
           $msg         =new MsgDetails; 
          
          //$senderId       =$_REQUEST['loggedId'];
          $reciverId      =$_REQUEST['receiverId'];
          $subject        =$_REQUEST['subject'];
          $text           =$_REQUEST['text'];
          $conversationID =$_REQUEST['conversionId'];
         
          //$bookingId     =$_REQUEST['replysectionBookingId'];
       //echo "<pre>";print_r($_REQUEST);die;
          if(!empty($_REQUEST))
          {
                          
             
             $msg->conversation_id   =$conversationID;
             $msg->user_type         ='admin';
             $msg->msg               =$text;
             $msg->user_id           =0;
             $msg->tomsg             =$reciverId;
             $msg->logged_id         =$loggedId;
             //$date                   =date('Y-m-d'); 
             //$msg->date              =$date;
             $msg->booking_id        =0;
             $msg->save(false);
             $msgConverLastId        = Yii::app()->db->getLastInsertID();
             $re=MsgDetails::model()->findByPk(array('id'=>$msgConverLastId));
             
            
             echo "<div class='name'>";
             echo 'admin';
             echo "</div>";
             
             echo "<div class='leftMsg appendmsg".$re['id']."'>"; 
             echo "<div class='time'>";
             
                  echo date('jS \of F Y  H:i:s',strtotime($re['date']));
             echo "</div>";
             echo $re['msg'];
            
             echo "</div> ";
              
             

             //echo "success";die;

          } 
    }

	// function to view the detail for customer 

	public function actionCustomerView($id)
	{

		$rec       =CustomerUser::model()->with('bookings')->findByPk($id);
		
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
		//echo "<pre>";print_r($inboxDtal);die;
		// echo "<pre>";print_r($rec['bookings']);die;
        $this->render('customerview',array('detail'=>$rec,'inbox'=>$msgDetails,'inboxDtal'=>$inboxDtal));
	}

	/*code to export all the details for payment users*/
	public function actionExport()
	{
       
       $re= CustomerUser::model()->findAll();
       //echo "<pre>";print_r($re);die;
       foreach($re as $res)
       {
       	  
           $name=$res['cname']." ".$res['clname'];
           $email   =$res['email'];
           $country    =$res['country'];
           $phone   =$res['phone'];
           $zip     =$res['zipcode'];
           
           
           $customer[]=array('Name'=>$name,'Email Address'=>$email,'Country'=>$country,'Phone'=>$phone,'Zip'=>$zip);

           

       } //die;	//echo "<pre>";print_r($val);die;
        
        $filename="customer.csv";
        $csv = new ECSVExport($customer);
		$content = $csv->toCSV();   


		                
		Yii::app()->getRequest()->sendFile($filename, $content, "text/csv", false);
		exit();
	 
           

	}

}