<?php

class PluginController extends ContainrController
{

	public function init() {

		// set default containr layout
		$this->setUpTemplate();
		$this->setUpCss();
		$this->setUpClientScript();

	}

	public function setUpTemplate() {
		$this->layout = 'application.modules.containr.views.layouts.containr';
	}

	public function setUpClientScript() {

		parent::setUpClientScript();

		// get client script
		$cs = Yii::app()->getClientScript();

		$js = "
			$('#content-image-edit-form input,#content-image-edit-form textarea,#content-image-edit-form select').on('change', function(){
				$('#btnCancel').removeAttr('disabled');
				$('#btnSave').removeAttr('disabled');
			});
		";

		$cs->registerScript('contentimage',$js,CClientScript::POS_READY);

	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionCreate()
	{
		//$this->layout = 'application.modules.containr.views.layouts.containr';


		if(isset($_GET['id']) && $_GET['id'] > 0){
			$model = ContentImage::model()->findByPK($_GET['id']);
		} else {
			$model = new ContentImage();
		}


		if(isset($_POST['ContentImage'])){

			$model->attributes = $_POST['ContentImage'];

			if($model->validate()){
				$model->save();

				$this->redirect($this->createUrl('/containr/contentimage/plugin/update/',array('id'=>$model->id)));
			}
		} else {

			if(isset($_GET['id']) && $_GET['id'] > 0){
				$model = ContentImage::model()->findByPK($_GET['id']);
			}

		}

		$this->render('update',array('model'=>$model));
	}

	public function actionUpdate()
	{
		//$this->layout = 'application.modules.containr.views.layouts.containr';
		$lid = (isset($_GET['lid'])) ? $_GET['lid'] : '';

		if(isset($_GET['id']) && $_GET['id'] > 0){

			$clkey = (isset($_GET['clkey'])) ? $_GET['clkey'] : '';
			$model = ContentImage::model()->localized($clkey)->findByPK($_GET['id']);
		} else {
			$model = new ContentImage();
		}

		if(isset($_POST['ContentImage'])){

			$model->attributes = $_POST['ContentImage'];

			if($model->validate()){
				$model->save();
				$this->redirect($this->createUrl('/containr/contentimage/plugin/update/',array('id'=>$model->id,'refkey'=>$model->refKey)));
			}
		}

		$this->render('update',array('model'=>$model));
	}

	public function actionDelete() {

		$elementId = ContainrElementLib::model()->find('elementId = '.$_GET['id'] . ' AND type="contentimage"');

		ContainrElementLib::model()->deleteAll('elementId = ' . $_GET['id'] . ' AND type="contentimage"');
		ContainrElementPageRef::model()->deleteAll('elementId = '.$elementId->id);
		ContentImage::model()->deleteByPK($_GET['id']);

		$this->redirect(Yii::app()->createUrl('/containr/page/update/',array('id'=>$_GET['page'])));
	}

	public function actionDeleteRef() {
		ContainrElementPageRef::model()->deleteByPK($_GET['id']);

		$this->redirect(Yii::app()->createUrl('/containr/page/update/',array('id'=>$_GET['page'])));
	}
}
