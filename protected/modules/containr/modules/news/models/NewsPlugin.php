<?php

/**
 * This is the model class for table "containr_contentImage".
 *
 * The followings are the available columns in table 'containr_contentImage':
 * @property integer $id
 * @property integer $type
 * @property integer $itemsperpage
 * @property integer $pager
 */
class NewsPlugin extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContentImage the static model class
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
		return 'containr_newsPlugin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type,itemsperpage,pager', 'numerical', 'integerOnly'=>true),
			array('headline,detailPage','safe'),
			//array('title, teaser, content','required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'itemsperpage' => 'Items per page',
			'pager' => 'Pager',
			'detailpage' => 'Detail Page',
			'headline' => 'Headline'
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
		$criteria->compare('itemsperpage',$this->itemsperpage);	
		$criteria->compare('pager',$this->pager);	
		$criteria->compare('type',$this->type);	
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function afterSave(){

		if($this->isNewRecord) {
			$elementLibentry = new ContainrElementLib();
			$elementLibentry->type = 'news';
			$elementLibentry->elementId = $this->id;
			$elementLibentry->save();
			
			$ref = new ContainrElementPageRef();
			$ref->elementId = $elementLibentry->id;
			$ref->columnId = $_GET['column'];
			$ref->pageId = $_GET['page'];
			$ref->posNum = 9999;
			$ref->save();		
		}		
	}
}
