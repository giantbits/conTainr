<?php

/**
 * This is the model class for table "containr_contentImage".
 *
 * The followings are the available columns in table 'containr_contentImage':
 * @property integer $id
 * @property string $title
 * @property string $teaser
 * @property string $content
 * @property integer $dateCreate
 * @property integer $dateUpdate
 * @property integer $dateDelete
 * @property integer $userCreate
 * @property integer $userUpdate
 * @property integer $userDelete
 * @property integer $mediaId
 * @property string $mediaPosition
 * @property integer $state
 * @property string $cssclass
 * @property string $cssid
 * @property integer $showHeadline
 */

class ContentImage extends CActiveRecord
{

	public $pagelist = '';
	public $elemType = 'contentimage';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContentImage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function behaviors() {
		return array(
			'MultilangBehavior' => array(
				'class' => 'application.modules.containr.components.ContainrMultilangBehavior',
				'localizedAttributes' => array('title', 'teaser', 'content'),
				'languages' => Yii::app()->urlManager->languages
			),
			'ElementBehavior'=>array(
				'class'=>'application.modules.containr.components.ContainrElementBehavior',
				'templates'=>array('maincontent'=>'Main content','relatedcontent'=>'Related content')
			),
		);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'containr_contentImage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dateCreate, dateUpdate, dateDelete, userCreate, userUpdate, userDelete, mediaId, state', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('mediaPosition', 'length', 'max'=>16),
			array('teaser, content, cssclass, cssid, showHeadline, template', 'safe'),
			array('title, content','required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, teaser, content, dateCreate, dateUpdate, dateDelete, userCreate, userUpdate, userDelete, mediaId, mediaPosition, state', 'safe', 'on'=>'search'),
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
			'teaser' => 'Teaser',
			'content' => 'Content',
			'dateCreate' => 'Date Create',
			'dateUpdate' => 'Date Update',
			'dateDelete' => 'Date Delete',
			'userCreate' => 'User Create',
			'userUpdate' => 'User Update',
			'userDelete' => 'User Delete',
			'mediaId' => 'Media',
			'mediaPosition' => 'Media Position',
			'state' => 'State',
			'cssclass' => 'CSS Class',
			'cssid' => 'CSS Id',
			'showHeadline' => 'Display title',
		);
	}

	public function buildPageList()
	{
		$pageList = '';

		$libId = ContainrElementLib::model()->find('elementId = ' . $this->id);

		$refLib = ContainrElementPageRef::model()->findAll('elementId = ' . $libId->id);

		foreach($refLib as $ref)
		{
			$page = ContainrPage::model()->findByPK($ref->pageId);
			$pageList .= CHtml::Link($page->title,Yii::app()->createUrl('/containr/page/update/',array('id'=>$page->id)));
		}

		$this->pagelist = $pageList;
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('teaser',$this->teaser,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('dateCreate',$this->dateCreate);
		$criteria->compare('dateUpdate',$this->dateUpdate);
		$criteria->compare('dateDelete',$this->dateDelete);
		$criteria->compare('userCreate',$this->userCreate);
		$criteria->compare('userUpdate',$this->userUpdate);
		$criteria->compare('userDelete',$this->userDelete);
		$criteria->compare('mediaId',$this->mediaId);
		$criteria->compare('mediaPosition',$this->mediaPosition,true);
		$criteria->compare('state',$this->state);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	public function afterFind()
	{
		parent::afterFind();

		$this->buildPageList();
	}

	public function beforeDelete(){


	}
}
