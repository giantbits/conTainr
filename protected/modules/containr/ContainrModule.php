<?php
/**
 * ContainrModule class file.
 *
 * @author Steffen Gudis <steffen.gudis@gmail.com>
 * @link http://www.giantbits.com/
 * @copyright Copyright &copy; 2008-2012 giantbits.com
 * @license http://www.giantbits.com/license/
 */

class ContainrModule extends ContainrWebModule
{

	public $analytics = array();

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
		parent::init();

		Yii::app()->setComponents(array(
			'errorHandler'=>array(
				'errorAction'=>'containr/dashboard/error',
			),
			'image'=>array(
				'class'=>'application.modules.containr.extensions.image.CImageComponent',
				// GD or ImageMagick
				'driver'=>'GD',
				// ImageMagick setup path
				'params'=>array('directory'=>'/opt/local/bin'),
	        ),
	        'widgetFactory'=>array(
	            'widgets'=>array(
	                'GbImageHelper'=>array(
	                    'sizes' =>array(
	                    	'tiny' => array('width' => 60, 'height' => 60),
							'thumb' => array('width' => 240, 'height' => 180),
							'big' => array('width' => 600, 'height' => 480),
						),
	                ),
	            ),
	        )
	    ));

		// import the module-level models and components
		$imports = array(
			'containr.models.*',
			'containr.components.*',
			'containr.extensions.image.*',
			'containr.extensions.image.drivers.*',
			'containr.helpers.*',
		);

		$modules = array();
		$this->readModules($imports,$modules);

		$this->setImport($imports);
		$this->setModules($modules);

		$this->defaultController = 'dashboard';
	}

	public function readModules(&$imports,&$modules) {
		$modulesDir = dirname(__FILE__) . '/modules/';
		$files = scandir($modulesDir);
		foreach ($files as $file) {
			if (substr($file,0,1) != '.' && is_dir($modulesDir . $file)) {
				//read config
				if (file_exists($modulesDir . $file . '/config.php')) {
					$config = include($modulesDir . $file . '/config.php');
					if (is_array($config)) {
						$modules[$file] = $config;
						//set model import
						if (file_exists($modulesDir . $file . '/models') && is_dir($modulesDir . $file . '/models')) {
							$imports[] = 'containr.modules.' . $file . '.models.*';
						}
					}
				}
			}
		}
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

}
