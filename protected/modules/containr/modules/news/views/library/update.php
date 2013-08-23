<?php 
	//echo CHtml::beginForm('','post',array('class'=>'form')); 
	
	$form = $this->beginWidget('CActiveForm', array(
	    'id'=>'news-post-form',
	    'enableAjaxValidation'=>true,
	    'enableClientValidation'=>false,
	    'errorMessageCssClass'=>'alert alert-error',
	    'focus'=>array($model,'title'),
	)); 
?>

<div class="navbar">
    <div class="navbar-inner navbar-light">
	    <div class="container">
		    <div class="btn-toolbar">
				<div class="btn-group pull-left">
					<!--<a class="btn btn-primary" href="#"><i class="icon-asterisk icon-white"></i> Save</a>-->
					<?php echo CHtml::HtmlButton('Save',array('class'=>'btn btn-primary','onclick'=>'submit();','id'=>'btnSave','disabledd'=>'disabled')); ?>
					<button class="btn btn-warning" data-toggle="modal" href="#cancelModal" id="btnCancel" disabled><i class="icon-exclamation-sign icon-white"></i> Cancel</button>
				</div>		
				
				<?php if($model->id > 1) : ?>
				<div class="btn-group pull-right">
					<a class="btn" href="<?php echo $this->createUrl('page/update',array('id'=>$model->id)); ?>"><i class="icon-cog icon-pencil"></i></a>
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
</div>

<div class="row-fluid">
	<div class="span8">
		
		 
			<?php 
				$errLog = $form->errorSummary($model);
				if(strlen($errLog) == true && isset($_POST['ContainrPage'])) echo '<div class="alert alert-error">'.$errLog.'</div>';
			?>

			<fieldset>
				<legend>Primary page info</legend>
				
				<?php if(Yii::app()->user->hasFlash('postSaved')): ?>
				    <div class="alert alert-success">
					    <a class="close" data-dismiss="alert" href="#">×</a>
					    <h4 class="alert-heading">Post saved!</h4>
					    Well done mate! The news post was saved and you can go on with the editing.
				    </div>
				<?php endif; ?>
				
				<div class="control-group">
					<?php echo $form->labelEx($model,'title', array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textField($model,'title',array('class'=>'input-xxlarge')); ?>
						<?php echo $form->error($model,'title'); ?>
					</div>
				</div>

				<div class="control-group">
					<?php echo $form->labelEx($model,'teaser', array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textArea($model,'teaser',array('class'=>'input-xxlarge')); ?>
						<?php echo $form->error($model,'teaser'); ?>
					</div>
				</div>
				
				<div class="control-group">
					<?php echo $form->labelEx($model,'content', array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textArea($model,'content',array('class'=>'input-xxlarge')); ?>
						<?php echo $form->error($model,'content'); ?>
					</div>
				</div>

			</fieldset>
		
	</div>

	<div class="span4">
	
		<div class="well">
			<fieldset>
				<legend>Post settings</legend>

				<div class="control-group">
					<?php echo $form->labelEx($model,'datePublish', array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textField($model,'datePublish'); ?>
						<?php echo $form->error($model,'datePublish'); ?>
					</div>
				</div>
				
				<div class="control-group">
					<?php echo $form->labelEx($model,'dateUnpublish', array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textField($model,'dateUnpublish'); ?>
						<?php echo $form->error($model,'dateUnpublish'); ?>
					</div>
				</div>


			</fieldset>
		</div>

		<div class="alert alert-info">
			<i class="icon-info-sign icon-white"></i> <strong> Some tips for you...</strong>
			<p>
				Please fill out the form on the left as complete as possible. 
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

<?php $this->endWidget(); ?>
