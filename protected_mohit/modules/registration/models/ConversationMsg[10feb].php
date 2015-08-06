<?php

/**
 * This is the model class for table "{{conversation_msg}}".
 *
 * The followings are the available columns in table '{{conversation_msg}}':
 * @property integer $id
 * @property integer $sender_id
 * @property string $sender_type
 * @property integer $reciver_id
 * @property string $reciver_type
 * @property integer $sender_status
 * @property integer $reciver_status
 * @property string $subject
 * @property string $date
 *
 * The followings are the available model relations:
 * @property MsgDetails[] $msgDetails
 */
class ConversationMsg extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{conversation_msg}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sender_id, sender_type, reciver_id, reciver_type, subject, date', 'required'),
			array('sender_id, reciver_id, sender_status, reciver_status', 'numerical', 'integerOnly'=>true),
			array('sender_type, reciver_type', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sender_id, sender_type, reciver_id, reciver_type, sender_status, reciver_status, subject, date', 'safe', 'on'=>'search'),
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
			'msgDetails' => array(self::HAS_MANY, 'MsgDetails', 'conversation_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sender_id' => 'Sender',
			'sender_type' => 'Sender Type',
			'reciver_id' => 'Reciver',
			'reciver_type' => 'Reciver Type',
			'sender_status' => 'Sender Status',
			'reciver_status' => 'Reciver Status',
			'subject' => 'Subject',
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
		$criteria->compare('sender_id',$this->sender_id);
		$criteria->compare('sender_type',$this->sender_type,true);
		$criteria->compare('reciver_id',$this->reciver_id);
		$criteria->compare('reciver_type',$this->reciver_type,true);
		$criteria->compare('sender_status',$this->sender_status);
		$criteria->compare('reciver_status',$this->reciver_status);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ConversationMsg the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
