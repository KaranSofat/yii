<?php

class FrontController extends Controller
{

/*public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
public function accessRules()
	{
		return array(
			array('allow',  // allow all users to access 'index' and 'view' actions.
				'actions'=>array('index','questions'),
				'users'=>array('*'),
				
					
			),
			array('allow', // allow authenticated users to access all actions
				'actions'=>array('dashboard','logout','login'),
					
				'users'=>array('@'),
				
			),
			array('deny',  
				'users'=>array('*'),
			
			
			),
		);
	}
    */
	public function actionIndex()
	{
	
	  
		$this->render('index');
	}

  public function actionLogin()
	{
	 
	    $model = new Users();
          
      if(isset($_POST['username']))
      {
       
           $username = $_REQUEST['username'];
        
         // echo $username;die;
        
            $rec= Users::model()->findByAttributes(array('email'=>$username));
          //  echo $rec;die;
           
           
            if($rec) 
            {       
       
                 Yii::app()->session['userId']=$rec->id;
                 $this->redirect('questions');
            }
            else
            {
                
              $this->render('index');
           
            }     
         
      }  
	 
	
	
	}

       public function actionDashboard()
         {
           $this->render('dashboard');
         
         }

         public function actionAskQuestion()
         {
           $model = new Questions;
            if(isset($_POST['title']))
            {
                $model->title = $_REQUEST['title'];
                  $model->question = $_REQUEST['question'];
                   $model->user_id = Yii::app()->session['userId'];
      
                if($model->save(false))
	              {
	                 $id = Yii::app()->db->getLastInsertID();
	                 
	                 
	                 
	            $this->redirect(array('front/questionDetail/'.$id.''));
	                 
	                 
	               }
         
          } 
             $this->render('askQuestion');
         
         }
            public function actionQuestions()
            {
              $model = new Questions();
	            //$questions = Users::model()->findAll();
	            
	           ;
	            
	            
	           
	            
	            $questions = Yii::app()->db->createCommand()
            ->select(' * ,count(u.id) as totalAnswers,question')
            ->from('comments u')
            ->join('questions p', 'u.question_id=p.id')
              ->join('users us', 'us.id=p.user_id')
            ->group('p.question')
           // ->where('id=:id', array(':id'=>$id))
            ->queryAll();
	            
	            
	          //echo"<pre>";print_r($questions);die;
	            
	            $this->render('questions',array('questions'=>$questions));
              
            }
            public function actionQuestionDetail($id)
	          { 
	       
	       //   echo $id;
	          $model = new Questions;
	          // $questionDetail= Questions::model()->findByAttributes(array('id'=>$id));
             $questionDetail = Yii::app()->db->createCommand()
            ->select('*')
            ->from('questions u')
           ->join('users p', 'p.id=u.user_id')
            ->where('u.id=:id', array(':id'=>$id))
            ->queryAll();
          	
          	//echo "<pre>";print_r($questionDetail);die;
          	
	           $answers = Yii::app()->db->createCommand()
            ->select('*')
            ->from('comments u')
            ->join('users p', 'p.id=u.user_id')
            ->where('u.question_id=:id', array(':id'=>$id))
            // ->where('u.answer=:answer', array(':answer'=>$_POST['value']))
            ->queryAll();  
          	
          	  $votesLike = Yii::app()->db->createCommand()
            ->select('count(id) as totalLike')
            ->from('votes u')
            ->where('u.question_id=:id', array(':id'=>$id))
             ->andwhere('u.status=1')
            ->queryAll();
          	
          	$like = $votesLike[0]['totalLike'];
          
          	
          	 $votesDislike = Yii::app()->db->createCommand()
            ->select('count(id) as totalDislike')
            ->from('votes u')
            ->where('u.question_id=:id', array(':id'=>$id))
             ->andwhere('u.status=0')
            ->queryAll();
            
          		$dislike = $votesDislike[0]['totalDislike'];
          	
          	//echo"<pre>";print_r($votesDislike);die;
          	
          //	echo"<pre>";print_r($questions);die;
          	
          	$this->render('questionDetail',array('questionDetail'=>$questionDetail,'answers'=>$answers,'like'=>$like,'dislike'=>$dislike));
	      
	      }

        public function actionAnswer()
	      {
	        $model = new Comments(); 
	        
	        
	         
	        $model->answer = $_POST['value'];
	        $model->question_id = $_POST['qId'];
	         $model->user_id =  Yii::app()->session['userId'];
	        
	            if($model->save(false))
	              {
	              // echo "success";
	              }
   
	           $questionDetail = Yii::app()->db->createCommand()
            ->select('*')
            ->from('comments u')
            ->join('users p', 'p.id=u.user_id')
            ->where('u.question_id=:id', array(':id'=>$_POST['qId']))
            // ->where('u.answer=:answer', array(':answer'=>$_POST['value']))
            ->queryAll();   
	           
	           
	           
	           
	           $html = '';
	            
	           // echo"<pre>";print_r($questionDetail);die;
	            
	              
	           foreach($questionDetail as $questionDetail)
	           {
	              
	              $html.='<div class="well">
									<address>
									'.$questionDetail['answer'].'
									 </address>
									<address>
									<strong>'.$questionDetail['name'].'</strong><br>
									<a href="mailto:#">
									'.$questionDetail['creation_Datetime'].' </a>
									</address>
								</div>';
	              
	              
	              
	            
	           
	           } 
	           
	           echo $html;
	           
	      } 

        public function actionVotes()
        {
        
        if($_POST['voteType'] == 'like')
        {
          $model = new Votes();  
	        $model->question_id = $_POST['qId'];
	        $model->user_id = $_POST['id'];
	        $model->voter_id = Yii::app()->session['userId'];
	        if($_POST['id'] ==  Yii::app()->session['userId'])
	        {
	        
	        echo"You cannot vote Your own question";die;
	        }
	        
	         $rec= Votes::model()->findByAttributes(array('voter_id'=> Yii::app()->session['userId']));
	         
	         if($rec)
	         {
	         
	         echo "You already vote this question";die;
	         }
	        
	          
	        if(Yii::app()->session['userId'] == "")
	        {
	         echo"You must have login to vote the question";die;
	        
	        }
	         $model->status = 1;
	        
	            if($model->save(false))
	              {
	            
	              }
        
        }
        
        else{
          $rec= Votes::model()->findByAttributes(array('voter_id'=> Yii::app()->session['userId']));
           
	         if($rec)
	         {
	         
	         echo "You already vote this question";die;
	         }
        
         if($_POST['id'] ==  Yii::app()->session['userId'])
	        {
	        
	        echo"You cannot vote Your own question";die;
	        }
	        
	        if(Yii::app()->session['userId'] == "")
	        {
	         echo"You must have login to vote the question";die;
	        
	        }
        
        $model = new Votes();  
	        $model->question_id = $_POST['qId'];
	        $model->user_id = $_POST['id'];
	         $model->status = 0;
	        
	            if($model->save(false))
	              {
	             // echo "dislike";
	              }
           
       
        }
     
        
     
       }


        public function actionReputation()
        {
           $repo = Yii::app()->db->createCommand()
            ->select('count(u.id) as totalRepo')
            ->from('votes u')
           // ->join('users p', 'p.id=u.user_id')
            ->where('u.user_id=:id', array(':id'=> Yii::app()->session['userId']))
            ->andwhere('u.status=:statuss', array(':statuss'=>1))
            ->queryAll(); 
          
          $repoDown = Yii::app()->db->createCommand()
            ->select('count(u.id) as totalDownrepo')
            ->from('votes u')
           // ->join('users p', 'p.id=u.user_id')
            ->where('u.user_id=:id', array(':id'=> Yii::app()->session['userId']))
            ->andwhere('u.status=:statuss', array(':statuss'=>0))
            ->queryAll(); 
          
          
          $repoMinus = 5 * $repoDown[0]['totalDownrepo'];
          
          $repoPlus = 10 * $repo[0]['totalRepo'];
          
          $totalRepo = $repoPlus - $repoMinus;
          
          
      echo $totalRepo;
        
        
        }

      public function actionLogout()
      {
      
      Yii::app()->session->clear();
      $this->render('index');
      }

        public function actionBuy(){
               
		// set 
		$paymentInfo['Order']['theTotal'] = 100.00;
		$paymentInfo['Order']['description'] = "Some payment description here";
		$paymentInfo['Order']['quantity'] = '1';

		// call paypal 
		$result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo); 
		//Detect Errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			echo $error;
			Yii::app()->end();
			
		}else { 
			// send user to paypal 
			$token = urldecode($result["TOKEN"]); 
			
			$payPalURL = Yii::app()->Paypal->paypalUrl.$token; 
			$this->redirect($payPalURL); 
		}
	}

	public function actionConfirm()
	{
	
	
	
		$token = trim($_GET['token']);
		$payerId = trim($_GET['PayerID']);
		
		
		
		$result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);

		$result['PAYERID'] = $payerId; 
		$result['TOKEN'] = $token; 
		$result['ORDERTOTAL'] = 100.00;

		//Detect errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			echo $error;
			Yii::app()->end();
		}else{ 
			
			$paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);
			//Detect errors  
			if(!Yii::app()->Paypal->isCallSucceeded($paymentResult)){
				if(Yii::app()->Paypal->apiLive === true){
					//Live mode basic error message
					$error = 'We were unable to process your request. Please try again later';
				}else{
					//Sandbox output the actual error message to dive in.
					$error = $paymentResult['L_LONGMESSAGE0'];
				}
				echo $error;
				Yii::app()->end();
			}else{
				//payment was completed successfully
				
				$this->render('confirm');
			}
			
		}
	}
        
    public function actionCancel()
	{
		//The token of the cancelled payment typically used to cancel the payment within your application
		$token = $_GET['token'];
		
		$this->render('cancel');
	}
	
	public function actionDirectPayment(){ 
		$paymentInfo = array('Member'=> 
			array( 
				'first_name'=>'name_here', 
				'last_name'=>'lastName_here', 
				'billing_address'=>'address_here', 
				'billing_address2'=>'address2_here', 
				'billing_country'=>'country_here', 
				'billing_city'=>'city_here', 
				'billing_state'=>'state_here', 
				'billing_zip'=>'zip_here' 
			), 
			'CreditCard'=> 
			array( 
				'card_number'=>'number_here', 
				'expiration_month'=>'month_here', 
				'expiration_year'=>'year_here', 
				'cv_code'=>'code_here' 
			), 
			'Order'=> 
			array('theTotal'=>1.00) 
		); 

	   /* 
		* On Success, $result contains [AMT] [CURRENCYCODE] [AVSCODE] [CVV2MATCH]  
		* [TRANSACTIONID] [TIMESTAMP] [CORRELATIONID] [ACK] [VERSION] [BUILD] 
		*  
		* On Fail, $ result contains [AMT] [CURRENCYCODE] [TIMESTAMP] [CORRELATIONID]  
		* [ACK] [VERSION] [BUILD] [L_ERRORCODE0] [L_SHORTMESSAGE0] [L_LONGMESSAGE0]  
		* [L_SEVERITYCODE0]  
		*/ 
	  
		$result = Yii::app()->Paypal->DoDirectPayment($paymentInfo); 
		
		//Detect Errors 
		if(!Yii::app()->Paypal->isCallSucceeded($result)){ 
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			echo $error;
			
		}else { 
			//Payment was completed successfully, do the rest of your stuff
		}

		Yii::app()->end();
	} 










}
