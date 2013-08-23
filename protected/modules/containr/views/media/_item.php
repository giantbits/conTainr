<li class="span3">
	 <div class="thumbnail">

 		<div class="item">
			<?php

			if($data->type == "application/pdf") {
				echo "PDF";
			} else {
				$this->widget('application.modules.containr.extensions.GbImageHelper', array(
			    	'image' => $data->path.$data->filename,
			    	'size' => 'thumb',
				));
			}?>
		</div>
 	
		<h4>
			<?php echo $data->filename; ?>
		</h4>

	 	<p style="padding-top: 6px;">
			<strong><?php echo $data->title; ?></strong>
			<?php echo $data->description; ?>
	 	</p>

		<div style="padding-top: 6px;">
			<a class="btn btn-success btn-small" href="<?php echo $this->createUrl('update',array('id'=>$data->id)); ?>">Edit</a> <a class="btn btn-danger btn-small" href="<?php echo $this->createUrl('delete',array('id'=>$data->id)); ?>">Delete</a>
		</div>
	</div>
</li>
