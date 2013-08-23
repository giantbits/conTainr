<div class="navbar secondLine" >
    <div class="navbar-inner" >
        <div class="container">
            <p class="navbar-text pull-left">
                ConTainr / Plugins / Text (Image)
            </p>
        </div>
    </div>
</div>

<?php

$dataProvider = ContentImage::model();

if(isset($_GET['ContentImage']))
    $dataProvider->attributes = $_GET['ContentImage'];

$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'contentimage',
    'type'=>'striped condensed',
    'dataProvider'=>$dataProvider->search(),
    'htmlOptions'=>array('class'=>''),
    'itemsCssClass'=>'table striped condensed',
    'filter'=>$dataProvider,
    'template'=>'{items}{pager}',
    'afterAjaxUpdate'=>'function(){ $("td a.delete").addClass("btn").addClass("btn-danger"); $("td a.update").addClass("btn").addClass("btn-success"); }',
    'columns'=>array(
        'title', // display the 'title' attribute
        array(
        	'name'=>null,
        	'value'=>'$data->pagelist',
            'header'=>'Pages',
        	'type'=>'raw'
        ),
        array( // display a column with "view", "update" and "delete" buttons
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}&nbsp;&nbsp;{delete}',
            'updateButtonUrl'=>'Yii::app()->createUrl("containr/contentimage/plugin/update", array("id"=>$data->id))',
            'htmlOptions'=>array('style'=>'width: 90px')
        ),
    ),
));
