<div class="row-fluid">
	<div class="span12">
		<ul class="thumbnails">
		<?php foreach($templates as $template) { ?>			
		    <li class="span3 alert alert-info alert-templateitem" 
		    	onclick="window.location.href='<?php echo $this->createUrl('system/templateUpdate',array('id'=>$template->id)); ?>';">
	    		<img src="<?php echo $template->thumbnail; ?>"/><br><?php echo $template->title; ?>
		    </li>
		<?php	}	?>
		    <li class="span3 alert alert-success alert-templateitem" 
		    	onclick="window.location.href='<?php echo $this->createUrl('system/templateCreate'); ?>';">+<br/>Add new template
		    </li>
	    </ul>
	</div>
</div>