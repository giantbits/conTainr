<div class="row-fluid">
	<div style="width: 400px; float: left;">
		<div class="search-form">
			<form class="alert alert-info form-inline">
				<input type="text" name="ContainrMedia[filename]" placeholder="Dateiname" />
				<select name="ContainrMedia[type]">
					<option value="">Dateitypen</option>
					<option value="application/pdf">PDF</option>
					<option value="image/jpeg">JPG</option>
					<option value="image/jpeg">JPEG</option>
					<option value="image/png">PNG</option>
				</select>
				<button type="submit" class="btn"><i class="icon-search"></i></button>
			</form>
		</div>
        <?php

        	Yii::app()->clientScript->registerScript('mediaSearch', "
				$('.search-form form').submit(function(){
				    $.fn.yiiListView.update('mediaItems', {
				        //this entire js section is taken from admin.php. w/only this line diff
				        data: $(this).serialize()
				    });
				    return false;
				});");

        	$dataProvider = new ContainrMedia('search');
    		$dataProvider->unsetAttributes();  // clear any default values


    		if(isset($_GET['ContainrMedia']))
        		$dataProvider->attributes = $_GET['ContainrMedia'];

			$this->widget('zii.widgets.CListView', array(
			    'dataProvider'=>$dataProvider->search(),
			    'id'=>'mediaItems',
			    'itemView'=>'_itemSmall',   // refers to the partial view named '_post'
			    'itemsTagName'=>'ul',
			    'itemsCssClass'=>'thumbnails',
			    'pagerCssClass'=>'pagination pagination-centered pagination pagination-containrMediaModal',
			    'template'=>'{pager}{items}{pager}',
			    'sortableAttributes'=>array(
			        'type',
			        'filename'
			    ),
			    'pager'=>array(
			    	'cssFile'=>false,
			    	'hiddenPageCssClass'=>'disabled',
			    	'header'=>false,
			    	'footer'=>false,
			    	'selectedPageCssClass'=>'active',
			    	'maxButtonCount'=>3,
			    	'lastPageLabel'=>'>>',
			    	'firstPageLabel'=>'<<',
			    	'prevPageLabel'=>'<',
			    	'nextPageLabel'=>'>'
			    )
			));
        ?>
	</div>

	<?php if($hideSelector !== "true"): ?>
	<div style="width: 220px; float: left;">
		<div class="well" style="position: fixed; width: 226px; margin-top: -12px; height: 380px; padding-top: 52px;">
			<b>Settings</b>
			<input type="hidden" id="cmMediaId" class="span12" />
			<label>Alt-text</label>
			<input type="text" id="cmAlt" class="span12" />
			<label>Position</label>
			<input type="text" id="cmPosition" class="span12" />
			<!--
			<label>Margin</label>
			<input type="text" id="cmMarginTop" class="input-tiny" />
			<input type="text" id="cmMarginRight" class="input-tiny" />
			<input type="text" id="cmMarginBottom" class="input-tiny" />
			<input type="text" id="cmMarginLeft" class="input-tiny" />
			-->
			<label>Size</label>
			<select id="cmSize">
				<option>thumb</option>
				<option>big</option>
			</select>

			<button id="cmInsert" class="btn">Insert media</button>
		</div>
		<?php endif; ?>
	</div>
</div>

<?php

$cs = Yii::app()->getClientScript();

$js = '

$(".btnChoose").live("click",function(e){

	$(".thumbnail").css("background-color","transparent");
	$(this).parent().parent().css("background-color","lightgreen");
	$("#cmMediaId").val($(this).attr("id"));
});

';

$cs->registerScript('containrMediaSelector',$js,4);
