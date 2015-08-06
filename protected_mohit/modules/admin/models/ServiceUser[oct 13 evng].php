<?php

/**
 * This is the model class for table "{{service_user}}".
 *
 * The followings are the available columns in table '{{service_user}}':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $company_name
 * @property string $company_logo
 * @property string $city
 * @property string $zipcode
 * @property integer $jobsdone
 * @property integer $phone
 * @property double $lat
 * @property double $longitude
 * @property string $registered
 * @property string $lastlogin
 *
 * The followings are the available model relations:
 * @property Booking[] $bookings
 * @property PriceAdmin[] $priceAdmins
 * @property ServiceImages[] $serviceImages
 * @property ServiceJob[] $serviceJobs
 * @property ServicePrice[] $servicePrices
 * @property ServiceReview[] $serviceReviews
 */
class ServiceUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{service_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_name', 'required'),
			array('jobsdone, phone', 'numerical', 'integerOnly'=>true),
			array('lat, longitude', 'numerical'),
			array('email, password, city', 'length', 'max'=>45),
			array('company_name, company_logo, zipcode', 'length', 'max'=>100),
			array('registered, lastlogin', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, password, company_name, company_logo, city, zipcode, jobsdone, phone, lat, longitude, registered, lastlogin', 'safe', 'on'=>'search'),
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
			'bookings' => array(self::HAS_MANY, 'Booking', 'service_id'),
			'priceAdmins' => array(self::HAS_MANY, 'PriceAdmin', 'service_id'),
			'serviceImages' => array(self::HAS_MANY, 'ServiceImages', 'service_id'),
			'serviceJobs' => array(self::HAS_MANY, 'ServiceJob', 'service_id'),
			'servicePrices' => array(self::HAS_MANY, 'ServicePrice', 'service_id'),
			'serviceReviews' => array(self::HAS_MANY, 'ServiceReview', 'service_id'),
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
			'company_name' => 'Company Name',
			'company_logo' => 'Company Logo',
			'city' => 'City',
			'zipcode' => 'Zipcode',
			'jobsdone' => 'Jobsdone',
			'phone' => 'Phone',
			'lat' => 'Lat',
			'longitude' => 'Longitude',
			'registered' => 'Registered',
			'lastlogin' => 'Lastlogin',
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
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('company_logo',$this->company_logo,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('jobsdone',$this->jobsdone);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('registered',$this->registered,true);
		$criteria->compare('lastlogin',$this->lastlogin,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServiceUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
