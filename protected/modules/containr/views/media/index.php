<div class="navbar secondLine" >
    <div class="navbar-inner" >
	    <div class="container">
	    	<p class="navbar-text pull-left">
	    		Media
	    	</p>

	    </div>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<?php
			$this->widget('xupload.XUpload', array(
                'url' => $this->createUrl("uploadlib"),
                'model' => $model,
                'attribute' => 'file',
                'multiple' => true
            ));


            Yii::app()->clientScript->registerScript('mediaSearch', "
				$('.search-form form').submit(function(){
				    $.fn.yiiListView.update('mediaItems', {
				        //this entire js section is taken from admin.php. w/only this line diff
				        data: $(this).serialize()
				    });
				    return false;
				});");
        ?>

		<?php
			$dataProvider = new ContainrMedia('search');
    		$dataProvider->unsetAttributes();  // clear any default values


    		if(isset($_GET['ContainrMedia']))
        		$dataProvider->attributes = $_GET['ContainrMedia'];

        ?>

		<?php
			$this->widget('zii.widgets.CListView', array(
			    'dataProvider'=>$dataProvider->search(),
			    'itemView'=>'_item',   // refers to the partial view named '_post'
			    'itemsTagName'=>'ul',
			    'id'=>'mediaItems',
			    'itemsCssClass'=>'thumbnails',
			    'pagerCssClass'=>'pagination pagination-centered',
			    'pager'=>array(
			    	'cssFile'=>false,
			    	'hiddenPageCssClass'=>'disabled',
			    	'header'=>false,
			    	'footer'=>false,
			    	'selectedPageCssClass'=>'active'
			    ),
			    'sortableAttributes'=>array(
			        'filename',
			        'type',
			    ),
			));
        ?>



	</div>

</div>

<?php

$js = '$(".secondLine > .navbar-inner > .container").append(\'<form class="navbar-form pull-right"><input type="text" class="input-small" name="ContainrMedia[filename]" placeholder="Dateiname" /><select name="ContainrMedia[type]" style="width: auto;"><option value="">Dateitypen</option><option value="application/pdf">PDF</option><option value="image/jpeg">JPG</option><option value="image/jpeg">JPEG</option><option value="image/png">PNG</option></select><button type="submit" class="btn"><i class="icon-search"></i></button></form>\');';

Yii::app()->getClientScript()->registerScript('uploadSearch',$js,4);