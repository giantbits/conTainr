<?php

/**
 * This is the model class for table "containr_elementPageRef".
 *
 * The followings are the available columns in table 'containr_elementPageRef':
 * @property integer $id
 * @property integer $elementId
 * @property integer $pageId
 */
class ContainrElementPageRef extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ElementPageRef the static model class
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
		return 'containr_elementPageRef';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('elementId, pageId, posNum', 'numerical', 'integerOnly'=>true),
			array('template,columnId','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, elementId, pageId, posNum', 'safe', 'on'=>'search'),
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
			'elementDef'=>array(self::BELONGS_TO, 'ContainrElementLib', 'elementId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'elementId' => 'Element',
			'pageId' => 'Page',
			'posNum' => 'Position',
		);
	}

	public function scopes(){
		return array(
			'sorted'=>array(
				'order'=>'posNum ASC'
			),
			'lastPosNum'=>array(
				'limit'=>'1',
				'order'=>'posNum DESC'
			)
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

		$criteria->compare('id',$this->id);
		$criteria->compare('elementId',$this->elementId);
		$criteria->compare('pageId',$this->pageId);
		$criteria->compare('posNum',$this->posNum);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function getLastPosition($page, $column) {
		$model = ContainrElementPageRef::model()->lastPosNum()->find('pageId = ' . $page . ' AND columnId = "' . $column . '"');

		if($model)
			return $model->posNum;
		else
			return 0;
	}
}
