<!DOCTYPE html>
<html lang="en">
<head>

    <!-- start: Meta -->
    <meta charset="utf-8">
    <title>conTainr | Contentmanagement the easy way</title>
    <meta name="description" content="CMS">
    <meta name="author" content="giantBits">
    <meta name="keyword" content="Content Management System">
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->

    <!-- end: CSS -->

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <link id="ie-style" href="css/ie.css" rel="stylesheet">
    <![endif]-->

    <!--[if IE 9]>
        <link id="ie9style" href="css/ie9.css" rel="stylesheet">
    <![endif]-->

    <!-- start: Favicon and Touch Icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
    <!--<link rel="shortcut icon" href="ico/favicon.png">-->
    <!-- end: Favicon and Touch Icons -->

</head>

<body>
    <!-- start: Header -->
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a id="main-menu-toggle" class="hidden-phone open"><i class="icon-reorder"></i></a>
                <div class="row-fluid">
                <a class="brand span2" href="/containr/dashboard"><span><i class=" icon-check-empty"></i> conTainr</span></a>
                </div>
                <!-- start: Header Menu -->
                <div class="nav-no-collapse header-nav">
                    <ul class="nav pull-right">
                        <li class="dropdown hidden-phone">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-warning-sign"></i>
                            </a>
                            <ul class="dropdown-menu notifications">
                                <li class="dropdown-menu-title">
                                    <span>You have 1 notification</span>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="icon blue"><i class="icon-user"></i></span>
                                        <span class="message">New user registration</span>
                                        <span class="time">1 min</span>
                                    </a>
                                </li>
                                <li class="dropdown-menu-sub-footer">
                                    <a>View all notifications</a>
                                </li>
                            </ul>
                        </li>
                        <!-- start: Notifications Dropdown -->
                        <li class="dropdown hidden-phone">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-tasks"></i>
                            </a>
                            <ul class="dropdown-menu tasks">
                                <li>
                                    <span class="dropdown-menu-title">You have 17 tasks in progress</span>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="header">
                                            <span class="title">iOS Development</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim progressBlue">80</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="header">
                                            <span class="title">Android Development</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim progressYellow">47</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="header">
                                            <span class="title">Django Project For Google</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim progressRed">32</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="header">
                                            <span class="title">SEO for new sites</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim progressGreen">63</div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="header">
                                            <span class="title">New blog posts</span>
                                            <span class="percent"></span>
                                        </span>
                                        <div class="taskProgress progressSlim progressPink">80</div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-menu-sub-footer">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- end: Notifications Dropdown -->
                        <li class="hidden-phone">
                            <a class="btn" href="/containr/system/clearCaches" rel="tooltip" data-original-title="Clear assets cache" data-placement="bottom"><i class="icon-trash"></i></a>
                        </li>
                        <!-- start: Message Dropdown -->
                        <li class="dropdown hidden-phone">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-envelope"></i>
                            </a>
                            <ul class="dropdown-menu messages">
                                <li>
                                    <span class="dropdown-menu-title">You have 9 messages</span>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="avatar"><img src="http://www.kultur-vermittlung.ch/typo3conf/ext/cabag_artprojects/Resources/Public/Images/dummy_avatar_male.png" alt="Avatar"></span>
                                        <span class="header">
                                            <span class="from">
                                                Łukasz Holeczek
                                             </span>
                                            <span class="time">
                                                6 min
                                            </span>
                                        </span>
                                        <span class="message">
                                            Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-menu-sub-footer">View all messages</a>
                                </li>
                            </ul>
                        </li>
                        <!-- end: Message Dropdown -->
                        <li class="visible-phone">
                            <a class="btn" href="#">
                                <i class="icon-wrench"></i>
                            </a>
                        </li>
                        <!-- start: User Dropdown -->
                        <li class="dropdown">
                            <a class="btn account dropdown-toggle" data-toggle="dropdown" href="#">
                                <div class="avatar"><img src="http://www.kultur-vermittlung.ch/typo3conf/ext/cabag_artprojects/Resources/Public/Images/dummy_avatar_male.png" alt="Avatar"></div>
                                <div class="user">
                                    <span class="hello">Welcome!</span>
                                    <span class="name"><?php if(Yii::app()->user->publicname) echo Yii::app()->user->publicname; ?></span>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-menu-title">

                                </li>
                                <li><a href="<?php echo $this->createUrl('/containr/system/userUpdate',array('id'=>Yii::app()->user->id)); ?>"><i class="icon-user"></i> Profile</a></li>
                                <li><a href="#"><i class="icon-cog"></i> Settings</a></li>
                                <li><a href="#"><i class="icon-envelope"></i> Messages</a></li>
                                <li><a href="<?php echo $this->createUrl('/containr/dashboard/logout'); ?>"><i class="icon-off"></i> Logout</a></li>
                            </ul>
                        </li>
                        <!-- end: User Dropdown -->
                    </ul>
                </div>
                <!-- end: Header Menu -->

            </div>
        </div>
    </div>
    <!-- end: Header -->

    <div class="container-fluid-full">
        <div class="row-fluid">

            <!-- start: Main Menu -->
            <div id="sidebar-left" class="span2">

                <div class="row-fluid actions">
                    <!--
                    <input type="text" class="search span12" placeholder="...">
                    -->
                </div>

                <div class="nav-collapse sidebar-nav">
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li><a href="/containr/dashboard"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                        <li><a href="/containr/page"><i class="icon-bookmark"></i><span class="hidden-tablet"> Pages</span></a></li>
                        <li><a href="/containr/media"><i class="icon-picture"></i><span class="hidden-tablet"> Media</span></a></li>
                        <li>
                            <a class="dropmenu" id="pluginNav" href="#"><i class="icon-sitemap"></i><span class="hidden-tablet"> Plugins</span> <span class="label">3</span></a>
                            <ul>
                                <li><a class="submenu" href="/containr/contentimage/library"><i class="icon-hdd"></i><span class="hidden-tablet"> Text with image</span></a></li>
                                <li><a class="submenu" href="/containr/objects/library"><i class="icon-envelope"></i><span class="hidden-tablet"> Objects</span></a></li>
                                <li><a class="submenu" href="/containr/advertising/library"><i class="icon-tasks"></i><span class="hidden-tablet"> Advertising</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="dropmenu" id="systemNav" href="#"><i class="icon-cog"></i><span class="hidden-tablet"> System</span> <span class="label">3</span></a>
                            <ul>
                                <li><a class="submenu" href="/containr/system/userIndex"><i class="icon-hdd"></i><span class="hidden-tablet"> User</span></a></li>
                                <li><a class="submenu" href="/containr/system/logIndex"><i class="icon-bolt"></i><span class="hidden-tablet"> Logs</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end: Main Menu -->

            <!-- start: Content -->
            <div id="content" class="span10">
                <?php echo $content; ?>
            </div>
            <!-- end: Content -->

        </div><!--/fluid-row-->

        <div class="clearfix"></div>

        <footer>
            <p>
                <span style="text-align:left;float:left; font-size: 11px;">&copy; 2012-<?php echo date('Y'); ?> <a href="http://giantbits.com" alt="giantBits">giantBits</a></span>
                <span style="text-align:right;float:right; font-size: 11px;">conTainr <?php echo Yii::app()->params->containrVersion; ?></span>
            </p>

        </footer>

    </div>
</body>
</html>
