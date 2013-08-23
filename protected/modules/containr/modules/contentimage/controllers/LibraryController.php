<?php

class LibraryController extends ContainrController
{

	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionUpdate()
	{
		$this->render('update');
	}
	
}
