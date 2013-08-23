<?php

class ContainrController extends Controller
{

	//private $_assetsUrl;

	public function init() {

		// set containr login url
		Yii::app()->user->loginUrl = '/containr/dashboard/login';
		Yii::app()->user->returnUrl = '/containr/dashboard/index';

		// set default containr layout
		$this->setUpTemplate();
		$this->setUpCss();
		$this->setUpClientScript();

	}

	public function accessRules(){
		return array(
			array('allow',
            	'actions'=>array('login','logout','error','backgroundimages','build'),
            	'users'=>array('*')
            ),
			array('allow',
                'expression'=>'!$user->isGuest && $user->role==5',
            ),
            array('deny',
                'expression'=>'$user->isGuest || $user->role<5',
            ),

		);
	}

	public function filters() {
		return array(
			'accessControl',
		);
	}

	public function actionIndex() {
		$this->breadcrumbs=array(
			ucfirst($this->id),
			ucfirst($this->action->id),
		);

		$this->render('index');
	}

	public function setUpTemplate() {
		$this->layout = 'application.modules.containr.views.layouts.containr';
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		$this->layout = 'containr_login';

	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	public function setUpCss() {
		$cs = Yii::app()->getClientScript();

		// main css
		$cs->registerCssFile("//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.no-icons.min.css");
		$cs->registerCssFile("//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css");

		//if(!Yii::app()->user->isGuest && Yii::app()->user->id != 1) $cs->registerCssFile($this->module->assetsUrl.'/css/main.css');
		$cs->registerCssFile($this->module->assetsUrl.'/css/containr.css');
		$cs->registerCssFile($this->module->assetsUrl.'/css/containr-responsive.css');
		$cs->registerCssFile($this->module->assetsUrl.'/css/animate.css');
		$cs->registerCssFile($this->module->assetsUrl.'/css/containr-skins.css');
		$cs->registerCssFile($this->module->assetsUrl.'/css/containr-fonts.css');
		//$cs->registerCssFile($this->module->assetsUrl.'/css/containr_ie.css');

	}

	// global defined javascripts used all over in containr
	public function setUpClientScript() {

		// get clientscript
		$cs = Yii::app()->getClientScript();

		// register additional script files
		$cs->registerScriptFile($this->module->assetsUrl . '/js/jquery.session.js');
		$cs->registerScriptFile($this->module->assetsUrl . '/js/jquery.cookie.js');
		$cs->registerScriptFile($this->module->assetsUrl . '/js/containr-elements.js');
		$cs->registerScriptFile($this->module->assetsUrl . '/js/containr.js');


		// add custom scripts

		$js = <<<EOT

$("#main-menu-toggle").click(function ()
{
	if ($(this).hasClass("open"))
	{
		$(this).removeClass("open").addClass("close");
		var f = $("#content").attr("class");
		var e = parseInt(f.replace(/^\D+/g, ""));
		var c = e + 2;
		var d = "span" + c;
		$("#content").addClass("full");
		$(".brand").addClass("noBg");
		$("#sidebar-left").hide();

		$.session.remove('sbVisible');
		$.session.set("sbVisible","false");
	}
	else
	{
		$(this).removeClass("close").addClass("open");
		var f = $("#content").attr("class");
		var e = parseInt(f.replace(/^\D+/g, ""));
		var c = e - 2;
		var d = "span" + c;
		$("#content").removeClass("full");
		$(".brand").removeClass("noBg");
		$("#sidebar-left").show();
		$.session.remove('sbVisible');
		$.session.set("sbVisible","true");
	}
})


// left nav
$(".dropmenu").click(function (e){
	e.preventDefault();
	$(this).parent().find("ul").slideToggle();

	var active = $(this).attr("id");
    $.cookie('activeNavPoint', active);
});

var last=$.cookie('activeNavPoint');
if (last!=null) {
    //show the last visible group
    $("#"+last).parent().find("ul").slideToggle();
}

// end left nav


$("td a.update").addClass("btn").addClass("btn-success");
$("td a.delete").addClass("btn").addClass("btn-danger");

if($.session.get("sbVisible") == "false"){
	$(this).removeClass("open").addClass("close");
	var f = $("#content").attr("class");
	var e = parseInt(f.replace(/^\D+/g, ""));
	var c = e + 2;
	var d = "span" + c;
	$("#content").addClass("full");
	$(".brand").addClass("noBg");
	$("#sidebar-left").hide();
}

//animate effect
$(".e_flash").hover(
	function () {
	$(this).addClass("animated flash");
	},
	function () {
	$(this).removeClass("animated flash");
	}
);
$(".e_bounce").hover(
	function () {
	$(this).addClass("animated bounce");
	},
	function () {
	$(this).removeClass("animated bounce");
	}
);

$(".e_shake").hover(
	function () {
	$(this).addClass("animated shake");
	},
	function () {
	$(this).removeClass("animated shake");
	}
);
$(".e_tada").hover(
	function () {
	$(this).addClass("animated tada");
	},
	function () {
	$(this).removeClass("animated tada");
	}
);
$(".e_swing").hover(
	function () {
	$(this).addClass("animated swing");
	},
	function () {
	$(this).removeClass("animated swing");
	}
);
$(".e_wobble").hover(
	function () {
	$(this).addClass("animated wobble");
	},
	function () {
	$(this).removeClass("animated wobble");
	}
);
$(".e_wiggle").hover(
	function () {
	$(this).addClass("animated wiggle");
	},
	function () {
	$(this).removeClass("animated wiggle");
	}
);
$(".e_pulse").hover(
	function () {
	$(this).addClass("animated pulse");
	},
	function () {
	$(this).removeClass("animated pulse");
	}
);


$(".e_flip").hover(
	function () {
	$(this).addClass("animated flip");
	},
	function () {
	$(this).removeClass("animated flip");
	}
);
$(".e_flipInX").hover(
	function () {
	$(this).addClass("animated flipInX");
	},
	function () {
	$(this).removeClass("animated flipInX");
	}
);
$(".e_flipOutX").hover(
	function () {
	$(this).addClass("animated flipOutX");
	},
	function () {
	$(this).removeClass("animated flipOutX");
	}
);
$(".e_flipInY").hover(
	function () {
	$(this).addClass("animated flipInY");
	},
	function () {
	$(this).removeClass("animated flipInY");
	}
);
$(".e_flipOutY").hover(
	function () {
	$(this).addClass("animated flipOutY");
	},
	function () {
	$(this).removeClass("animated flipOutY");
	}
);

//Fading entrances
$(".e_fadeIn").hover(
	function () {
	$(this).addClass("animated fadeIn");
	},
	function () {
	$(this).removeClass("animated fadeIn");
	}
);
$(".e_fadeInUp").hover(
	function () {
	$(this).addClass("animated fadeInUp");
	},
	function () {
	$(this).removeClass("animated fadeInUp");
	}
);
$(".e_fadeInDown").hover(
	function () {
	$(this).addClass("animated fadeInDown");
	},
	function () {
	$(this).removeClass("animated fadeInDown");
	}
);
$(".e_fadeInLeft").hover(
	function () {
	$(this).addClass("animated fadeInLeft");
	},
	function () {
	$(this).removeClass("animated fadeInLeft");
	}
);
$(".e_fadeInRight").hover(
	function () {
	$(this).addClass("animated fadeInRight");
	},
	function () {
	$(this).removeClass("animated fadeInRight");
	}
);
$(".e_fadeInUpBig").hover(
	function () {
	$(this).addClass("animated fadeInUpBig");
	},
	function () {
	$(this).removeClass("animated fadeInUpBig");
	}
);
$(".e_fadeInUpBig").hover(
	function () {
	$(this).addClass("animated fadeInUpBig");
	},
	function () {
	$(this).removeClass("animated fadeInUpBig");
	}
);
$(".e_fadeInDownBig").hover(
	function () {
	$(this).addClass("animated fadeInDownBig");
	},
	function () {
	$(this).removeClass("animated fadeInDownBig");
	}
);
$(".e_fadeInLeftBig").hover(
	function () {
	$(this).addClass("animated fadeInLeftBig");
	},
	function () {
	$(this).removeClass("animated fadeInLeftBig");
	}
);
$(".e_fadeInRightBig").hover(
	function () {
	$(this).addClass("animated fadeInRightBig");
	},
	function () {
	$(this).removeClass("animated fadeInRightBig");
	}
);


//Fading exits
$(".e_fadeOut").hover(
	function () {
	$(this).addClass("animated fadeOut");
	},
	function () {
	$(this).removeClass("animated fadeOut");
	}
);
$(".e_fadeOutUp").hover(
	function () {
	$(this).addClass("animated fadeOutUp");
	},
	function () {
	$(this).removeClass("animated fadeOutUp");
	}
);
$(".e_fadeOutDown").hover(
	function () {
	$(this).addClass("animated fadeOutDown");
	},
	function () {
	$(this).removeClass("animated fadeOutDown");
	}
);
$(".e_fadeOutLeft").hover(
	function () {
	$(this).addClass("animated fadeOutLeft");
	},
	function () {
	$(this).removeClass("animated fadeOutLeft");
	}
);
$(".e_fadeOutRight").hover(
	function () {
	$(this).addClass("animated fadeOutRight");
	},
	function () {
	$(this).removeClass("animated fadeOutRight");
	}
);
$(".e_fadeOutUpBig").hover(
	function () {
	$(this).addClass("animated fadeOutUpBig");
	},
	function () {
	$(this).removeClass("animated fadeOutUpBig");
	}
);
$(".e_fadeOutDownBig").hover(
	function () {
	$(this).addClass("animated fadeOutDownBig");
	},
	function () {
	$(this).removeClass("animated fadeOutDownBig");
	}
);
$(".e_fadeOutLeftBig").hover(
	function () {
	$(this).addClass("animated fadeOutLeftBig");
	},
	function () {
	$(this).removeClass("animated fadeOutLeftBig");
	}
);
$(".e_fadeOutRightBig").hover(
	function () {
	$(this).addClass("animated fadeOutRightBig");
	},
	function () {
	$(this).removeClass("animated fadeOutRightBig");
	}
);


//Bouncing entrances
$(".e_bounceIn").hover(
	function () {
	$(this).addClass("animated bounceIn");
	},
	function () {
	$(this).removeClass("animated bounceIn");
	}
);
$(".e_bounceInDown").hover(
	function () {
	$(this).addClass("animated bounceInDown");
	},
	function () {
	$(this).removeClass("animated bounceInDown");
	}
);
$(".e_bounceInUp").hover(
	function () {
	$(this).addClass("animated bounceInUp");
	},
	function () {
	$(this).removeClass("animated bounceInUp");
	}
);
$(".e_bounceInLeft").hover(
	function () {
	$(this).addClass("animated bounceInLeft");
	},
	function () {
	$(this).removeClass("animated bounceInLeft");
	}
);
$(".e_bounceInRight").hover(
	function () {
	$(this).addClass("animated bounceInRight");
	},
	function () {
	$(this).removeClass("animated bounceInRight");
	}
);


//Bouncing exits
$(".e_bounceOut").hover(
	function () {
	$(this).addClass("animated bounceOut");
	},
	function () {
	$(this).removeClass("animated bounceOut");
	}
);
$(".e_bounceOutDown").hover(
	function () {
	$(this).addClass("animated bounceOutDown");
	},
	function () {
	$(this).removeClass("animated bounceOutDown");
	}
);
$(".e_bounceOutUp").hover(
	function () {
	$(this).addClass("animated bounceOutUp");
	},
	function () {
	$(this).removeClass("animated bounceOutUp");
	}
);
$(".e_bounceOutLeft").hover(
	function () {
	$(this).addClass("animated bounceOutLeft");
	},
	function () {
	$(this).removeClass("animated bounceOutLeft");
	}
);
$(".e_bounceOutRight").hover(
	function () {
	$(this).addClass("animated bounceOutRight");
	},
	function () {
	$(this).removeClass("animated bounceOutRight");
	}
);


//Rotating entrances
$(".e_rotateIn").hover(
	function () {
	$(this).addClass("animated rotateIn");
	},
	function () {
	$(this).removeClass("animated rotateIn");
	}
);
$(".e_rotateInDownLeft").hover(
	function () {
	$(this).addClass("animated rotateInDownLeft");
	},
	function () {
	$(this).removeClass("animated rotateInDownLeft");
	}
);
$(".e_rotateInDownRight").hover(
	function () {
	$(this).addClass("animated rotateInDownRight");
	},
	function () {
	$(this).removeClass("animated rotateInDownRight");
	}
);
$(".e_rotateInUpRight").hover(
	function () {
	$(this).addClass("animated rotateInUpRight");
	},
	function () {
	$(this).removeClass("animated rotateInUpRight");
	}
);
$(".e_rotateInUpLeft").hover(
	function () {
	$(this).addClass("animated rotateInUpLeft");
	},
	function () {
	$(this).removeClass("animated rotateInUpLeft");
	}
);


//Rotating exits
$(".e_rotateOut").hover(
	function () {
	$(this).addClass("animated rotateOut");
	},
	function () {
	$(this).removeClass("animated rotateOut");
	}
);
$(".e_rotateOutDownLeft").hover(
	function () {
	$(this).addClass("animated rotateOutDownLeft");
	},
	function () {
	$(this).removeClass("animated rotateOutDownLeft");
	}
);
$(".e_rotateOutDownRight").hover(
	function () {
	$(this).addClass("animated rotateOutDownRight");
	},
	function () {
	$(this).removeClass("animated rotateOutDownRight");
	}
);
$(".e_rotateOutUpLeft").hover(
	function () {
	$(this).addClass("animated rotateOutUpLeft");
	},
	function () {
	$(this).removeClass("animated rotateOutUpLeft");
	}
);
$(".e_rotateOutUpRight").hover(
	function () {
	$(this).addClass("animated rotateOutUpRight");
	},
	function () {
	$(this).removeClass("animated rotateOutUpRight");
	}
);


//Lightspeed
$(".e_lightSpeedIn").hover(
	function () {
	$(this).addClass("animated lightSpeedIn");
	},
	function () {
	$(this).removeClass("animated lightSpeedIn");
	}
);
$(".e_lightSpeedOut").hover(
	function () {
	$(this).addClass("animated lightSpeedOut");
	},
	function () {
	$(this).removeClass("animated lightSpeedOut");
	}
);

//specials
$(".e_hinge").hover(
	function () {
	$(this).addClass("animated hinge");
	},
	function () {
	$(this).removeClass("animated hinge");
	}
);
$(".e_rollIn").hover(
	function () {
	$(this).addClass("animated rollIn");
	},
	function () {
	$(this).removeClass("animated rollIn");
	}
);
$(".e_rollOut").hover(
	function () {
	$(this).addClass("animated rollOut");
	},
	function () {
	$(this).removeClass("animated rollOut");
	}
);


$("#sidebar-left li").hover(
	function() {
		$(this).find("i:first").addClass("animated rotateIn");
	},
	function () {
		$(this).find("i:first").removeClass("animated rotateIn");
	}
);

$('body').tooltip({'selector':'[rel=tooltip]'});

EOT;

		// register custom scripts
		$cs->registerScript('containrCore',$js,4);
	}

	public static function getFlickrImage() {

		$doc = new DOMDocument();
		@$doc->loadHTMLFile("http://www.flickr.com/explore/interesting/7days/");
		$xpath = new DOMXpath($doc);

		if($xpath){

			$src = $xpath->query("//td[@class='Photo']/span/a/img/@src");
			$url = $xpath->query("//td[@class='Photo']/span/a/@href");

			// $srcc = str_replace("_m", "_b", $src);
			$srcc = $src->item(0)->nodeValue;
			$srcc2 = str_replace("_m", "_b", $srcc);

			return $srcc2;

		}

		return '';
	}
}
