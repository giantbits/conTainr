<?php
/**
 * GbNavigation is a widget displaying menu items.
 *
 * The menu items are displayed as an HTML list. One of the items
 * may be set as active, which could add an "active" CSS class to the rendered item.
 *
 * To use this widget, specify the "items" property with an array of
 * the menu items to be displayed. Each item should be an array with
 * the following elements:
 * - visible: boolean, whether this item is visible;
 * - label: string, label of this menu item. Make sure you HTML-encode it if needed;
 * - url: string|array, the URL that this item leads to. Use a string to
 *   represent a static URL, while an array for constructing a dynamic one.
 * - pattern: array, optional. This is used to determine if the item is active.
 *   The first element refers to the route of the request, while the rest
 *   name-value pairs representing the GET parameters to be matched with.
 *   When the route does not contain the action part, it is treated
 *   as a controller ID and will match all actions of the controller.
 *   If pattern is not given, the url array will be used instead.
 *
 * @package
 */

class ContainrMenubar extends CWidget
{
	public $items = array();
	public $template = 'navDefault';
	public $imageType = 'jpg';
	public $imagePath = 'images/navi/';
	public $imageVisible = true;
	public $group = 'main';
	public $mainStyle = 'navbar';
	public $itemStyle = 'navitem';
	public $cssClass = 'nav';
	public $sepperator;
	public $entryLevel = 0;
	public $type = 'normal';
	private $breadcrumb;

	/**
	 * Build the navigation
	 */
	public function run() {
		
		switch($this->type){
			case 'normal':
				$this->buildNormal();
				break;
			case 'breadcrumb':
				$this->buildBreadCrumb();
				
				if($this->controller->page != 'home')
					echo '<a href="/">Start</a> ' . $this->breadcrumb;
				else
					echo str_replace('»', '', $this->breadcrumb);
				break;
			case 'full':
				$this->buildNormal(true);
				break;
		}
	}
	
	
	private function buildBreadCrumb($node = null) {
		
		//get current page
		if($node != null) {
			$cmodel = $node;
		} else {
			$cmodel = ContainrPage::model()->find('pageCode = "' . $this->controller->page . '"');
			$this->breadcrumb = ' » <span class="active">' . $this->controller->pageAlias . '</span>';
		}
		
		$tree = $cmodel->getParentNode();
		
		if($tree->level >= 1) {
			if($tree->pageAction != 'actionRedirect')
				$this->breadcrumb = ' » ' . CHtml::Link($tree->pageNameAlias, $this->controller->createUrl('page/index', array('code'=>$tree->pageCode))) . $this->breadcrumb;
			else
				$this->breadcrumb = ' » ' .  $tree->pageNameAlias . $this->breadcrumb;
				
			$this->buildBreadCrumb($tree);
		}
			
		
	}
	
	
	private function buildNormal($full = true) {
		$items = array(); // final array with nav items
		$controller = $this->controller; // the current controller
		$action = $controller->action; // the current action
		
		//get current page
        $cmodel = ContainrPage::model()->find('code = "' . $this->controller->page->code . '"');
        		
		$pages = ContainrPage::model()->sorted()->findAll('level > 1 AND visibleInNav = 1');
		
		//loop through the results
		foreach ($pages as $page) {
		
			$navItem['code'] = $page->code;
			$navItem['url'] = '?page=' . $page->code;
			$navItem['active'] = $this->isActive($page);
			$navItem['label'] = (strlen($page->navTitle)) ? $page->navTitle : $page->title;
            $navItem['level'] = $page->level;			
			
			// add the item to items-array
			$items[] = $navItem;
		}
		
		//add the custom items if they are defined
		foreach ($this->items as $page) {
			if(!isset($page['code'])) $page['code'] = '';
		
			$navItem['url'] = $page['url'];
			$navItem['code'] = $page['code'];
			$navItem['label'] = $page['label'];
			if(isset($_GET['r']))
				$navItem['active'] = ($controller->page == $page['code']) ? true : ($_GET['r'] == str_replace('?r=','',$page['url'])) ? true : false;
			else
				$navItem['active'] = ($controller->page == $page['code']) ? true : false; 
			
			if($this->imageVisible)
				$navItem['image']= '<img src="' . $this->imagePath . $page['code'] .'.' . $this->imageType . '" alt="' . $page['label'] . '" /><br/>';
			
			// add the item to items-array
			$items[] = $navItem;
		}
		
		// render the navigation
		$this->render($this->template, array('items'=>$items, 'mainstyle'=>$this->mainStyle, 'cssclass'=>$this->cssClass, 'sepperator'=>$this->sepperator));
	}


	/**
	 * Detects if the given item is active
	 *
	 * @param unknown $pattern
	 * @param unknown $controllerID
	 * @param unknown $actionID
	 * @return unknown
	 */
	protected function isActive($page) {
		$isActive = false;
		
		if ($this->controller->page->code == $page->code) {
			$isActive = true;
		} else {
			$model = ContainrPage::model()->find('code = "' . $this->controller->page->code . '"');
			
			if($model->level == 2 && ($model->lft > $page->lft && $model->rgt < $page->rgt))
				$isActive = true;		
		}
				
		return $isActive;
	}
}
