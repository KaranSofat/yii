<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	public $email,$usertype;
	const STATUS_NOT_ACTIVE = 'S0';
	public function __construct($email,$password,$usertype){
	    parent::__construct($email,$password,$usertype);
        $this->usertype =$usertype;
	}
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		/*$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);*/
		$users=array();
		if($this->usertype=="registration"){
			


			      if($_POST['LoginForm']['logintype']=='company')
			      {
			      	 //echo "fsfs"; 
			      	 //echo "<pre>";print_r($this->username);die;
			           $users= Login::model()->findByAttributes(array('email'=>$this->username),'status=:status',array(':status'=>1));
                       // Yii::app()->session['loggedId'] =$users->id; 
                       //echo "<pre>";print_r($users);
				       $users=$users->attributes;
				       //echo "<pre>";print_r($users);die;
			      }
			      else
			      {
                       //echo "Mohit";die;
                       $users= CustomerLogin::model()->findByAttributes(array('email'=>$this->username));
                       //Yii::app()->session['loggedId'] =$users->id; 
                       //echo "fsfsf"."<pre>";print_r($users);die; 
				       $users=$users->attributes; 
                       /*
				       if(empty($users))
							$this->errorCode=self::ERROR_USERNAME_INVALID;
						elseif(!empty($users->password) && $users->password!==md5($this->password))

							$this->errorCode=self::ERROR_PASSWORD_INVALID;
						elseif(!empty($users->status) && $users->status !==1)
						    $this->errorCode=self::STATUS_NOT_ACTIVE; 
						else{
							

							$this->_id = $users->id;
							$this->errorCode=self::ERROR_NONE;
						}
						return !$this->errorCode;
                         */
						
			      }	
			
				   
		   //echo "<pre>";print_r($users['password']);die;
		}
		else 
		{
			//echo "fsfs"; 
			//echo "<pre>";print_r($_REQUEST);die;
			$uName=$_POST['LoginForm']['username'];
			$uPass=md5($_POST['LoginForm']['password']);
			$users= Admin::model()->findByAttributes(array('username'=>$this->username));

			if(empty($users))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
			elseif(!empty($users['password']) && $users['password']!==md5($this->password))

				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			elseif(!empty($users['status']) && $users['status'] !=1)
			    $this->errorCode=self::STATUS_NOT_ACTIVE; 
			else{
				
                  
				$this->_id = $users->id;
				$this->errorCode=self::ERROR_NONE;
			}

			return !$this->errorCode;

		}	
        
        
        //echo $users['password'];die;
        // code for company 
		if(empty($users))
		  
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif(!empty($users->password) && $users->password !==md5($this->password))
              
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		elseif(!empty($users->status) && $users->status !==1)
		  
		    $this->errorCode=self::STATUS_NOT_ACTIVE; 
		else{
			
            //echo $users->id;die; 
			$this->_id = $users->id;
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	public function _getId(){
	  return $this->_id;
	}
}
