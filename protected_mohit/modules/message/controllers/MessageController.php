<?php

class MessageController extends Controller
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
   
	public function actionMessageListing()
	{
		$model=new ConversationMsg;

		$rec=ConversationMsg::model()->findAll();

		$this->render('messagelisting',array('model'=>$model,'list'=>$rec));
	}

	// function to dreate a message starts here

	public function actionCreateMessage()
	{
		 $msg=new MsgDetails;
		 $model=new ConversationMsg;

		 if(isset($_POST['ConversationMsg']) && isset($_POST['MsgDetails']))
		 {
                  $model->attributes=$_POST['ConversationMsg'];
                  $msg->attributes=$_POST['MsgDetails'];
                  if($model->validate() || $msg->validate())
                  {
                      $btn=$_REQUEST['btn'];
                      
                      if($btn =='company')
                      {
 		                      	  //echo "<pre>";print_r($_REQUEST); die;  
							      $email=$_REQUEST['ConversationMsg']['reciver_id'];
							      //echo $email;
							      
                                  $email=ltrim($email);
                                  $email=rtrim($email);
                                                                 
							      $rec=ServiceUser::model()->findByAttributes(array('email'=>$email));
							      
							      //echo "fsfsf"."<pre>";print_r($rec);die;
							      
							      $companyRecvierId=$rec->id;
							      //echo $companyRecvierId;die;
                                  $sender_id= Yii::app()->session['username'];
                                  
                                  $date=date('Y-m-d'); 
                                  
                                  $model->date=$date;  
                                  $model->sender_id=$sender_id;
                                  $model->sender_type='admin';
                                  $model->reciver_id=$companyRecvierId;
                                  $model->reciver_type='company';
                                  
                                  $model->save(false);
                                  
                                  $conversationId = Yii::app()->db->getLastInsertID();
                                 
                                  $convMsg=ConversationMsg::model()->findByPk(array('id'=>$conversationId));
                                   //echo "<pre>";print_r($rec);die;

                                  $text=$_REQUEST['MsgDetails']['msg'];

                                  $msg->conversation_id=$conversationId;
                                  $msg->user_type='admin';
                                  $msg->msg=$text;
                                  $msg->tomsg=$convMsg['reciver_id'];
                                  $date=date('Y-m-d'); 
                                  $msg->date=$date;

                                  if($msg->save(false))
                                  {
                                  	$this->redirect(array('messagelisting'));
                                  }	

                      }	
                      else
                      {
                      	         $email=$_REQUEST['ConversationMsg']['reciver_id'];
							      //echo $email;die;
							      
                                  $email=ltrim($email);
                                  $email=rtrim($email);

                                  $rec=CustomerUser::model()->findByAttributes(array('email'=>$email));
							      
							      //echo "fsfsf"."<pre>";print_r($rec);die;
							      
							      $companyRecvierId=$rec->id;
							      //echo $companyRecvierId;die;
                                  $sender_id= Yii::app()->session['username'];
                                 // echo $sender_id;die;
                                  $date=date('Y-m-d'); 
                                  
                                  $model->date=$date;  
                                  $model->sender_id=$sender_id;
                                  $model->sender_type='admin';
                                  $model->reciver_id=$companyRecvierId;
                                  $model->reciver_type='company';
                                  
                                  $model->save(false);
                                  
                                  $conversationId = Yii::app()->db->getLastInsertID();
                                   
                                  $convMsg=ConversationMsg::model()->findByPk(array('id'=>$conversationId));
                                   
                                   

                                  $text=$_REQUEST['MsgDetails']['msg'];

                                  $msg->conversation_id=$conversationId;
                                  $msg->user_type='admin';
                                  $msg->msg=$text;
                                  $msg->tomsg=$convMsg['reciver_id'];
                                  $date=date('Y-m-d'); 
                                  $msg->date=$date;

                                  if($msg->save(false))
                                  {
                                  	$this->redirect(array('messagelisting'));
                                  }	
                      }          
                      

                  }	
                  else
                  {
                  	 $errors=$model->getErrors();
                  	 //var_dump($errors);
                  	 $err=$msg->getErrors();
                  	 //var_dump($err);
                  }	
		 }	

		 $this->render('createmessage',array('model'=>$model,'msg'=>$msg));
	}

	// function to show all the messages starts here

	public function actionAllMessages($id)
	{

		$rec=MsgDetails::model()->findAll(array('condition'=>'conversation_id=:id','params'=>array(

                                       ':id'=>$id,               
			             )	));
		//echo "<pre>";print_r($rec);die;
        foreach($rec as $r)
        {
        	if($r->user_type!='admin')
        	{
        	     $user_type[]=$r->user_type; 
        	}	
        }	
        
        

		$this->render('allmessages',array('list'=>$rec));
	}

	// delete message starts here
	public function actionDeleteMsg()
	{
		$id=$_REQUEST['id'];
		$rec=MsgDetails::model()->findByPk($id);
        $conversationId=$rec->conversation_id;

        $detail=MsgDetails::model()->findAll(array('condition'=>'conversation_id=:id','params'=>array(

                                      ':id'=>$conversationId, 

        	                )

        	));
       
       foreach($detail as $d)
       {
       	   if(count($d)>1)
       	   {
               $rec->delete();
       	   }
       	   else
       	   {
       	   	 $rec->delete();
       	   	 $rec->conversation->delete();
       	   }	
       } 
		//$rec->delete();
		echo "success";die;
	}

	// function to delete all the converstion

	public function actionAllDltConversation()
	{
		 $id=$_REQUEST['id'];

		$detail=ConversationMsg::model()->with('msgDetails')->findByPk(array('id'=>$id));
		//echo "<pre>";print_r($detail);die;
		
       	foreach($detail->msgDetails as $d)
		{
           if(!empty($d))
           {	
               $d->delete();
           }
		}	//die;
         $detail->delete();

		echo "success";die;

	}
}
