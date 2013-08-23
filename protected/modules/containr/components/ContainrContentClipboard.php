<?php
class ContainrContentClipboard extends CComponent {
	const MODE_COPY = 1;
	const MODE_CUT = 2;

	private $clipboard = array();

	public function addToClipboard($pageId,$refId,$mode=1) {
		$elementPageRef = ContainrElementPageRef::model()->findByPk($refId);

		$type = $elementPageRef->elementDef->type;
		$containrModel = Yii::app()->getModule('containr')->modules[$type]['containrModel'];

		$element = call_user_func(array($containrModel,'model'))->findByPK($elementPageRef->elementDef->elementId);
		$newElement = array(
			'pageId'=>$pageId,
			'refId'=>$refId,
			'mode'=>$mode,
			'label'=>isset($element->title) ? $element->title : $type . ' : ' . $element->id
		);
		$this->clipboard[$refId] = $newElement;
	}

	public function clearClipboard() {
		$this->clipboard = array();
	}

	public function paste($column, $pageId, $refId) {
		if (isset($this->clipboard[$refId])) {
			$elementPageRef = ContainrElementPageRef::model()->findByPk($refId);
			if (!is_null($elementPageRef)) {
				switch ($this->clipboard[$refId]['mode']) {
					case ContainrContentClipboard::MODE_COPY:
						$type = $elementPageRef->elementDef->type;
						$containrModel = Yii::app()->getModule('containr')->modules[$type]['containrModel'];

						$element = call_user_func(array($containrModel,'model'))->findByPK($elementPageRef->elementDef->elementId);

						$element->id = null;
						$element->isNewRecord = true;
						$_GET['page'] = $pageId;

						$element->save();
						break;
					case ContainrContentClipboard::MODE_CUT:
						$elementPageRef->pageId = $pageId;
						$elementPageRef->columnId = $column;
						$elementPageRef->posNum = ContainrElementPageRef::getLastPosition($pageId,$column)+1;
						$elementPageRef->save();

						break;
				}
			}
		}
	}

	public function pasteRef($column, $pageId, $refId) {
		if (isset($this->clipboard[$refId])) {
			$elementPageRef = ContainrElementPageRef::model()->findByPk($refId);
			if (!is_null($elementPageRef)) {
				switch ($this->clipboard[$refId]['mode']) {
					case ContainrContentClipboard::MODE_COPY:

						$elementPageRef->pageId = $pageId;
						$elementPageRef->id = null;
						$elementPageRef->isNewRecord = true;
						$elementPageRef->columnId = $column;
						$elementPageRef->posNum = ContainrElementPageRef::getLastPosition($pageId,$column)+1;
						$elementPageRef->save();

						break;
				}
			}
		}
	}
/*


 */
	public function isEmpty() {
		return count($this->clipboard) == 0;
	}

	public function getContentArray($pagepath,$query) {
		$rtn = array();
		$rtn[] = array('icon'=>'icon-trash','label'=>'Empty clipboard','url'=>Yii::app()->createUrl($pagepath,array('id'=>$_GET['id'],'action'=>'clearclipboard')),'title'=>'empty clipboard');
		foreach ($this->clipboard as $cbitem) {
			if ($cbitem['mode']==ContainrContentClipboard::MODE_COPY) {
				$rtn[] = array('icon'=>'icon-copy','label'=>$cbitem['label'], 'url'=>Yii::app()->createUrl($pagepath,array_merge($query,array('refkey'=>$cbitem['refId'],'action'=>'paste'))),'title'=>'insert copy object');
				$rtn[] = array('icon'=>'icon-external-link','label'=>$cbitem['label'], 'url'=>Yii::app()->createUrl($pagepath,array_merge($query,array('refkey'=>$cbitem['refId'],'action'=>'pasteref'))),'title'=>'insert instance of same object');
			} else {
				$rtn[] = array('icon'=>'icon-cut','label'=>$cbitem['label'], 'url'=>Yii::app()->createUrl($pagepath,array_merge($query,array('refkey'=>$cbitem['refId'],'action'=>'paste'))),'title'=>'move object here');
			}
		}
		return $rtn;
	}
}