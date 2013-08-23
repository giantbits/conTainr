<?php
class ContainrBehavior extends CBehavior
{

	public $page;
	public $theme;
	public $template;
	public $dynamicContent = array();

	/**
	 * fetch page out of database
	 *
	 * @return void
	 */
	public function buildPage() {

		// get current template
		$this->getThemeSettings();

		// logout
		if(isset($_GET['logout']) && $_GET['logout'] == 1) {
			Yii::app()->user->logout();
			$this->owner->redirect(Yii::app()->createUrl("site/index",array('code'=>'home')));
		}

		// get page code from GET-Vars
		if (isset($_GET['contentPageId']) && $_GET['contentPageId'] != -1) {
			$page = ContainrPage::model()->findByPk($_GET['contentPageId']);
		} else {
			$page = ContainrPage::model()->find( 'code = "'.$_GET['code'].'"' );
		}

		//access controll
		$accessible = false;
		if (!is_null($page)) {
			$accessible = ContainrUserGroup::checkPageAccessForCurrentUser($page);
			$_GET['contentPageId'] = $page->id;
		}

		if ( !$page || !$accessible) {
			throw new CHttpException( 404, 'The specified page cannot be found.' );
		} else {
			$this->page = $page;
			$this->template = $this->theme->templates->{$page->template};
			$this->renderPage();
		}
	}

	/**
	 * Redners the page
	 *
	 * @return void
	 */
	public function renderPage() {
		$this->owner->layout = 'main';
		$this->owner->pageTitle = $this->page->title;

		// fetch template structure
		$structure = json_decode( $this->template->structure );

		foreach ( $structure as $row ) {

			foreach ( $row as $key=>$value ) {

				if ( !isset( $this->dynamicContent[$value] ) ) $this->dynamicContent[$value] = "";

				// get elements from db
				$elementRef = ContainrElementPageRef::model()->sorted()->findAll( 'pageId = ' . $this->page->id . ' AND columnId = "' . $value . '"' );

				// display elements
				foreach ( $elementRef as $ref ) {
					$elementDef = ContainrElementLib::model()->find( 'id = ' . $ref->elementId );
					$type = $elementDef->type;

					// launch frontend widget
					$this->dynamicContent[$value] .= Yii::app()->controller->widget( Yii::app()->getModule( 'containr' )->modules[$type]['frontendWidget'], array( 'elemId'=>$elementDef->elementId, 'refkey'=>$ref->id, 'template'=>$ref->template ), true );
				}
			}
		}

		// render template with dynamic content
		$this->owner->render( str_replace(".php","",$this->template->file), array( 'dynamicContent'=>$this->dynamicContent ) );
	}

	/**
	 * Fetch template informations
	 *
	 * @return void
	 */
	private function getThemeSettings() {

		// read theme settings from json
		$this->theme = json_decode(file_get_contents($theme = Yii::app()->theme->basePath.'/settings.json'));
	}
}
