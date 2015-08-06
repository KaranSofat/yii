<?php

/**
 * This is the model class for table "{{additional_service_price}}".
 *
 * The followings are the available columns in table '{{additional_service_price}}':
 * @property integer $id
 * @property integer $additional_service_id
 * @property integer $price
 * @property integer $service_id
 * @property string $date
 *
 * The followings are the available model relations:
 * @property AdditionalServices $additionalService
 * @property ServiceUser $service
 */
class AdditionalServicePrice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{additional_service_price}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('additional_service_id, price, service_id, date', 'required'),
			array('additional_service_id, price, service_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, additional_service_id, price, service_id, date', 'safe', 'on'=>'search'),
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
			'price' => 'Price',
			'service_id' => 'Service',
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
		$criteria->compare('price',$this->price);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdditionalServicePrice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
