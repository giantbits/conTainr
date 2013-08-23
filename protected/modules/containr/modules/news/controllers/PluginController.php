<?php

class PluginController extends ContainrController
{

	public function init() {

		// set default containr layout
		parent::init();
		$this->setUpClientScript();

	}
	
	public function setUpClientScript() {
		// get client script
		$cs = Yii::app()->getClientScript();

		// core scripts (jquery)
		$cs->registerCoreScript('jquery');

		// bootstrap
		$cs->registerScriptFile($this->module->assetsUrl.'/js/bootstrap.min.js');
		
		// cleditor
		$cs->registerScriptFile($this->module->assetsUrl.'/js/jquery.cleditor.min.js');
		$cs->registerScriptFile($this->module->assetsUrl.'/js/jquery.cleditor.table.min.js');
		$cs->registerScriptFile($this->module->assetsUrl.'/js/jquery.cleditor.xhtml.min.js');
		$cs->registerScriptFile($this->module->assetsUrl.'/js/jquery.cleditor.image.js');
		$cs->registerScriptFile($this->module->assetsUrl.'/js/jquery.cleditor.link.js');

		$js = "
		
			$('.cledit').cleditor();
		
			$('input,textarea,select').on('change', function(){
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
	
	public function actionEdit()
	{
		if(isset($_GET['id']) && $_GET['id'] > 0){
			$model = NewsPlugin::model()->findByPK($_GET['id']);
		} else {
			$model = new NewsPlugin();	
		}
		
	
		if(isset($_POST['NewsPlugin'])){
			
			$model->attributes = $_POST['NewsPlugin'];
			
			if($model->validate()){
				$model->save();
				
				$this->redirect($this->createUrl('/containr/news/plugin/edit/',array('id'=>$model->id)));
			}
		} else {

			if(isset($_GET['id']) && $_GET['id'] > 0){
				$model = NewsPlugin::model()->findByPK($_GET['id']);
			}

		}		
	
		$this->render('edit',array('model'=>$model));
	}
	
}
