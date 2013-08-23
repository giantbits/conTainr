<?php

class PageController extends ContainrController
{
	public function init() {

		parent::init();

		// set default containr layout
		$this->setUpTemplate();
		$this->setUpCss();
		$this->setUpClientScript();

		if(isset($_GET['id'])) Yii::app()->user->setState('lastPID', $_GET['id']);
	}

	public function actionIndex() {

		$this->breadcrumbs=array(
			ucfirst($this->id),
			ucfirst($this->action->id),
		);

		$this->pageTitle = 'Pages';

		$this->render('index');
	}

	public function actionCreate() {
		// build breadcrumb
		$this->breadcrumbs=array(
			ucfirst($this->id),
			ucfirst($this->action->id),
		);

		// get template list
		$themeSettings = json_decode(file_get_contents($theme = Yii::app()->theme->basePath.'/settings.json'));
		foreach($themeSettings->templates as $key=>$value) $templateList[$key] = $value->title;

		// load form
		if(isset($_GET['id']))
			$model = ContainrPage::model()->findByPK($_GET['id']);
		else
			$model = new ContainrPage();

		$this->performAjaxValidation($model);

	    if(isset($_POST['ContainrPage']))
	    {
	        $model->attributes=$_POST['ContainrPage'];
	        if($model->validate()) {

	        	//get root node
	        	$root = ContainrPage::model()->findByPK(1);

	        	//save new page to tree
	        	if($model->isNewRecord)
	        		$model->appendTo($root);
	        	else
	        		$model->saveNode();

	        	// set flash saved
	        	Yii::app()->user->setFlash('pageSaved','true');

	        	//redirect
	        	$this->redirect($this->createUrl('page/update',array('id'=>$model->id)));
	        }
	    }

		$this->render('create', array('model'=>$model, 'templateList'=>$templateList));
	}

	public function actionUpdate() {
		// COPY / CUT / PASTE
		if (isset($_GET['action'])) {
			switch ($_GET['action']) {
				case 'copy':
					if (!isset(Yii::app()->user->clipboard) || get_class(Yii::app()->user->clipboard) != 'ContainrContentClipboard') {
						Yii::app()->user->setState('clipboard',new ContainrContentClipboard);
					}
					Yii::app()->user->clipboard->addToClipboard($_GET['id'],$_GET['refkey'],ContainrContentClipboard::MODE_COPY);
					break;
				case 'cut':
					if (!isset(Yii::app()->user->clipboard) || get_class(Yii::app()->user->clipboard) != 'ContainrContentClipboard') {
						Yii::app()->user->setState('clipboard',new ContainrContentClipboard);
					}
					Yii::app()->user->clipboard->addToClipboard($_GET['id'],$_GET['refkey'],ContainrContentClipboard::MODE_CUT);
					break;
				case 'paste':
					if (isset(Yii::app()->user->clipboard) && get_class(Yii::app()->user->clipboard) == 'ContainrContentClipboard') {
						Yii::app()->user->clipboard->paste($_GET['column'],$_GET['id'],$_GET['refkey']);
					}
					$this->redirect(Yii::app()->createUrl('/containr/page/update/',array('id'=>$_GET['id'])));
					break;
				case 'pasteref':
					if (isset(Yii::app()->user->clipboard) && get_class(Yii::app()->user->clipboard) == 'ContainrContentClipboard') {
						Yii::app()->user->clipboard->pasteRef($_GET['column'],$_GET['id'],$_GET['refkey']);
					}
					$this->redirect(Yii::app()->createUrl('/containr/page/update/',array('id'=>$_GET['id'])));
					break;
				case 'clearclipboard':
					if (isset(Yii::app()->user->clipboard) && get_class(Yii::app()->user->clipboard) == 'ContainrContentClipboard') {
						Yii::app()->user->clipboard->clearClipboard();
					}
					break;
			}
		}


		// build breadcrumb
		$this->breadcrumbs= null; //array(ucfirst($this->id),ucfirst($this->action->id));

		// load form
		if(isset($_GET['id']))
			$model = ContainrPage::model()->findByPK($_GET['id']);
		else
			$model = new ContainrPage();

		$this->performAjaxValidation($model);

		// get template structue from theme settings
		$themeSettings = json_decode(file_get_contents($theme = Yii::app()->theme->basePath.'/settings.json'));
		$templateStructure = json_decode($themeSettings->templates->{$model->template}->structure);

		if(isset($_POST['ContainrPage'])) {
			$model->attributes=$_POST['ContainrPage'];
			if($model->validate()) {

				//get root node
				$root = ContainrPage::model()->findByPK(1);

				//save new page to tree
				if($model->isNewRecord)
					$model->appendTo($root);
				else
					$model->saveNode();

				// set flash saved
				Yii::app()->user->setFlash('pageSaved','true');

				//redirect
				$this->redirect($this->createUrl('page/update',array('id'=>$model->id)));
			}
		}

		$this->render('update', array('model'=>$model,'templateStructure'=>$templateStructure));
	}

	public function actionSettings() {
		// build breadcrumb
		$this->breadcrumbs= null; //array(ucfirst($this->id),ucfirst($this->action->id));

		// get template list
		$themeSettings = json_decode(file_get_contents($theme = Yii::app()->theme->basePath.'/settings.json'));
		foreach($themeSettings->templates as $key=>$value) $templateList[$key] = $value->title;

		// load form
		if(isset($_GET['id']))
			$model = ContainrPage::model()->findByPK($_GET['id']);
		else
			$model = new ContainrPage();

		$this->performAjaxValidation($model);

	    if(isset($_POST['ContainrPage']))
	    {
	        $model->attributes=$_POST['ContainrPage'];
	        if($model->validate()) {

	        	//get root node
	        	$root = ContainrPage::model()->findByPK(1);

	        	//save new page to tree
	        	if($model->isNewRecord)
	        		$model->appendTo($root);
	        	else
	        		$model->saveNode();

        		// set flash saved
	        	Yii::app()->user->setFlash('pageSaved','true');

	        	//redirect
	        	$this->redirect($this->createUrl('page/settings',array('id'=>$model->id)));
	        }
	    }

		$this->render('settings', array('model'=>$model,'templateList'=>$templateList));
	}

	public function actionBuild() {
		$pages = ContainrPage::model()->findAll();
		if (count($pages)==0) {
			// build root node
			$root = new ContainrPage();
			$root->title = Yii::app()->name;
			$root->navTitle = Yii::app()->name . ' - Root';
			$root->template = 'main';
			$root->saveNode();

			// add home page
			$homePage = new ContainrPage();
			$homePage->title = "Home";
			$homePage->navTitle = "Home";
			$homePage->template = 'main';
			$homePage->appendTo($root);

			// generate admin user
			$user = new ContainrUser();
			$user->login = 'admin';
			$user->email = 'admin@examplemail.com';
			$user->password = crypt('temppwd');
			$user->passwordConfirm = 'temppwd';
			$user->nameLast = 'Doe';
			$user->nameFirst = 'John';
			$user->role = 5;
			$user->state = 1;
			$user->save();


			$this->renderText('Root-node and home page created. Return to ' . CHtml::link('page overview', $this->createUrl('page/index')));
		} else {
			echo "Build was alredy executed...";
		}
	}

	protected function performAjaxValidation($model)
	{
	    if(isset($_POST['ajax']) && $_POST['ajax']==='page-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	}


	public function actionTreechange() {

		$moved_node	= $_POST['moved_node'];
		$target_node = $_POST['target_node'];
		$position = $_POST['position'];
		$previous_parent = $_POST['previous_parent'];


		$pageToMove = ContainrPage::model()->findByPK($moved_node);
		$targetOfMove = ContainrPage::model()->findByPK($target_node);

		//before, after or inside
		switch($position){
			case 'before':
				$pageToMove->moveBefore($targetOfMove);
				break;
			case 'after':
				$pageToMove->moveAfter($targetOfMove);
				break;
			case 'inside':
				$pageToMove->moveAsFirst($targetOfMove);
				break;
		}
		$pageToMove->save(); //call save to clear the groupAccessCache / UrlCache
	}

	public function actionGettree() {
		$tree = ContainrPage::model()->findAll(array('order'=>'lft'));

		echo '[';
		$level = 1;
		foreach($tree as $n=>$leav){

			if($leav->level > $level) {
		        echo ', "children": [';
		    } else {

		        for($i = $level-$leav->level;$i;$i--)
		        {
		            echo "}";
		            echo "]},";
		        }

		    }

		    if($leav->level > 1 && $leav->level == $level) {
		    	echo '},';
		    }

		    echo '{';
		    echo '"id":"'.$leav->id.'",';
		    echo '"label":"'.str_replace('"','\\"',$leav->navTitle).'",';
		    echo '"lft":"'.$leav->lft.'",';
		    echo '"rgt":"'.$leav->rgt.'",';
		    echo '"level":"'.$leav->level.'"';

		    $level = $leav->level;
		}


		for($i=$level;$i;$i--)
		{
			echo "}";
		    echo "]";
		}
		//echo "]";

		Yii::app()->end();
	}

	public function actionSortelement() {

		$i = 0;
		$refId = str_replace("elem_","",$_POST['elementId']);
		$posNum = $_POST['positionId'];
		$colId = $_POST['columnId'];
		$pgeId = $_POST['pageId'];

		// get all elements in column
		$resColumn = ContainrElementPageRef::model()->sorted()->findAll('pageId = '.$pgeId.' AND columnId = "'.$colId.'"');

		foreach($resColumn as $res){
			ContainrElementPageRef::model()->updateByPk($res->id,array('posNum'=>$i));
			$i = $i+1;
		}

		// reposition all elements in column
		$res = @Yii::app()->db->createCommand('UPDATE containr_elementPageRef SET posNum = (posNum + 1) WHERE pageId = '.$pgeId.' AND columnId = "'.$colId.'" AND posNum >= '.$posNum)->execute();

		// set pos for current element
		$resUpd = ContainrElementPageRef::model()->updateByPk($refId,array('posNum'=>$posNum,'columnId'=>$colId));
	}

	public function actionDelete() {

		ContainrPage::model()->deleteByPK($_GET['id']);
		$this->redirect(Yii::app()->createUrl('/containr/page/'));
	}

	public function setUpCss() {

		parent::setUpCss();

		// get client script
		$cs = Yii::app()->getClientScript();

		// jqtree view stuff
		$cs->registerCssFile($this->module->assetsUrl.'/css/jqtree.css');
	}


	public function setUpClientScript() {

		parent::setUpClientScript();

		// get client script
		$cs = Yii::app()->getClientScript();

		// core scripts (jquery)
		//$cs->registerCoreScript('jquery');
		$cs->registerCoreScript('jquery.ui');

		// bootstrap
		//$cs->registerScriptFile($this->module->assetsUrl.'/js/bootstrap.min.js');

		// jqtree stuff
		$cs->registerScriptFile($this->module->assetsUrl.'/js/tree.jquery.js');
		$cs->registerScriptFile($this->module->assetsUrl.'/js/jquery.cookie.js');

		// mobile touch
		$cs->registerScriptFile($this->module->assetsUrl.'/js/jquery.ui.touch.js');

		// custom scripts
		$js = "

			$('#pageTree').tree({
				saveState: 'pageTree',
				dragAndDrop: true,
				autoOpen: 0,
				selectable: false,
				autoEscape: false,
				onIsMoveHandle: function(element) {
			        // Only dom elements with 'title' class can be used
			        // as move handle.
			        return (element.is('.title'));
			    },
				onCanMoveTo: function(moved_node, target_node, position) {
			        if (target_node.id == 1 && (position == 'after' || position == 'before')) {
			            // Example: can move inside menu, not before or after
			            return false;
			        }
			        else {
			            return true;
			        }
			    }
			});

			$('#pageTree').bind(
			    'tree.move',
			    function(e) {
			    	$.post('".$this->createUrl('page/treechange')."', { moved_node: e.move_info.moved_node.id, target_node:e.move_info.target_node.id, position:e.move_info.position, previous_parent:e.move_info.previous_parent.id});
			    }
			);

			$('#pageTree').bind(
			    'tree.init',
			    function(e) {
			    	$('button.edit').click(function(evt){
						var pageId = $(this).attr('id');
						window.location.href = '".$this->createUrl('page/update')."?id=' + pageId;
					});

					$('button.settings').click(function(evt){
						var pageId = $(this).attr('id');
						window.location.href = '".$this->createUrl('page/settings')."?id=' + pageId;
					});
			    }
			);

			$('[rel=\'popover\']').popover({placement:'bottom',placement:'left'});

			$('input, textarea,select').on('change', function(){
				$('#btnCancel').removeAttr('disabled');
				$('#btnSave').removeAttr('disabled');
			});

			// SORTABLE
			$('div.pagedrop').sortable({
				connectWith: 'div.pagedrop',
				items: 'div.sortable',
				handle: '.dragHandle',
				tolerance: 'pointer',
				update: function( event, ui ) {
					var target = $(ui.item.context.parentElement).attr('id');
					var element = $(ui.item).attr('id').replace('.','/');
					var pos = $(ui.item).index();

					$.post('".$this->createUrl('page/sortelement')."',{pageId:".(isset($_GET['id'])? $_GET['id'] : 0).", columnId:target,elementId:element,positionId:pos},
						function(data) {
							//var out = '#' + target;
					    	//$(out).html(data);
					    }
					);
				}
			});


		";

		$cs->registerScript('containrPageJs',$js,CClientScript::POS_READY); //POS_READY
	}
}
