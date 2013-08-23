<?php

/**
 * This is the model class for table "containr_page".
 *
 * The followings are the available columns in table 'containr_page':
 * @property string $id
 * @property string $path
 * @property string $filename
 * @property string $type
 * @property string $title
 * @property string $description
 * @property string $size
 */
class ContainrMedia extends CActiveRecord
{
	public $imageWidth;
	public $imageHeight;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContainrPage the static model class
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
		return 'containr_media';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('path,filename,title,type,description,size', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('path,filename,title,type,description,size', 'safe', 'on'=>'search'),
		);
	}

	public function defaultScope()
    {
        return array(
            'order'=>"id DESC",
        );
    }

    public function scopes()
    {
        return array(
            'sortedTree'=>array(
            	'order'=>'id DESC',
            ),
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
			'title' => 'Title',
			'description' => 'Description',
			'type' => 'Type',
			'size' => 'Size',
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
		$criteria->compare('title',$this->title, true);
		$criteria->compare('description',$this->description, true);
		$criteria->compare('filename',$this->filename, true);
		$criteria->compare('type',$this->type);
		$criteria->compare('size',$this->size);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
		        'pageSize'=>20,
		    ),
		));
	}

	public function getMediaItem($id,$width=null,$height=null,$position="left",$cssClass="")
	{
		$item = ContainrMedia::model()->findByPK($id);

		if (!is_null($item)) { // image may be deleted...
			echo '<img src="'.$item->path.$item->filename.'" style="float: '.$position.'; margin-right: 12px; margin-bottom: 12px;"';

			if($width>0)
				echo ' width='.$width.'';

			if($height>0)
				echo ' height='.$height.'';



			if($cssClass<>"")
				echo ' class="'.$cssClass.'"';

			echo ' />';
		}
	}

	public function getDownload($id) {
		$item = ContainrMedia::model()->findByPK($id);

		echo '<a href="'.$item->path.$item->filename.'" target="_blank">'.$item->filename.'</a> <i class="icon icon-download-alt"></i>';
	}

	public function getMediaSrc($id,$size="")
	{
		$item = ContainrMedia::model()->findByPK($id);

		return $item->path.$size."/".$item->filename;
	}
}
