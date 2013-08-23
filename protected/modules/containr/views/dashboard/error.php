<div class="row-fluid">
	<div class="span3"></div>
	<div class="span6">
		<div class="alert alert-danger">
			<?php
				$this->pageTitle=Yii::app()->name . ' - Error';
			$this->breadcrumbs=array(
				'Error',
			);
			?>
			
			<h2>Error <?php echo $code; ?></h2>
			
			<div class="error">
				<?php echo CHtml::encode($message); ?>
			</div>
		</div>
	</div>
	<div class="span3"></div>
</div>