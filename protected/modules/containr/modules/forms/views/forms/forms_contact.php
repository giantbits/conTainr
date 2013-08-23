<div class="bootstrap-widget-header">
    <h3>Kontaktanfrage</h3>
</div>
<div class="bootstrap-widget-content">
<?php

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id'=>'verticalForm'));

echo $form->textFieldRow($model, 'name', array('class'=>'span12'));
echo $form->textFieldRow($model, 'email', array('class'=>'span12'));
echo $form->textFieldRow($model, 'subject', array('class'=>'span12'));
echo $form->textAreaRow($model, 'message', array('class'=>'span12', 'rows'=>5));

if(extension_loaded('gd')):

    ?>
    <div class="row-fluid">
		<div class="span12">
            <?php echo $form->labelEx($model,'verifyCode'); ?>
            <br/><?php $this->widget('CCaptcha'); ?>
            <?php echo $form->textField($model,'verifyCode',array('class'=>'span12')); ?>
        </div>
    </div>
<?php
endif;

echo '<div>';
	$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Zurücksetzen'));
	echo '<div class="pull-right">';
	$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Senden'));
	echo '</div>';
echo '</div>';

$this->endWidget();

echo "</div>";
