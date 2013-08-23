<div class="well sortable" id="elem_<?php echo $refkey; ?>">
    <div class="navbar elementTitle">
	    <div class="navbar-inner">
		    <div class="container">
		    	<span class="navbar-text dragHandle"><i class="icon-align-justify icon-white"></i></span>
			    <span class="navbar-text">News system</span>
				<div class="btn-group pull-right">
					<a href="<?php echo $this->createUrl('/containr/news/plugin/edit/',array('id'=>$model->id)); ?>" class="btn btn-mini btn-success"><i class="icon-pencil icon-white"></i></a>
				    <a href="" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i></a>
			    </div>				     		     
		    </div>
	    </div>
    </div>
	
	
	
<?php
	echo '<strong>'.$model->itemsperpage.'</strong>';
?>
</div>
