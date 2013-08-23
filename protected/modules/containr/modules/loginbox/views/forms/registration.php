<div class="bootstrap-widget-header">
    <h3>Registration</h3>
</div>
<div class="bootstrap-widget-content">
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id'=>'verticalForm'));
echo $form->textFieldRow($formModel, 'firstname', array('class'=>'span12'));
echo $form->textFieldRow($formModel, 'lastname', array('class'=>'span12'));
echo $form->textFieldRow($formModel, 'username', array('class'=>'span12'));
echo $form->passwordFieldRow($formModel, 'password', array('class'=>'span12'));
echo $form->passwordFieldRow($formModel, 'passwordRepeat', array('class'=>'span12'));
echo $form->textFieldRow($formModel, 'email', array('class'=>'span12'));
$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Register'));

$this->endWidget();
echo "</div>";
