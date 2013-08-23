<?php
class ContainrElementBehavior extends CActiveRecordBehavior
{

	public $templates = array();
	public $template;
	public $elemType = '';

	public $column;
	public $page;
	public $posNum;

	public $refKey;

	// this fetches the page out of db if it is existant
	public function afterSave( $event ) {

		if ( $this->owner->isNewRecord ) {
			$elementLibentry = new ContainrElementLib();
			$elementLibentry->type = $this->owner->elemType;
			$elementLibentry->elementId = $this->owner->id;
			$elementLibentry->save();

			$ref = new ContainrElementPageRef();
			$ref->elementId = $elementLibentry->id;
			$ref->columnId = $_GET['column'];
			$ref->pageId = $_GET['page'];
			$ref->posNum = ( ContainrElementPageRef::getLastPosition( $_GET['page'], $_GET['column'] ) + 1 );
			$ref->template = $this->template;
			$ref->save();

			$this->refKey = $ref->id;
		} else {

			if(isset($_GET['refkey']) && $_GET['refkey'] > 0) {
				//$elementLibentry = ContainrElementLib::model()->find('elementId = ' . $this->owner->id);
				$ref = ContainrElementPageRef::model()->findByPK( $_GET['refkey'] );
				$ref->template = $this->template;
				$ref->save();

				$this->refKey = $ref->id;
			}
		}
	}

	public function afterFind( $event ) {

		if ( isset( $_GET['refkey'] ) && $_GET['refkey'] > 0 ) {
			$elementPageRef = ContainrElementPageRef::Model()->findByPK( $_GET['refkey'] );

			if ( $elementPageRef ) {
				$this->template = $elementPageRef->template;
				$this->refKey = $elementPageRef->id;
				$this->column = $elementPageRef->columnId;
				$this->page = $elementPageRef->pageId;
				$this->posNum = $elementPageRef->posNum;
			}
		}
	}
}
