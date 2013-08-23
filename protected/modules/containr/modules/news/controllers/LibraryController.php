<?php

class LibraryController extends ContainrController
{

	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionUpdate()
	{
	
		// load form
		if(isset($_GET['id'])) 
			$model = NewsPost::model()->findByPK($_GET['id']);
		
		$this->performAjaxValidation($model);

	    if(isset($_POST['NewsPost']))
	    {
	        $model->attributes=$_POST['NewsPost'];
	        if($model->validate()) {

        		$model->save();

        		// set flash saved
	        	Yii::app()->user->setFlash('postSaved','true');
	        	
	        	//redirect
	        	$this->redirect($this->createUrl('update',array('id'=>$model->id)));
	        }	        	
	    }

	
		$this->render('update',array('model'=>$model));
	}
	
	public function actionCreate()
	{
	
		// load form
		$model = new NewsPost();
		
		$this->performAjaxValidation($model);

	    if(isset($_POST['NewsPost']))
	    {
	        $model->attributes=$_POST['NewsPost'];
	        if($model->validate()) {

        		$model->save();

        		// set flash saved
	        	Yii::app()->user->setFlash('postSaved','true');
	        	
	        	//redirect
	        	$this->redirect($this->createUrl('update',array('id'=>$model->id)));
	        }	        	
	    }

	
		$this->render('create',array('model'=>$model));
	}
	
	protected function performAjaxValidation($model)
	{
	    if(isset($_POST['ajax']) && $_POST['ajax']==='news-post-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	}
	
}
