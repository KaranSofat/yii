<?php

/**
 * This is the model class for table "{{additional_particular_price}}".
 *
 * The followings are the available columns in table '{{additional_particular_price}}':
 * @property integer $id
 * @property integer $additional_service_id
 * @property integer $service_id
 * @property integer $customer_id
 * @property integer $booking_id
 * @property integer $price
 * @property integer $total_price
 * @property string $date
 *
 * The followings are the available model relations:
 * @property AdditionalServices $additionalService
 * @property ServiceUser $service
 * @property CustomerUser $customer
 */
class AdditionalParticularPrice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{additional_particular_price}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('additional_service_id, service_id, customer_id, booking_id, price, total_price, date', 'required'),
			array('additional_service_id, service_id, customer_id, booking_id, price, total_price', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, additional_service_id, service_id, customer_id, booking_id, price, total_price, date', 'safe', 'on'=>'search'),
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
			'additionalService' => array(self::BELONGS_TO, 'AdditionalServices', 'additional_service_id'),
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
			'additional_service_id' => 'Additional Service',
			'service_id' => 'Service',
			'customer_id' => 'Customer',
			'booking_id' => 'Booking',
			'price' => 'Price',
			'total_price' => 'Total Price',
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
		$criteria->compare('additional_service_id',$this->additional_service_id);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('customer_id',$this->customer_id);
		$criteria->compare('booking_id',$this->booking_id);
		$criteria->compare('price',$this->price);
		$criteria->compare('total_price',$this->total_price);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdditionalParticularPrice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
