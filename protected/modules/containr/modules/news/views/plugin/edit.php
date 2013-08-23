<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-plugin-edit-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="navbar">
    <div class="navbar-inner navbar-light">
	    <div class="container">
		    <div class="btn-toolbar">
				<div class="btn-group pull-left">
					<!--<a class="btn btn-primary" href="#"><i class="icon-asterisk icon-white"></i> Save</a>-->
					<?php echo CHtml::HtmlButton('Save',array('class'=>'btn btn-primary','onclick'=>'submit();','id'=>'btnSave','disabled'=>'disabled')); ?>
					<button class="btn btn-warning" data-toggle="modal" href="#cancelModal" id="btnCancel" disabled><i class="icon-exclamation-sign icon-white"></i> Cancel</button>
				</div>		
				
				<?php if($model->id > 1) : ?>
				<div class="btn-group pull-right">
					<a class="btn" href="<?php echo $this->createUrl('page/update',array('id'=>$model->id)); ?>"><i class="icon-cog icon-pencil"></i></a>
					<a class="btn btn-danger" data-toggle="modal" href="#deleteModal"><i class="icon-trash icon-white"></i></a>
				</div>			
				<?php endif; ?>
				
				<!--
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
				-->
		    </div>
	    </div>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<?php 
			$errLog = $form->errorSummary($model);
			if(strlen($errLog) == true && isset($_POST['ContentImage'])) echo '<div class="alert alert-error">'.$errLog.'</div>';
		?>
	</div>
</div>

<div class="row-fluid">
	<div class="span6">
	
		<div class="control-group">
			<?php echo $form->labelEx($model,'headline',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'headline',array('class'=>'input-xxlarge')); ?>
				<?php echo $form->error($model,'headline'); ?>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->labelEx($model,'itemsperpage',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->textField($model,'itemsperpage',array('class'=>'input-xxlarge')); ?>
				<?php echo $form->error($model,'itemsperpage'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model,'type',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->dropdownList($model,'type',array(0=>'Choose',1=>'News list',2=>'Detail view'),array('class'=>'input-xxlarge')); ?>
				<?php echo $form->error($model,'type'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<?php echo $form->labelEx($model,'pager',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->checkBox($model,'pager'); ?> <span class="help-inline">Show pager?</span>
				<?php echo $form->error($model,'pager'); ?>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->labelEx($model,'detailpage',array('class'=>'control-label')); ?>
			<div class="controls">
				<?php echo $form->checkBox($model,'detailpage'); ?> <span class="help-inline">Detail page?</span>
				<?php echo $form->error($model,'detailpage'); ?>
			</div>
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
		<a href="#" class="btn pull-left" data-dismiss="modal">Close this and continue with editing</a>
		<a href="<?php echo $this->createUrl('page/index'); ?>" class="btn btn-primary">Discard changes and cancel everything</a>
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
