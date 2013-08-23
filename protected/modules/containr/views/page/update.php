<div class="navbar secondLine">
    <div class="navbar-inner" >
	    <div class="container">
	    	<p class="navbar-text pull-left">
	    		<?php echo $model->title; ?> (<?php echo $model->navTitle; ?>)
	    	</p>

	    	<div class="btn-group pull-right">
	    		<a class="btn" href="<?php echo $this->createUrl('page/settings',array('id'=>$model->id)); ?>"><i class="icon-cog icon-dark"></i></a>
				<a class="btn" href="<?php echo $this->createUrl('page/index'); ?>"><i class="icon-align-justify"></i></a>
				<a class="btn btn-danger" data-toggle="modal" href="#deleteModal"><i class="icon-trash icon-white"></i></a>

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

<div class="row-fluid">
	<div class="span3 treePane">
		<div id="pageTree" data-url="<?php echo $this->createUrl('page/gettree'); ?>">
			<!--
			<ul class="nav nav-list">
				<li class="nav-header">Structure</li>
				<li class="active"><a href="#">Link</a></li>
				<li><a href="#">Link</a></li>
				<li><a href="#">Link</a></li>
				<li><a href="#">Link</a></li>
			</ul>
			-->
		</div><!--/.well -->

		<br/><div class="alert alert-warning">
			<i class="icon-info-sign icon-dark"></i> <strong>Just drag'n'drop!</strong>
			<p>
				You can change the structure of the page tree just by draging and droping the sites to the desired position.
			</p>
		</div>
	</div>

	<div class="span9">
		<div class="row-fluid">
		<?php

			// loop through template structure

			foreach($templateStructure as $row){
				$columnSpan = 12 / sizeof($row);

				echo '<div class="row-fluid" style="margin-bottom: 22px;">';

				foreach($row as $key=>$value){

					echo '<div class="span'.$columnSpan.'">';
						echo '<span class="label column">'.$value.'</span>';

						echo '<div class="btn-group elementAdd pull-right">
							    <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
							    	<i class="icon-plus"></i> Add element
							    	<span class="caret"></span>
							    </a>
							    <ul class="dropdown-menu">';

					    foreach(Yii::app()->getModule('containr')->modules as $modName=>$modSettings) {
					    	echo '<li><a href="'.$this->createUrl($modName.'/plugin/create/page/'.$_GET['id'].'/column/'.$value).'">'.$modSettings['title'].'</a></li>';
					    }

						echo '
							    </ul>
						    </div>';

						if (isset(Yii::app()->user->clipboard) && get_class(Yii::app()->user->clipboard) == 'ContainrContentClipboard' && !Yii::app()->user->clipboard->isEmpty()) {
						echo '<div class="btn-group elementPaste pull-right">
							    <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
							    	<i class="icon-paste"></i> Paste
							    	<span class="caret"></span>
							    </a>
							    <ul class="dropdown-menu clipboardPaste">';

						$arr = Yii::app()->user->clipboard->getContentArray('/'.$this->uniqueid.'/'.$this->action->id,array('id'=>$_GET['id'],'column'=>$value));
						foreach ($arr as $pbitem) {
						    	echo '<li><a href="'.$pbitem['url'].'" title="' . $pbitem['title'] . '"><i class="' . $pbitem['icon'] . '"></i> '.$pbitem['label'].'</a></li>';
						}

						echo '
							    </ul>
						    </div>';

}



						echo '<div class="pagedrop" id="'.$value.'">';


						// get elements from db
						$elementRef = ContainrElementPageRef::model()->sorted()->findAll('pageId = ' . $_GET['id'] . ' AND columnId = "' . $value . '"');

						foreach($elementRef as $ref) {
							$elementDef = $ref->elementDef;
							$type = $elementDef->type;

							$containrInfoView = $this->module->modules[$type]['containrInfoView'];
							$containrModel = $this->module->modules[$type]['containrModel'];

							$element = call_user_func(array($containrModel,'model'))->findByPK($elementDef->elementId);

							// render backend info
							$this->renderPartial($containrInfoView,array('model'=>$element,'refkey'=>$ref->id));
						}

						echo '</div>';
					echo '</div>';
				}


				echo '</div>';
			}
		?>
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
