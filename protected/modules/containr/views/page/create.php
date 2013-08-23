<?php
	//echo CHtml::beginForm('','post',array('class'=>'form'));

	$form = $this->beginWidget('CActiveForm', array(
	    'id'=>'page-form',
	    'enableAjaxValidation'=>true,
	    'enableClientValidation'=>false,
	    'errorMessageCssClass'=>'alert alert-error',
	    'focus'=>array($model,'title'),
	));
?>

<div class="navbar secondLine" >
    <div class="navbar-inner">
	    <div class="container">
			<div class="btn-group pull-left">
				<!--<a class="btn btn-primary" href="#"><i class="icon-asterisk icon-white"></i> Save</a>-->
				<?php echo CHtml::HtmlButton('Save',array('class'=>'btn btn-primary','onclick'=>'submit();','id'=>'btnSave','disabled'=>'disabled')); ?>
				<button class="btn btn-warning" data-toggle="modal" href="#cancelModal" id="btnCancel"><i class="icon-exclamation-sign icon-white"></i> Cancel</button>
			</div>
	    </div>
	</div>
</div>

<div class="row-fluid">
	<div class="span8">

			<?php
				$errLog = $form->errorSummary($model);
				if(strlen($errLog) == true && isset($_POST['ContainrPage'])) echo '<div class="alert alert-error">'.$errLog.'</div>';
			?>

			<fieldset>
				<legend>Primary page info</legend>

				<div class="control-group">
					<?php echo $form->labelEx($model,'title', array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textField($model,'title',array('class'=>'input-xxlarge')); ?>
						<?php echo $form->error($model,'title'); ?>
					</div>
				</div>

				<div class="control-group">
					<?php echo $form->labelEx($model,'navTitle', array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textField($model,'navTitle',array('class'=>'input-xxlarge')); ?>
						<?php echo $form->error($model,'navTitle'); ?>
					</div>
				</div>

				<div class="control-group">
					<?php echo $form->labelEx($model,'metaDescription', array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textArea($model,'metaDescription',array('class'=>'input-xxlarge')); ?>
						<?php echo $form->error($model,'metaDescription'); ?>
					</div>
				</div>

				<div class="control-group">
					<?php echo $form->labelEx($model,'metaKeywords', array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textArea($model,'metaKeywords',array('class'=>'input-xxlarge')); ?>
						<?php echo $form->error($model,'metaKeywords'); ?>
					</div>
				</div>

			</fieldset>

	</div>

	<div class="span4">
		<div class="well">

			<fieldset>
				<legend>Page settings</legend>

				<div class="control-group">
					<?php echo $form->labelEx($model,'visibleInNav', array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->checkBox($model,'visibleInNav'); ?><span class="help-inline">Should the page be visible in the navigation?</span>
						<?php echo $form->error($model,'visibleInNav'); ?>
					</div>
				</div>

				<div class="control-group">
					<?php echo $form->labelEx($model,'template', array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->dropdownList($model,'template',$templateList); ?>
						<?php echo $form->error($model,'template'); ?>
					</div>
				</div>
				<div class="control-group">
					<?php echo $form->labelEx($model,'visibleForGroup', array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->hiddenField($model,'visibleForGroup',array('value'=>'')); /* Add hidden field, so it is submitted when the select is empty */ ?>
						<?php echo $form->dropdownList($model,'visibleForGroup',ContainrUserGroup::getGroupArray(true),array('multiple'=>'true')); ?>
						<?php echo $form->error($model,'visibleForGroup'); ?>
					</div>
				</div>
			</fieldset>

		</div>

		<div class="alert alert-info">
			<i class="icon-info-sign icon-white"></i> <strong> Some tips for you...</strong>
			<p>
				Please fill out the form on the right as complete as possible.
				You can skip information like description and keywors. But doing so will have a bad impact on search results.
			</p>
		</div>

	</div>

</div>


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

<?php $this->endWidget(); ?>
