<?php

/**
 * This is the model class for table "{{company_request}}".
 *
 * The followings are the available columns in table '{{company_request}}':
 * @property integer $id
 * @property integer $service_id
 * @property integer $customer_id
 * @property integer $booking_id
 * @property integer $job_status
 * @property string $cleaningtime
 * @property string $postcode
 * @property integer $no_of_hours
 * @property integer $no_of_cleaners
 * @property string $cleaningdate
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Booking $booking
 * @property ServiceUser $service
 * @property CustomerUser $customer
 */
class CompanyRequest extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{company_request}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, customer_id, booking_id, cleaningtime, postcode, no_of_hours, no_of_cleaners, cleaningdate, date', 'required'),
			array('service_id, customer_id, booking_id, job_status, no_of_hours, no_of_cleaners', 'numerical', 'integerOnly'=>true),
			array('cleaningtime, postcode', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, service_id, customer_id, booking_id, job_status, cleaningtime, postcode, no_of_hours, no_of_cleaners, cleaningdate, date', 'safe', 'on'=>'search'),
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
			'booking' => array(self::BELONGS_TO, 'Booking', 'booking_id'),
			'service' => array(self::BELONGS_TO, 'ServiceUser', 'service_id'),
			'customer' => array(self::BELONGS_TO, 'CustomerUser', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'service_id' => 'Service',
			'customer_id' => 'Customer',
			'booking_id' => 'Booking',
			'job_status' => 'Job Status',
			'cleaningtime' => 'Cleaningtime',
			'postcode' => 'Postcode',
			'no_of_hours' => 'No Of Hours',
			'no_of_cleaners' => 'No Of Cleaners',
			'cleaningdate' => 'Cleaningdate',
			'date' => 'Date',
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
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('booking_id',$this->booking_id);
		$criteria->compare('job_status',$this->job_status);
		$criteria->compare('cleaningtime',$this->cleaningtime,true);
		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('no_of_hours',$this->no_of_hours);
		$criteria->compare('no_of_cleaners',$this->no_of_cleaners);
		$criteria->compare('cleaningdate',$this->cleaningdate,true);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CompanyRequest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
