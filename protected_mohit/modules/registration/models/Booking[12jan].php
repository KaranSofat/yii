<?php

/**
 * This is the model class for table "{{booking}}".
 *
 * The followings are the available columns in table '{{booking}}':
 * @property integer $id
 * @property integer $customer_id
 * @property integer $service_id
 * @property integer $service_type_id
 * @property integer $customer_address_id
 * @property integer $price
 * @property string $cleaningDetail
 * @property string $additional
 * @property string $trans_id
 * @property string $date
 *
 * The followings are the available model relations:
 * @property CustomerUser $customer
 * @property ServiceUser $service
 * @property ServiceTypes $serviceType
 * @property CustomerAddress $customerAddress
 * @property ServiceReview[] $serviceReviews
 */
class Booking extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{booking}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_type_id, customer_address_id', 'required'),
			array('customer_id, service_id, service_type_id, customer_address_id, price', 'numerical', 'integerOnly'=>true),
			array('trans_id', 'length', 'max'=>100),
			array('date', 'length', 'max'=>45),
			array('cleaningDetail, additional', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, customer_id, service_id, service_type_id, customer_address_id, price, cleaningDetail, additional, trans_id, date', 'safe', 'on'=>'search'),
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
			'customer' => array(self::BELONGS_TO, 'CustomerUser', 'customer_id'),
			'service' => array(self::BELONGS_TO, 'ServiceUser', 'service_id'),
			'serviceType' => array(self::BELONGS_TO, 'ServiceTypes', 'service_type_id'),
			'customerAddress' => array(self::BELONGS_TO, 'CustomerAddress', 'customer_address_id'),
			'serviceReviews' => array(self::HAS_MANY, 'ServiceReview', 'booking_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'customer_id' => 'Customer',
			'service_id' => 'Service',
			'service_type_id' => 'Service Type',
			'customer_address_id' => 'Customer Address',
			'price' => 'Price',
			'cleaningDetail' => 'Cleaning Detail',
			'additional' => 'Additional',
			'trans_id' => 'Trans',
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
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('service_type_id',$this->service_type_id);
		$criteria->compare('customer_address_id',$this->customer_address_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('cleaningDetail',$this->cleaningDetail,true);
		$criteria->compare('additional',$this->additional,true);
		$criteria->compare('trans_id',$this->trans_id,true);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Booking the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
