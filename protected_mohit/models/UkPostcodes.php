<?php

/**
 * This is the model class for table "{{uk_postcodes}}".
 *
 * The followings are the available columns in table '{{uk_postcodes}}':
 * @property string $postcode
 * @property integer $x
 * @property integer $y
 * @property string $latitude
 * @property string $longitude
 * @property string $town
 * @property string $county
 */
class UkPostcodes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{uk_postcodes}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('postcode', 'required'),
			array('x, y', 'numerical', 'integerOnly'=>true),
			array('postcode, latitude', 'length', 'max'=>5),
			array('longitude', 'length', 'max'=>8),
			array('town, county', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('postcode, x, y, latitude, longitude, town, county', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'postcode' => 'Postcode',
			'x' => 'X',
			'y' => 'Y',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'town' => 'Town',
			'county' => 'County',
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

		$criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('x',$this->x);
		$criteria->compare('y',$this->y);
		$criteria->compare('latitude',$this->latitude,true);
		$criteria->compare('longitude',$this->longitude,true);
		$criteria->compare('town',$this->town,true);
		$criteria->compare('county',$this->county,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UkPostcodes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
