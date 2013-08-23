<?php

class PluginController extends ContainrController
{

	public function init() {

		// set default containr layout
		parent::init();
	}

	public function actionIndex() {
		$this->render( 'index' );
	}

	public function actionCreate() {
		$model = new FormsPlugin();

		if ( isset( $_POST['FormsPlugin'] ) ) {
			$model->attributes = $_POST['FormsPlugin'];

			if ( $model->validate() ) {
				$model->save();
				$this->redirect( $this->createUrl( '/containr/forms/plugin/update/', array( 'id'=>$model->id ) ) );
			}
		}

		$this->render( 'create', array( 'model'=>$model ) );
	}

	public function actionUpdate() {
		if ( isset( $_GET['id'] ) && $_GET['id'] > 0 ) {
			$model = FormsPlugin::model()->findByPK( $_GET['id'] );
		}

		if ( isset( $_POST['FormsPlugin'] ) ) {

			$model->attributes = $_POST['FormsPlugin'];

			if ( $model->validate() ) {
				$model->save();

				$this->redirect( $this->createUrl( '/containr/forms/plugin/update/', array( 'id'=>$model->id ) ) );
			}
		}

		$this->render( 'update', array( 'model'=>$model ) );
	}

	public function actionDelete() {

		$elementId = ContainrElementLib::model()->find('elementId = '.$_GET['id'] . ' AND type="forms"');

		ContainrElementLib::model()->deleteAll('elementId = ' . $_GET['id'] . ' AND type="forms"');
		ContainrElementPageRef::model()->deleteAll('elementId = '.$elementId->id);
		FormsPlugin::model()->deleteByPK($_GET['id']);

		$this->redirect(Yii::app()->createUrl('/containr/page/update/',array('id'=>$_GET['page'])));
	}

	public function actionDeleteRef() {
		ContainrElementPageRef::model()->deleteByPK($_GET['id']);

		$this->redirect(Yii::app()->createUrl('/containr/page/update/',array('id'=>$_GET['page'])));
	}

}
