<?php

/**
 * This is the model class for table "{{service_types}}".
 *
 * The followings are the available columns in table '{{service_types}}':
 * @property integer $id
 * @property string $service_name
 * @property string $image
 * @property string $desc
 * @property integer $status
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Booking[] $bookings
 * @property NewAttribute[] $newAttributes
 * @property PriceAdmin[] $priceAdmins
 * @property ProviderAdditionalprices[] $providerAdditionalprices
 * @property ServicePrice[] $servicePrices
 * @property ServicestatusBycompany[] $servicestatusBycompanies
 * @property ServicetypeAdditionalservices[] $servicetypeAdditionalservices
 */
class ServiceTypes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{service_types}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'numerical', 'integerOnly'=>true),
			array('service_name', 'length', 'max'=>45),
			array('image', 'length', 'max'=>100),
			array('desc, date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, service_name, image, desc, status, date', 'safe', 'on'=>'search'),
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
			'bookings' => array(self::HAS_MANY, 'Booking', 'service_type_id'),
			'newAttributes' => array(self::HAS_MANY, 'NewAttribute', 'service_type_id'),
			'priceAdmins' => array(self::HAS_MANY, 'PriceAdmin', 'service_type_id'),
			'providerAdditionalprices' => array(self::HAS_MANY, 'ProviderAdditionalprices', 'service_type_id'),
			'servicePrices' => array(self::HAS_MANY, 'ServicePrice', 'service_type_id'),
			'servicestatusBycompanies' => array(self::HAS_MANY, 'ServicestatusBycompany', 'service_type_id'),
			'servicetypeAdditionalservices' => array(self::HAS_MANY, 'ServicetypeAdditionalservices', 'service_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'service_name' => 'Service Name',
			'image' => 'Image',
			'desc' => 'Desc',
			'status' => 'Status',
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
		$criteria->compare('service_name',$this->service_name,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServiceTypes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
