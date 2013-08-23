<?php

class ContainrWebModule extends CWebModule
{
	private $_assetsUrl;
	public $title;
	public $modulePath;
	public $containrInfoView;
	public $containrModel;
	public $frontendViews;
	public $frontendModel;
	public $frontendWidget;

	public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                Yii::getPathOfAlias('containr.assets') );
        return $this->_assetsUrl;
    }
}
