<?php

/**
 * This is the model class for table "{{customer_user}}".
 *
 * The followings are the available columns in table '{{customer_user}}':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $cname
 * @property string $zipcode
 * @property integer $phone
 * @property string $city
 * @property string $country
 * @property string $clname
 * @property string $caddress
 * @property string $cregistered
 * @property string $clastlogin
 * @property string $type
 *
 * The followings are the available model relations:
 * @property Booking[] $bookings
 * @property ServiceJob[] $serviceJobs
 * @property ServiceReview[] $serviceReviews
 */
class PaymentCustomerUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{customer_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email,cname,caddress,clname,zipcode, phone, city,country', 'required'),
			array('phone', 'numerical', 'integerOnly'=>true),
			array('email','email'),
		    //array('email', 'uniqueEmail'),
			array('email, password, cname, zipcode, clname, caddress, type', 'length', 'max'=>45),
			array('city, country', 'length', 'max'=>50),
			array('cregistered, clastlogin', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, password, cname, zipcode, phone, city, country, clname, caddress, cregistered, clastlogin, type', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'bookings' => array(self::HAS_MANY, 'Booking', 'customer_id'),
			'serviceJobs' => array(self::HAS_MANY, 'ServiceJob', 'customer_id'),
			'serviceReviews' => array(self::HAS_MANY, 'ServiceReview', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			'password' => 'Password',
			'cname' => 'Cname',
			'zipcode' => 'Zipcode',
			'phone' => 'Phone',
			'city' => 'City',
			'status' => 'Status',
			'country' => 'Country',
			'clname' => 'Clname',
			'caddress' => 'Caddress',
			'cregistered' => 'Cregistered',
			'clastlogin' => 'Clastlogin',
			'type' => 'Type',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('cname',$this->cname,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('clname',$this->clname,true);
		$criteria->compare('caddress',$this->caddress,true);
		$criteria->compare('cregistered',$this->cregistered,true);
		$criteria->compare('clastlogin',$this->clastlogin,true);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentCustomerUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function uniqueEmail($attribute, $params)
    {
        if($user = PaymentCustomerUser::model()->exists('email=:email',array('email'=>$this->email)))
          $this->addError($attribute, 'Email already exists!');
    }
}
