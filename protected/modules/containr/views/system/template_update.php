<?php 
	//echo CHtml::beginForm('','post',array('class'=>'form')); 
	
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	    'id'=>'template-form',
	    'enableAjaxValidation'=>false,
		'enableClientValidation'=>false,
	    'focus'=>array($model,'title')
	)); 
?>
<div class="row-fluid">
	<div class="span12">		
		<div class="navbar secondLine">
		    <div class="navbar-inner navbar-light">
			    <div class="container">
				    <div class="btn-toolbar">
					    <div class="btn-group pull-left">
					    	<button class="btn" onclick="window.location.href ='<?php echo $this->createUrl('system/templateIndex'); ?>';return false;">Back</button>
					    </div>
						<div class="btn-group pull-right">
							<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Save', 'type'=>'primary')); ?>

							<?php if($model->id >= 1) : ?>
								<a class="btn btn-danger" data-toggle="modal" href="#deleteModal"><i class="icon-trash icon-white"></i></a>		
							<?php endif; ?>
						</div>
				    </div>
			    </div>
			</div>
		</div>	
		
		<?php 
				$errLog = $form->errorSummary($model);
				if(strlen($errLog) == true && isset($_POST['ContainrTemplate'])) echo '<div class="alert alert-error">'.$errLog.'</d>';
			?>

		<fieldset>
			<legend>Primary template info</legend>
						
			<?php if(Yii::app()->user->hasFlash('containrTemplateSaved')): ?>
			    <div class="alert alert-success">
				    <a class="close" data-dismiss="alert" href="#">×</a>
				    <h4 class="alert-heading">Template saved!</h4>
				    Well done mate! The template was saved and you can go on with the editing.
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
				<?php echo $form->labelEx($model,'file', array('class'=>'control-label')); ?>
				<div class="controls">
					<?php echo $form->textField($model,'file',array('class'=>'input-xxlarge')); ?>
					<?php echo $form->error($model,'file'); ?>
				</div>
			</div>
			
			<div class="control-group">
				<?php echo $form->labelEx($model,'thumbnail', array('class'=>'control-label')); ?>
				<div class="controls">
					<?php echo $form->textField($model,'thumbnail',array('class'=>'input-xxlarge')); ?>
					<?php echo $form->error($model,'thumbnail'); ?>
				</div>
			</div>
			
			<div class="control-group">
				<?php echo $form->labelEx($model,'structure', array('class'=>'control-label')); ?>
				<div class="controls">
					<?php echo $form->textArea($model,'structure',array('class'=>'input-xxlarge')); ?>
					<?php echo $form->error($model,'structure'); ?>
				</div>
			</div>
			
		</fieldset>
	</div>
</div>
<?php $this->endWidget(); ?>
