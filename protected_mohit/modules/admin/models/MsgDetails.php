<?php

/**
 * This is the model class for table "{{msg_details}}".
 *
 * The followings are the available columns in table '{{msg_details}}':
 * @property integer $id
 * @property integer $conversation_id
 * @property string $user_type
 * @property integer $user_id
 * @property integer $booking_id
 * @property integer $tomsg
 * @property string $msg
 * @property integer $inbox_dlt_status
 * @property integer $sent_dlt_status
 * @property integer $logged_id
 * @property string $date
 *
 * The followings are the available model relations:
 * @property ConversationMsg $conversation
 */
class MsgDetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{msg_details}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('conversation_id, user_type, user_id, booking_id, tomsg, msg, date', 'required'),
			array('conversation_id, user_id, booking_id, tomsg, inbox_dlt_status, sent_dlt_status, logged_id', 'numerical', 'integerOnly'=>true),
			array('user_type', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, conversation_id, user_type, user_id, booking_id, tomsg, msg, inbox_dlt_status, sent_dlt_status, logged_id, date', 'safe', 'on'=>'search'),
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
			'conversation' => array(self::BELONGS_TO, 'ConversationMsg', 'conversation_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'conversation_id' => 'Conversation',
			'user_type' => 'User Type',
			'user_id' => 'User',
			'booking_id' => 'Booking',
			'tomsg' => 'Tomsg',
			'msg' => 'Msg',
			'inbox_dlt_status' => 'Inbox Dlt Status',
			'sent_dlt_status' => 'Sent Dlt Status',
			'logged_id' => 'Logged',
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
		$criteria->compare('conversation_id',$this->conversation_id);
		$criteria->compare('user_type',$this->user_type,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('booking_id',$this->booking_id);
		$criteria->compare('tomsg',$this->tomsg);
		$criteria->compare('msg',$this->msg,true);
		$criteria->compare('inbox_dlt_status',$this->inbox_dlt_status);
		$criteria->compare('sent_dlt_status',$this->sent_dlt_status);
		$criteria->compare('logged_id',$this->logged_id);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MsgDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
