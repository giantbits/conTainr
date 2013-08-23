<ul class="breadcrumb">
	<a href="/containr">Containr</a><span class="divider">/</span><span>Plugins</span><span class="divider">/</span><span>News System</span>
</ul>

<?php

$dataProvider = new CActiveDataProvider('NewsPost');
    
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'htmlOptions'=>array('class'=>''),
    'itemsCssClass'=>'table table-hover',
    'columns'=>array(
        'datePublish',
        'title',  // display the 'title' attribute
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
    ),
));
