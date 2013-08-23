<div class="navbar secondLine" >
    <div class="navbar-inner" >
	    <div class="container">
	    	<p class="navbar-text pull-left">
	    		Pages
	    	</p>

	    	<a class="btn btn-success pull-right" href="<?php echo $this->createUrl('page/create'); ?>"><i class="icon-plus icon-white"></i> Create new page</a>
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
			<div class="span12">

			</div>
		</div>
	</div>
</div>
