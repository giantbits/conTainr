<?php

/**
 * This is the model class for table "containr_elementLib".
 *
 * The followings are the available columns in table 'containr_elementLib':
 * @property integer $id
 * @property string $type
 * @property integer $elementId
 */
class ContainrUser extends CActiveRecord
{

	public $passwordConfirm;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContainrElementLib the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'containr_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.

		return array(
			//(Yii::app()->user->isGuest) ? array('email,nameLast,nameFirst,street,city,zip', 'required') : array('password,email,nameLast,nameFirst,passwordConfirm', 'required'),
			//(!Yii::app()->user->isGuest) ? array('login', 'required') : array('login','safe'),
			array('email', 'email'),
			array('email', 'unique'),
			array('login', 'unique'),
			array('company,streetNum,phone,web', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,nameLast,nameFirst,login', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nameLast' => 'Nachname',
			'nameFirst' => 'Vorname',
			'login' => 'Login',
			'password'=>'Passwort',
			'email'=>'E-Mail',
			'role'=>'Rolle',
			'street'=>'Strasse',
			'streetNum'=>'Nummer',
			'city'=>'Ort',
			'zip'=>'Postleitzahl',
			'web'=>'Website',
			'phone'=>'Telefon',
			'company'=>'Firma',
			'passwordConfirm'=>'Passwort bestätigen'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('nameLast',$this->nameLast, true);
		$criteria->compare('nameFirst',$this->nameFirst, true);
		$criteria->compare('login',$this->login, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>25)
		));
	}

	public function beforeSave()
	{

		$this->dateLastUpdate = time();
		$this->password = crypt($this->password);

		return true;
	}
}
