<?php

$content = '<strong>'.$model->title.'</strong>';

$this->renderPartial('application.modules.containr.views.content.contentObject',
	array(
		'title'=>'Forms plugin',
		'refkey'=>$refkey,
		'model'=>$model,
		'content'=>$content,
		'moduleName'=>'forms'
	));
