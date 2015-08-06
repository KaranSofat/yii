<?php

/**
 * This is the model class for table "{{additional_attr}}".
 *
 * The followings are the available columns in table '{{additional_attr}}':
 * @property integer $id
 * @property integer $newAttrId
 * @property integer $priceTableId
 * @property string $additionalFieldName
 * @property string $date
 *
 * The followings are the available model relations:
 * @property NewAttribute $newAttr
 * @property ServicePrice $priceTable
 */
class AdditionalAttr extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{additional_attr}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('newAttrId, priceTableId, additionalFieldName, date', 'required'),
			array('newAttrId, priceTableId', 'numerical', 'integerOnly'=>true),
			array('additionalFieldName', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, newAttrId, priceTableId, additionalFieldName, date', 'safe', 'on'=>'search'),
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
			'newAttr' => array(self::BELONGS_TO, 'NewAttribute', 'newAttrId'),
			'priceTable' => array(self::BELONGS_TO, 'ServicePrice', 'priceTableId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'newAttrId' => 'New Attr',
			'priceTableId' => 'Price Table',
			'additionalFieldName' => 'Additional Field Name',
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
		$criteria->compare('newAttrId',$this->newAttrId);
		$criteria->compare('priceTableId',$this->priceTableId);
		$criteria->compare('additionalFieldName',$this->additionalFieldName,true);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdditionalAttr the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
