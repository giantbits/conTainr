<?php
$this->beginWidget("bootstrap.widgets.TbBox",array(
	"title"=>$title,
	"headerIcon"=>"icon-align-justify icon-white dragHandle",
	"htmlOptions"=>array("class"=>"sortable","id"=>"elem_".$refkey),
	"headerButtons"=>array(
		array(
			'class' => 'bootstrap.widgets.TbButtonGroup',
			'size' => 'small',
			'buttons'=>array(
				array('icon'=>'icon-copy', 'url'=>$this->createUrl('/'.$this->uniqueid.'/'.$this->action->id,array('id'=>$_GET['id'],'action'=>'copy','refkey'=>$refkey))),
				array('icon'=>'icon-cut', 'url'=>$this->createUrl('/'.$this->uniqueid.'/'.$this->action->id,array('id'=>$_GET['id'],'action'=>'cut','refkey'=>$refkey))),
				array('icon'=>'icon-pencil', 'url'=>$this->createUrl('/containr/' . $moduleName . '/plugin/update/',array('id'=>$model->id,'refkey'=>$refkey))),
				array('icon'=>'icon-trash', 'htmlOptions'=>array('data-toggle'=>'modal','data-target'=>'#delContentObj'.$model->id.'_'.$refkey)),
			)
		)
	)
));
echo $content;

$this->endWidget();

$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'delContentObj'.$model->id.'_'.$refkey)); ?>
	 <div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h4>Delete reference or object?</h4>
	</div>

	<div class="modal-body">
		<p>Please choose wether to just delete the reference to the object on this page or the whole object and all it's references from the library.</p>
	</div>

	<div class="modal-footer">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'type'=>'primary',
			'label'=>'Delete reference',
			'url'=>'#',
			'htmlOptions'=>array(
					'onclick'=>'location.href="'.$this->createUrl('/containr/' . $moduleName . '/plugin/deleteref/',array('id'=>$refkey,'page'=>$_GET['id'])).'";',
					'data-dismiss'=>'modal'
				),
			));
		?>

		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'type'=>'primary',
			'label'=>'Delete object',
			'url'=>'#',
			'htmlOptions'=>array(
					'onclick'=>'location.href="'.$this->createUrl('/containr/' . $moduleName . '/plugin/delete/',array('id'=>$model->id,'page'=>$_GET['id'])).'";',
					'data-dismiss'=>'modal'
				),
			));
		?>

		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Close',
			'url'=>'#',
			'htmlOptions'=>array('data-dismiss'=>'modal'),
			));
		?>
	</div>
<?php
$this->endWidget();
