<?php
/**
 * This is the model class for table "containr_contentImage".
 *
 * The followings are the available columns in table 'containr_contentImage':
 *
 * @property integer $id
 */
class FormsPlugin extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 *
	 * @param string  $className active record class name.
	 * @return ContentImage the static model class
	 */
	public static function model( $className=__CLASS__ ) {
		return parent::model( $className );
	}

	/**
	 *
	 *
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'containr_formsPlugin';
	}

	/**
	 *
	 *
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return array(
			array( 'successMessage,errorMessage,databaseModel', 'safe' ),
			array( 'title,mailRecipient,model', 'required' ),
			array( 'mailRecipient','email'),
			array( 'mailRecipient,mailSubject','length', 'min'=>3, 'max'=>128),
			array( 'id', 'safe', 'on'=>'search' ),
		);
	}

	/**
	 *
	 *
	 * @return array relational rules.
	 */
	public function relations() {
		return array();
	}

	/**
	 *
	 *
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array();
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		$criteria=new CDbCriteria;

		$criteria->compare( 'id', $this->id );

		return new CActiveDataProvider( $this, array(
				'criteria'=>$criteria,
			) );
	}

	public function afterSave() {

		if ( $this->isNewRecord ) {
			$elementLibentry = new ContainrElementLib();
			$elementLibentry->type = 'forms';
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
