<li class="span2 containrMediaList">
	 <div class="thumbnail">

	 	<div style="margin-bottom: 6px; overflow: hidden; height: 100px;">
			<!--<img src="<?php echo $data->path.$data->filename; ?>" alt="">-->
			<?php

				if($data->type == "application/pdf") {
					echo "PDF";
				} else {
					$this->widget('application.modules.containr.extensions.GbImageHelper', array(
			    		'image' => $data->path.$data->filename,
			    		'size' => 'tiny',
					));
				}
			 ?>
	 	</div>

		<div>
			<?php echo $data->filename; ?>
		</div>

	 	<div style="padding-top: 6px;">
			<strong><?php echo $data->title; ?></strong>
	 	</div>

		<div style="padding-top: 6px;">
			<?php echo $data->description; ?>
		</div>

		<div style="padding-top: 6px;">
			<a class="btn btn-success btn-small btnChoose" id="<?php echo $data->id; ?>" rel="<?php echo $data->path.$data->filename; ?>">Choose</a>
		</div>
	</div>
</li>
