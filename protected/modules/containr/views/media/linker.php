<div class="row-fluid">
	<div style="width: 415px; float: left;">
		<div class="tabbable" style="position: relative; margin-top: -3px; width: 415px;"> <!-- Only required for left/right tabs -->
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1" data-toggle="tab">Internal link</a></li>
				<li><a href="#tab2" data-toggle="tab">External link</a></li>
				<li><a href="#tab3" data-toggle="tab">Media link</a></li>
				<li><a href="#tab4" data-toggle="tab">E-Mail</a></li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active" id="tab1">
					<div class="control-group">
						<?php

						$pages = ContainrPage::model()->sortedTree()->findAll();

						foreach($pages as $page){
							echo '<div class="controls"' . ($page->level > 2 ? ' style="padding-left: ' . (($page->level-2)*10) . 'px"' : '')  . '>';
							echo '<label class="checkbox"><input class="radio internalselect" type="radio" name="page" value="'.$page->code.'" onclick="$(\'#clInternal\').val($(this).val());"/> '.$page->title.'</label>';
							echo '</div>';
						}
						?>
					</div>
				</div>
				<div class="tab-pane" id="tab2">

					<div class="control-group">
						<label class="control-label" for="externalUrl">External URL</label>
						<div class="controls">
							<div class="input-prepend input-append">
								<input id="clHref" name="clHref" class="span2" type="text" size="16">
								<span class="hint">with http(s):// and www</span>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab3">


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
								    'itemView'=>'_itemSmall',   // refers to the partial view named '_post'
								    'itemsTagName'=>'ul',
								    'id'=>'mediaItems',
								    'itemsCssClass'=>'thumbnails',
								    'pagerCssClass'=>'pagination pagination-centered pagination pagination-containrMediaModal',
								    'template'=>'{pager}{items}{pager}',
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


					<?php

					$cs = Yii::app()->getClientScript();

					$js = '

					$(".btnChoose").live("click",function(e){

						var tar = $(this).attr("rel");

						$("#clHref").val(tar);
						$(".thumbnail").removeClass("active");
						$(this).parent().parent().addClass("active");

					});

					';

					$cs->registerScript('containrMediaSelector',$js,4);

					?>




















				</div>
				<div class="tab-pane" id="tab4">

					<div class="control-group">
						<label class="control-label" for="externalUrl">E-Mail</label>
						<div class="controls">
							<div class="input-prepend input-append">
								<span class="append">mailto::</span><input id="clMail" name="clMail" class="span2" type="text" size="16">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div style="width: 220px; float: left;">
		<div class="well" style="position: fixed; width: 226px; margin-top: -12px; height: 480px;">
			<input type="hidden" id="clHref" value="" />
			<input type="hidden" id="clInternal" value="" />

			<label>Text</label>
			<input type="text" id="clText" class="span12" />

			<label>Target</label>
			<select id="clTarget">
				<option>_self</option>
				<option>_blank</option>
				<option>_top</option>
			</select>

			<button id="clInsert" class="btn pull-right">Insert link</button>
			<!-- transporter fields -->

		</div>
	</div>
</div>
