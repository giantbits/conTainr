<?php

class DashboardController extends ContainrController
{

	public function actionIndex() {

		$this->breadcrumbs=array(
			ucfirst( $this->id ),
			ucfirst( $this->action->id ),
		);

		$this->render('index');
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin() {

		// set special login layout
		$this->layout = 'containr_login';

		$model = new ContainrLoginForm();

		// if it is ajax validation request
		if ( isset( $_POST['ajax'] ) && $_POST['ajax']==='login-form' ) {
			echo CActiveForm::validate( $model );
			Yii::app()->end();
		}

		// collect user input data
		if ( isset( $_POST['ContainrLoginForm'] ) ) {
			$model->attributes=$_POST['ContainrLoginForm'];
			// validate user input and redirect to the previous page if valid
			if ( $model->validate() && $model->login() )
				$this->redirect( Yii::app()->user->returnUrl );
		}
		// display the login form
		$this->render( 'login', array( 'model'=>$model ) );
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect( Yii::app()->createUrl('containr/dashboard/login') );
	}
}
