<?php

class ContentImageWidget extends ContainrBaseWidget
{

    public $pageCode = '';

    public function init() {
        // this method is called by CController::beginWidget()
    }

    public function run() {

        //$model = ContentImage::model()->findByPK( $this->elemId );
        $model = ContentImage::model()->localized()->findByPK( $this->elemId );

        switch ( $this->template ) {
        case 'relatedcontent':
            $this->controller->renderPartial( 'application.modules.containr.modules.contentimage.views.plugin._relatedcontent', array( 'model'=>$model ) );
            break;
        default:
            $this->controller->renderPartial( 'application.modules.containr.modules.contentimage.views.plugin._maincontent', array( 'model'=>$model ) );
        }

    }

}
