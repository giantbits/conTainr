<?php

$content = '<strong>'.$model->title.'</strong>';
$content .= '</br></br><i>'.$model->teaser.'</i>';
$content .= '</br></br>'.$model->content;

$this->renderPartial('application.modules.containr.views.content.contentObject',
	array(
		'title'=>'Text (with image)',
		'refkey'=>$refkey,
		'model'=>$model,
		'content'=>$content,
		'moduleName'=>'contentimage'
));
