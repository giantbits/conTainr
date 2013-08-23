<div class="bootstrap-widget-header">
    <h3>Registration</h3>
</div>
<div class="bootstrap-widget-content">
	<p>Thank you - your registration was successful.</p>
<?php
if ($model->doubleoptin > 0) {
?>	<p>However, you need to activate your account, please check your emails for further instructions.</p>
<?
}
?>
</div>