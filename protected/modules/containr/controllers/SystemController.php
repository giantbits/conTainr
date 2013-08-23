<?php

class SystemController extends ContainrController
{

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionLogIndex() {

		// read log dir
		$files = CFileHelper::findFiles(Yii::app()->basePath . '/runtime', array('exclude'=>array('state.bin','.svn','/CSS/','/HTML/')));

		// delete logs
		if(isset($_GET['clear'])) {
			$this->delTree('protected/runtime/');
			mkdir('prodtected/runtime/');

			Yii::app()->user->setFlash('log','<div class="alert alert-success">The logfiles have been cleared.</div>');
			$this->redirect($this->createUrl('logIndex'));
		}

		$this->render('log_index', array('files'=>$files));
	}

	public function actionClearCaches() {

		// clear js assets
		$this->delTree('assets/');
		mkdir("assets");

		// clear thumbnails
		// $this->clearThumbnails();

		$this->redirect($this->createUrl('index'));
	}

	private function delTree($dir) {
	    $files = glob( $dir . '*', GLOB_MARK );
	    foreach( $files as $file ){
	        if( substr( $file, -1 ) == '/' ){
	            $this->delTree( $file );
	        } else {
	        	//echo '<br/>'.$file;
	            unlink( $file );
	        }
	    }

	    rmdir( $dir );
	}

	private function clearThumbnails() {
		$files = glob( '_lib/uploads/' . '*', GLOB_MARK );
		foreach( $files as $file ){
			$this->delTree($file.'thumb/');
	    	$this->delTree($file.'tiny/');
	    }
	}

	/******** USER *************/

	public function actionUserIndex() {

		$templates = ContainrTemplate::model()->findAll();

		$this->render('user_index');
	}

	public function actionUserCreate() {
		// load form
		if(isset($_GET['id']))
			$model = ContainrUser::model()->findByPK($_GET['id']);
		else
			$model = new ContainrUser();

		//$this->performAjaxValidation($model);

	    if(isset($_POST['ContainrUser']))
	    {
	        $model->attributes = $_POST['ContainrUser'];
	        if($model->validate())
	        {
	        	$model->password = crypt($model->password);
        		$model->save();

        		// set flash saved
	        	Yii::app()->user->setFlash('saved','true');

	        	//redirect
	        	$this->redirect($this->createUrl('system/userUpdate',array('id'=>$model->id)));
	        }
	    }


		$this->render('user_create',array('model'=>$model));
	}

	public function actionUserUpdate() {
		// load form
		if(isset($_GET['id']))
			$model = ContainrUser::model()->findByPK($_GET['id']);
		else
			$model = new ContainrUser();

		//$this->performAjaxValidation($model);
	    if(isset($_POST['ContainrUser']))
	    {
	        $model->attributes=$_POST['ContainrUser'];
	        if ($model->password != $_POST['ContainrUser']['password'] && strlen($_POST['ContainrUser']['password'])) {
	        	$model->password = crypt($_POST['ContainrUser']['password']);
	        }
	        if($model->validate()) {
        		$model->save();

	        	// set flash saved
	        	Yii::app()->user->setFlash('saved','true');

	        	//redirect
	        	$this->redirect($this->createUrl('system/userUpdate',array('id'=>$model->id)));
	        }
	    }

		$this->render('user_update',array('model'=>$model));
	}

	public function actionUserDelete() {
		if ($_GET['id'] != Yii::app()->user->id) {
			ContainrUser::model()->deleteByPK($_GET['id']);
		}
		$this->redirect(Yii::app()->createUrl('/containr/system/userIndex/'));
	}

	/******** USER *************/











	public function actionNavigationIndex() {

		$navigations = ContainrNavigation::model()->findAll('level = 0');

		$this->render('navigation_index',array('navigation'=>$navigation));
	}

	public function actionNavigationCreate() {
		// load form
		if(isset($_GET['id']))
			$model = ContainrNavigation::model()->findByPK($_GET['id']);
		else
			$model = new ContainrNavigation();

		//$this->performAjaxValidation($model);

	    if(isset($_POST['ContainrNavigation']))
	    {
	        $model->attributes=$_POST['ContainrNavigation'];
	        if($model->validate()) {
        		$model->save();

	        	// set flash saved
	        	Yii::app()->user->setFlash('containrNavigationSaved','true');

	        	//redirect
	        	$this->redirect($this->createUrl('system/navigationUpdate',array('id'=>$model->id)));
	        }
	    }
		$this->render('navigation_create',array('model'=>$model));
	}

	public function actionNavigationUpdate() {
		// load form
		if(isset($_GET['id']))
			$model = ContainrNavigation::model()->findByPK($_GET['id']);
		else
			$model = new ContainrNavigation();

		//$this->performAjaxValidation($model);

	    if(isset($_POST['ContainrNavigation']))
	    {
	        $model->attributes=$_POST['ContainrNavigation'];
	        if($model->validate()) {
        		$model->save();

	        	// set flash saved
	        	Yii::app()->user->setFlash('containrNavigationSaved','true');

	        	//redirect
	        	$this->redirect($this->createUrl('system/navigationUpdate',array('id'=>$model->id)));
	        }
	    }
		$this->render('navigation_update',array('model'=>$model));
	}
}
