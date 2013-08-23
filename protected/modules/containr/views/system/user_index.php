<div class="row-fluid">
	<div class="span12">
		<div class="navbar secondLine" >
		    <div class="navbar-inner" >
			    <div class="container">
			    	<p class="navbar-text pull-left">
			    		Benutzer
			    	</p>
			    	<a class="btn btn-success pull-right" href="<?php echo $this->createUrl('usercreate'); ?>"><i class="icon-plus icon-white"></i> Neuen Nutzer anlegen</a>
			    </div>
			</div>
		</div>

		<?php

		$gridColumns = array(
			array('name'=>'nameFirst', 'header'=>'First name'),
			array('name'=>'nameLast', 'header'=>'Last name'),
			array('name'=>'login', 'header'=>'login'),
			array( // display a column with "view", "update" and "delete" buttons
	            'class'=>'bootstrap.widgets.TbButtonColumn',
	            'template'=>'{update}&nbsp;&nbsp;{delete}',
	            'updateButtonUrl'=>'Yii::app()->createUrl("containr/system/userUpdate", array("id"=>$data->id))',
	            'deleteButtonUrl'=>'Yii::app()->createUrl("containr/system/userDelete", array("id"=>$data->id))',
	            'htmlOptions'=>array('style'=>'width: 90px'),
				'buttons'=>array(
					'delete'=>array(
						'visible'=>'$data->id!=Yii::app()->user->id',
					),
				),
			),
		);

		$model = new ContainrUser('search');

		if (isset($_GET['ContainrUser']))
        	$model->attributes = $_GET['ContainrUser'];

		$this->widget('bootstrap.widgets.TbGridView', array(
		    'type'=>'table datatable striped condensed',
		    'dataProvider'=>$model->search(),
		    'template'=>"{items}{pager}",
		    'filter'=>$model,
		    'columns'=>$gridColumns,
		    'afterAjaxUpdate'=>'function(){ $("td a.delete").addClass("btn").addClass("btn-danger"); $("td a.update").addClass("btn").addClass("btn-success"); }'
		));
		?>
	</div>
</div>
