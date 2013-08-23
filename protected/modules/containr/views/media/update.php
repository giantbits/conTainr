<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'contentimage-edit-form',
    'inlineErrors'=>true,
    'enableAjaxValidation'=>false,
    'focus'=>array($model,'title')
    ));
?>

<div class="navbar secondLine" data-spy="affix" data-offset-top="11">
    <div class="navbar-inner">
	    <div class="container">

				<div class="btn-group pull-left">
					<!--<a class="btn btn-primary" href="#"><i class="icon-asterisk icon-white"></i> Save</a>-->
					<?php echo CHtml::HtmlButton('Save',array('class'=>'btn btn-primary','onclick'=>'submit();','id'=>'btnSave')); ?>
					<button class="btn btn-warning" data-toggle="modal" href="#cancelModal" id="btnCancel"><i class="icon-exclamation-sign icon-white"></i> Cancel</button>
				</div>

				<?php if($model->id > 1) : ?>
				<div class="btn-group pull-right">
					<a class="btn btn-danger" data-toggle="modal" href="#deleteModal"><i class="icon-trash icon-white"></i></a>
				</div>
				<?php endif; ?>

				<div class="btn-group pull-right">
					<button class="btn" disabled>English</button>
					<button class="btn dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li><a href="#">German</a></li>
						<li><a href="#">French</a></li>
						<li><a href="#">Italian</a></li>
					</ul>
				</div>

	    </div>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<?php
			$errLog = $form->errorSummary($model);
			if(strlen($errLog) == true && isset($_POST['ContainrMedia'])) echo '<div class="alert alert-error">'.$errLog.'</div>';
		?>
	</div>
</div>

<div class="row-fluid">
	<div class="span6">
		<?php echo ContainrMedia::getMediaItem($model->id); ?>
	</div>
	<div class="span6">
		<?php echo $form->textFieldRow($model,'filename',array('class'=>'span12','disabled'=>true)); ?>
		<?php echo $form->textFieldRow($model,'title',array('class'=>'span12')); ?>
		<?php echo $form->textAreaRow($model,'description',array('class'=>'span12')); ?>

		<?php if(strpos($model->type,"image") !== false): ?>
			<?php echo $form->textFieldRow($model,'imageWidth',array('class'=>'span12','disabled'=>true)); ?>
			<?php echo $form->textFieldRow($model,'imageHeight',array('class'=>'span12','disabled'=>true)); ?>
		<?php endif; ?>

		<?php echo $form->textFieldRow($model,'path',array('class'=>'span12','disabled'=>true)); ?>

		<div class="alert alert-info">
			Bild-Dimensionen nach CROP:
			<?php
			$ratio = (4/3);

			if($model->imageWidth > $model->imageHeight) {
				$newWidth = $model->imageHeight * $ratio;
				echo $newWidth . "x" . $model->imageHeight;
				echo CHtml::Link('CROP', Yii::app()->createUrl('containr/media/update',array('id'=>$_GET['id'],'crop'=>'true')),array('class'=>'btn'));

			} else {
				

			}
			echo CHtml::Link('WATERMARK', Yii::app()->createUrl('containr/media/update',array('id'=>$_GET['id'],'watermark'=>'true')),array('class'=>'btn'));

			?>
		</div>
	</div>

</div>

<?php $this->endWidget(); ?>

<!--cancel-->
<div class="modal hide" id="cancelModal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h3>Do you know what you are doing?</h3>
	</div>
	<div class="modal-body">
		<p>You are about to cancel the creation/edit of the current page. All unsaved changes will be gone for ever.</p>
		<p>It's your choice:</p>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn pull-left" data-dismiss="modal">Continue with editing</a>
		<a href="<?php echo $this->createUrl('/containr/media'); ?>" class="btn btn-primary">Discard changes</a>
	</div>
</div>

<!--delete-->
<div class="modal hide" id="deleteModal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h3>You are about to delete the page!</h3>
	</div>
	<div class="modal-body">
		<p>If you continue the page and all it's contents will be transfered to the trash.</p>
	</div>
	<div class="modal-footer">
		<a href="<?php echo $this->createUrl('page/delete',array('id'=>$model->id)); ?>" class="btn btn-danger"><i class="icon-warning-sign icon-white"></i> Delete page</a>
		<a href="#" class="btn pull-left" data-dismiss="modal">Close</a>
	</div>
</div>
