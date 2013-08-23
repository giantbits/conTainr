<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm',
	array(
		'id'=>'verticalForm',
		'enableAjaxValidation'=>false
	)
); ?>

<div class="navbar secondLine" >
    <div class="navbar-inner">
        <div class="container">
            <div class="btn-group pull-left">
                <?php echo CHtml::HtmlButton('Save',array('class'=>'btn btn-primary','onclick'=>'submit();','id'=>'btnSave')); ?>
					<button class="btn btn-warning" data-toggle="modal" href="#cancelModal" id="btnCancel" disabled><i class="icon-exclamation-sign icon-white"></i> Cancel</button>
            </div>

            <div class="btn-group pull-right">
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
		<?php
			echo $form->textFieldRow($model, 'title', array('class'=>'input-xxlarge'));
			echo $form->dropDownListRow($model, 'model', $this->module->formModels);
			echo $form->textFieldRow($model, 'mailRecipient', array('class'=>'input-xxlarge'));
			echo $form->textFieldRow($model, 'mailSubject', array('class'=>'input-xxlarge'));
			echo $form->redactorRow($model, 'successMessage', array('class'=>'input-xxlarge', 'rows'=>5));
			echo $form->redactorRow($model, 'errorMessage', array('class'=>'input-xxlarge', 'rows'=>5));
		?>
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
