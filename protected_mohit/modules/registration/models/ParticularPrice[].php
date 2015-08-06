<?php

/**
 * This is the model class for table "{{particular_price}}".
 *
 * The followings are the available columns in table '{{particular_price}}':
 * @property integer $id
 * @property integer $service_id
 * @property integer $customer_id
 * @property integer $bedroom
 * @property integer $bathroom
 * @property integer $property
 * @property integer $desk
 * @property string $date
 *
 * The followings are the available model relations:
 * @property CustomerUser $customer
 * @property ServiceUser $service
 */
class ParticularPrice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{particular_price}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bedroom, bathroom', 'required'),
			array('service_id, customer_id, bedroom, bathroom, property, desk', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, service_id, customer_id, bedroom, bathroom, property, desk, date', 'safe', 'on'=>'search'),
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
			'bedroom' => 'Bedroom',
			'bathroom' => 'Bathroom',
			'property' => 'Property',
			'desk' => 'Desk',
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
		$criteria->compare('bedroom',$this->bedroom);
		$criteria->compare('bathroom',$this->bathroom);
		$criteria->compare('property',$this->property);
		$criteria->compare('desk',$this->desk);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ParticularPrice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
