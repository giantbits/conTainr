<?php

class PluginController extends ContainrController
{
	public function init() {

		// set default containr layout
		$this->setUpTemplate();
		$this->setUpCss();
		$this->setUpClientScript();

	}

	public function actionCreate()
	{
		if(isset($_GET['id']) && $_GET['id'] > 0){
			$model = Loginbox::model()->findByPK($_GET['id']);
		} else {
			$model = new Loginbox();
		}


		if(isset($_POST['Loginbox'])){

			$model->attributes = $_POST['Loginbox'];

			if($model->validate()){
				$model->save();

				$this->redirect($this->createUrl('/containr/page/update',array('id'=>Yii::app()->user->lastPID)));
			}
		} else {

			if(isset($_GET['id']) && $_GET['id'] > 0){
				$model = Loginbox::model()->findByPK($_GET['id']);
			}

		}

		$this->render('update',array('model'=>$model,'pageList'=>$this->getPageList()));
	}

	public function actionUpdate()
	{

		if(isset($_GET['id']) && $_GET['id'] > 0){
			$model = Loginbox::model()->findByPK($_GET['id']);
		} else {
			$model = new Loginbox();
		}

//		echo $model;

		if(isset($_POST['Loginbox'])){

			$model->attributes = $_POST['Loginbox'];

			if($model->validate()){
				$model->save();

				$this->redirect($this->createUrl('/containr/page/update',array('id'=>Yii::app()->user->lastPID)));
			}
		} else {

			if(isset($_GET['id']) && $_GET['id'] > 0){
				$model = Loginbox::model()->findByPK($_GET['id']);
			}

		}
		$this->render('update',array('model'=>$model,'pageList'=>$this->getPageList()));
	}

	public function actionDelete() {

		$elementId = ContainrElementLib::model()->find('elementId = '.$_GET['id'] . ' AND type = "loginbox"');

		ContainrElementLib::model()->deleteAll('elementId = ' . $_GET['id'] . ' AND type = "loginbox"');
		ContainrElementPageRef::model()->deleteAll('elementId = '.$elementId->id);
		Loginbox::model()->deleteByPK($_GET['id']);

		$this->redirect(Yii::app()->createUrl('/containr/page/update/',array('id'=>$_GET['page'])));
	}

	public function actionDeleteRef() {
		ContainrElementPageRef::model()->deleteByPK($_GET['id']);

		$this->redirect(Yii::app()->createUrl('/containr/page/update/',array('id'=>$_GET['page'])));
	}


	public function getPageList() {
		$pages = ContainrPage::model()->findAll(array('order'=>'lft'));
		$rtn = array(0=>'Please select...');
		foreach ($pages as $page) {
			if ($page->level > 1) {
				$rtn[$page->id] = str_repeat('-', $page->level-2) . $page->navTitle;
			}
		}
		return $rtn;
	}

}
