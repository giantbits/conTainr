		<div id="ct_<?php echo $model->id; ?>" class="ct_contentImage" style="margin-bottom: 22px;">
			<?php
				if($model->mediaId) ContainrMedia::getMediaItem($model->mediaId);
			?>

			<?php if ( $model->showHeadline == 1 ): ?>
			<div class="bootstrap-widget-header">
				<h3><?php echo $model->title; ?></h3>
			</div>
			<?php endif; ?>

			<div id="yw1" class="bootstrap-widget-content">
			<h4><?php echo $model->teaser; ?></h4>

				<?php echo $model->content; ?>
			</div>
		</div>
