<?php

/**
 * This is the model class for table "{{service_price}}".
 *
 * The followings are the available columns in table '{{service_price}}':
 * @property integer $id
 * @property integer $service_type_id
 * @property integer $service_id
 * @property integer $no_of_beds
 * @property integer $no_of_baths
 * @property integer $property_size
 * @property integer $area
 * @property integer $no_of_desk
 * @property integer $price
 * @property string $date
 *
 * The followings are the available model relations:
 * @property ServiceTypes $serviceType
 * @property ServiceUser $service
 */
class ServicePrice extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{service_price}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		
        if(empty($_REQUEST))
		{	
 
			return array(
				//array('service_type_id, service_id, no_of_beds, no_of_baths, property_size, area, no_of_desk, price, date', 'required'),
				array('service_type_id,no_of_beds, no_of_baths, property_size, area, no_of_desk', 'required'),
				
				array('service_type_id, service_id, no_of_beds, no_of_baths, property_size, area, no_of_desk, price', 'numerical', 'integerOnly'=>true),
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array('id, service_type_id, service_id, no_of_beds, no_of_baths, property_size, area, no_of_desk, price, date', 'safe', 'on'=>'search'),
			);
	    }
	   elseif($_REQUEST['ServicePrice']['service_type_id']=='3')
       {
       	     return array(
				//array('service_type_id, service_id, no_of_beds, no_of_baths, property_size, area, no_of_desk, price, date', 'required'),
				array('service_type_id,no_of_beds, no_of_baths, property_size, area, no_of_desk', 'required'),
			

				array('service_type_id, service_id, no_of_beds, no_of_baths, property_size, area, no_of_desk, price', 'numerical', 'integerOnly'=>true),
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array('id, service_type_id, service_id, no_of_beds, no_of_baths, property_size, area, no_of_desk, price, date', 'safe', 'on'=>'search'),
			);
       }
       else
       {

             return array(
				//array('service_type_id, service_id, no_of_beds, no_of_baths, property_size,price, date', 'required'),
				array('service_type_id,no_of_beds, no_of_baths, property_size', 'required'),
			

				array('service_type_id, service_id, no_of_beds, no_of_baths, property_size, area, no_of_desk, price', 'numerical', 'integerOnly'=>true),
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
				array('id, service_type_id, service_id, no_of_beds, no_of_baths, property_size, area, no_of_desk, price, date', 'safe', 'on'=>'search'),
			);

       }
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'additionalAttrs' => array(self::HAS_MANY, 'AdditionalAttr', 'priceTableId'),
			'serviceType' => array(self::BELONGS_TO, 'ServiceTypes', 'service_type_id'),
			'service' => array(self::BELONGS_TO, 'ServiceUser', 'service_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		
		if(empty($_REQUEST))
		{	

			return array(
				'id' => 'ID',
				'service_type_id' => 'Service Type',
				//'service_id' => 'Service',
				'no_of_beds' => 'No Of Beds',
				'no_of_baths' => 'No Of Baths',
				'property_size' => 'Property Size',
				'area' => 'Area',
				'no_of_desk' => 'No Of Desk',
				//'price' => 'Price',
				'date' => 'Date',
			);
       }
       elseif($_REQUEST['ServicePrice']['service_type_id']=='3')
       {
            return array(
				'id' => 'ID',
				'service_type_id' => 'Service Type',
				//'service_id' => 'Service',
				'no_of_beds' => 'No Of Beds',
				'no_of_baths' => 'No Of Baths',
				'property_size' => 'Property Size',
				'area' => 'Area',
				'no_of_desk' => 'No Of Desk',
				//'price' => 'Price',
				'date' => 'Date',
			);

       } 
       else
       {
            return array(
				'id' => 'ID',
				'service_type_id' => 'Service Type',
				'service_id' => 'Service',
				'no_of_beds' => 'No Of Beds',
				'no_of_baths' => 'No Of Baths',
				'property_size' => 'Property Size',
				//'area' => 'Area',
				//'no_of_desk' => 'No Of Desk',
				'price' => 'Price',
				'date' => 'Date',
			);


       } 

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
		$criteria->compare('service_type_id',$this->service_type_id);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('no_of_beds',$this->no_of_beds);
		$criteria->compare('no_of_baths',$this->no_of_baths);
		$criteria->compare('property_size',$this->property_size);
		$criteria->compare('area',$this->area);
		$criteria->compare('no_of_desk',$this->no_of_desk);
		$criteria->compare('price',$this->price);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServicePrice the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/*public function beforeSave() 
    {
        if($this->isNewRecord)
        {           
            $this->date=new CDbExpression('NOW()');
            $this->status=0; //option by default
        }
        $this->modified = new CDbExpression('NOW()');
        return parent::beforeSave();
    } */

    public function getShortDescription()
    {

        return substr($this->description, 0, 150); 
    }
}
