<?php
if ($model->showHeadline != 0) {
?><div class="bootstrap-widget-header">
    <h3><?php echo $model->title ?></h3>
</div>
<?php
}
?>
<div class="bootstrap-widget-content">
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id'=>'verticalForm'));
echo $form->textFieldRow($formModel, 'username', array('class'=>'span12'));
echo $form->passwordFieldRow($formModel, 'password', array('class'=>'span12'));
$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Login'));

$this->endWidget();
$links = array();
if ($model->enableRegistration == 1)  {
	$links[] = '<a href="' . Yii::app()->createUrl('page:'.$_GET['contentPageId'],array('mode'=>'register')) . '">Register</a>';
}
//$links[] = '<a href="' . $this->createUrl('/'.$_GET['code'],array('mode'=>'forgotpw')) . '">Forgot password?</a>';
echo '<p>' . implode(' | ',$links) . '</p>';
echo "</div>";
