<div class="row-fluid">
	<div class="span12">


	    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id'=>'verticalForm')); ?>

	    <div class="navbar secondLine" >
		    <div class="navbar-inner">
			    <div class="container">
				    <div class="btn-toolbar">
					    <div class="btn-group pull-left">
					    	<button class="btn" onclick="window.location.href='<?php echo $this->createUrl('system/userIndex'); ?>';return false;">Back</button>
					    </div>
						<div class="btn-group pull-right">
							<!--<a class="btn btn-primary" href="#"><i class="icon-asterisk icon-white"></i> Save</a>-->
							<?php echo CHtml::HtmlButton('Save',array('class'=>'btn btn-primary','onclick'=>'submit();','id'=>'btnSave')); ?>
							<?php if($model->id > 1) : ?>
								<a class="btn btn-danger" data-toggle="modal" href="#deleteModal"><i class="icon-trash icon-white"></i></a>
							<?php endif; ?>
						</div>
				    </div>
			    </div>
			</div>
		</div>


		<?php
			$errLog = $form->errorSummary($model);
			if(strlen($errLog) == true && isset($_POST['ContainrUser']))
				echo '<div class="alert alert-error">'.$errLog.'</div>';
		?>

	    <?php echo $form->textFieldRow($model, 'nameLast', array('class'=>'span12')); ?>
	    <?php echo $form->textFieldRow($model, 'nameFirst', array('class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'email', array('class'=>'span12')); ?>
		<?php echo $form->textFieldRow($model, 'login', array('class'=>'span12')); ?>
	    <?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span12')); ?>
	    <?php echo $form->dropDownListRow($model, 'role',array(0=>'Rolle', 5=>'Admin')); ?>
	    <?php $this->endWidget(); ?>

	</div>
</div>
