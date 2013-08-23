<?php

/**
 * This is the model class for table "containr_template".
 *
 * The followings are the available columns in table 'containr_template':
 * @property string $id
 * @property string $title
 * @property string $file
 * @property string $structure
 * @property string $thumbnail
 * @property integer $state
 */
class ContainrTemplate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContainrTemplate the static model class
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
		return 'containr_template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('state', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>128),
			array('file, thumbnail, structure', 'length', 'max'=>256),
			array('title, file, thumbnail, structure', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, file, thumbnail, state', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'title' => 'Title',
			'file' => 'File',
			'thumbnail' => 'Thumbnail',
			'state' => 'State',
			'structure' => 'Structure',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('thumbnail',$this->thumbnail,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('structure',$this->structure);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
