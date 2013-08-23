<?php 

$formModelName = ucfirst($model->model.'Form');
$formModel = new $formModelName;

if(isset($_POST[$formModelName])) {
	$formModel->attributes = $_POST[$formModelName];

	if($formModel->validate()) {

		$formModel->submit($model);
		echo '<div class="alert alert-success">'.$model->successMessage.'</div>';
	} else {
		echo '<div class="alert alert-danger">'.$model->errorMessage.'</div>';

		$this->renderPartial('application.modules.containr.modules.forms.views.forms.forms_'.$model->model,array('model'=>$formModel));
	}
} else {
	$this->renderPartial('application.modules.containr.modules.forms.views.forms.forms_'.$model->model,array('model'=>$formModel));	
}
