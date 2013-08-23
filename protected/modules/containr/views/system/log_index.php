<div class="navbar secondLine" >
    <div class="navbar-inner" >
	    <div class="container">
	    	<p class="navbar-text pull-left">
	    		Logs
	    	</p>
	    	<!--
			<ul class="nav pull-right">	
		    	<li class="dropdown">
		            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Logfile <b class="caret"></b></a>
		            <ul class="dropdown-menu">
		              <?php
		              foreach($files as $file) {
		              	$fileOut = explode("/", $file);
		              	//var_dump($file);
		              	echo '<li>'.CHtml::Link($fileOut[count($fileOut)-1],$this->createUrl('logIndex',array('lf'=>urlencode($file)))).'</li>';
		              }
		              ?>
		              <li class="divider"></li>
		              <li><?php echo CHtml::Link('Clear logs',$this->createUrl('logIndex',array('clear'=>'1'))); ?></li>
		            </ul>
		          </li>
	         </ul>
	     	-->
	    </div>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<?php
			
			$this->widget('application.modules.containr.extensions.loganalyzer.LogAnalyzerWidget', array(
		        'filters' => array('Text filtering','One more'),
		        'title'   => 'System Logs' ,
		        // 'log_file_path' => 'Absolute path of the Log File',
		    )); 
		    
		?>
		<?php 
			if(Yii::app()->user->hasFlash('log'))
				echo Yii::app()->user->getFlash('log');

			if(isset($_GET['lf']))
				echo nl2br(str_replace("[error]",'<span style="color: red;">[error]</span>',str_replace("---","<br/>---<br/><br/>",file_get_contents(urldecode($_GET['lf'])))));
			//else
			//	echo '<div class="alert alert-info"><i class=" icon-info-sign"></i> Please select a log file.</div>'
		?>
	</div>
</div>
