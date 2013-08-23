<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- start: meta -->
    <meta charset="utf-8" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- end: meta -->

    <!-- start: mobile specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- end: mobile specific -->

    <!-- start: CSS -->
    
    <!-- end: CSS -->

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- start: icons
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/layout/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo Yii::app()->request->baseUrl; ?>/images/layout/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Yii::app()->request->baseUrl; ?>/images/layout/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/images/layout/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo Yii::app()->request->baseUrl; ?>/images/layout/ico/apple-touch-icon-57-precomposed.png">
    <!-- end: icons -->
  </head>

  <!-- start: body -->
  <body class="login-layout">

    
    <div class="main-container container-fluid">
      <div class="main-content">
        <div class="row-fluid">
          <div class="span12">
            <div class="login-container">
              <div class="row-fluid">
                <div class="center">
                  <h1>
                    <i class="icon-leaf green"></i>
                    <span class="red">con</span><span class="white">Tainr</span>
                  </h1>
                </div>
              </div>

              <div class="space-6"></div>

              <div class="row-fluid">
                <?php echo $content; ?>
              </div>
            </div>
          </div><!--/.span-->
        </div><!--/.row-fluid-->
      </div>
    </div><!--/.main-container-->

  </body>
  <!-- end: body -->
</html>
