<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/layout/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo Yii::app()->request->baseUrl; ?>/images/layout/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Yii::app()->request->baseUrl; ?>/images/layout/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/images/layout/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo Yii::app()->request->baseUrl; ?>/images/layout/ico/apple-touch-icon-57-precomposed.png">
    -->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Containr</a>
          
          <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i> Username
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#">Profile</a></li>
              <li class="divider"></li>
              <li><a href="#">Sign Out</a></li>
            </ul>
          </div>

          <div class="pull-right">
            
          </div>
          
          <div class="nav-collapse">

          	<?php $this->widget('zii.widgets.CMenu',array(
          		'htmlOptions'=>array(
          			'class'=>'nav',
          		),
          		
              'encodeLabel'=>false,
      				'items'=>array(
      					array('label'=>'Dashboard', 'url'=>array('dashboard/index')),
      					array('label'=>'Pages <span class="badge badge-success">4</span>', 'url'=>array('page/index')),
      					array('label'=>'Commerical', 'url'=>array('commerical/index')),
      					array('label'=>'Social', 'url'=>array('social/index')),
      					array('label'=>'Stats', 'url'=>array('statistic/index')),
      					array('label'=>'Media', 'url'=>array('media/index')),
      					array('label'=>'System', 'url'=>array('system/index')),
      					//array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
      					//array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
      				),
      			)); ?>


			<!--
            <ul class="nav">
              <li><a href="#">Dashboard</a></li>
              <li><a href="#about">Pages</a></li>
              <li><a href="#contact">Media</a></li>
            </ul>
			-->
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">

    <?php 
    if(isset($this->breadcrumbs)):
      $this->widget('zii.widgets.CBreadcrumbs', array(
        'htmlOptions'=>array(
          'class'=>'breadcrumb',
        ),
        'tagName'=>'ul',
        'encodeLabel'=>false,
        'separator'=>'<span class="divider">/</span>',
        'homeLink'=>CHtml::Link('Containr',array('/containr')),
        'links'=>$this->breadcrumbs,
      ));
    endif
    ?>

		<?php echo $content; ?>


    </div><!--/.fluid-container-->
  </body>
</html>
