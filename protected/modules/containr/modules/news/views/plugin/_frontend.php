<?php 

$displayMode = $model->type;
$itemsPerPage = $model->itemsperpage;
$showPager = $model->pager;
$headline = $model->headline;

if($displayMode == '1'){

	echo "<h3>" . $headline . "</h3>";
	
	$dataProvider = new CActiveDataProvider('NewsPost', array(
		'pagination'=>array(
			'pageSize'=>$itemsPerPage
		)
	));
	
	$this->widget('zii.widgets.CListView', array(
	    'dataProvider'=>$dataProvider,
	    'itemView'=>'application.modules.containr.modules.news.views.plugin._post',
	    'itemsCssClass'=>'items clearfix',
	    'summaryText'=>false,
	    //'enablePagination'=>false,
	    'enableSorting'=>false,
	    'template'=>'{pager}{items}',
	    'pager'=>array(
	    	'maxButtonCount'=>0,
	    	'class'=>'bootstrap.widgets.TbPager', 
	    	'alignment'=>'centered',
	    )
	));
	
} else {
 	$newsItem = NewsPost::model()->findByPK($_GET['id']);
 	$this->renderPartial('_postDetail',array($model=>$newsItem));
} ?>
