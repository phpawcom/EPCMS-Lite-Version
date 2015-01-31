<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if($script->detect->isMobile()): ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php endif; ?>
<title><?php echo $script->language['website_title']; ?></title>
<script type="text/javascript" src="<?php echo $script->settings['path'] ?>/clientscripts/jquery-1.11.2.min.js"></script>
<!-- bootstrap -->
<link type="text/css" href="<?php echo $script->settings['path'] ?>/clientscripts/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="<?php echo $script->settings['path'] ?>/clientscripts/bootstrap/js/bootstrap.min.js"></script>
<!-- /bootstrap -->
<link href="<?php echo $script->settings['path'] ?>/clientscripts/style.css?c=<?php echo md5(time()); ?>" rel="stylesheet" type="text/css" />
<!-- html5 placeholder --><script type="text/javascript" src="<?php echo $script->settings['path'] ?>/clientscripts/jquery.placeholder.min.js"></script><!-- /html5 placeholder -->
<script type="text/javascript" src="<?php echo $script->settings['path'] ?>/clientscripts/main.js"></script>
<!-- font-awesome --><link rel="stylesheet" href="<?php echo $script->settings['path'] ?>/clientscripts/font-awesome/css/font-awesome.min.css"><!-- /font-awesome -->
<!-- bootstrap social gh pages --><link rel="stylesheet" href="<?php echo $script->settings['path'] ?>/clientscripts/bootstrap-social-gh-pages/bootstrap-social.css"><!-- /bootstrap social gh pages -->
<!-- jquery-ui --> 
<link type="text/css" rel="stylesheet" href="<?php echo $script->settings['path'] ?>/clientscripts/jquery-ui-1.11.2/jquery-ui.min.css" /> 
<script type="text/javascript" src="<?php echo $script->settings['path'] ?>/clientscripts/jquery-ui-1.11.2/jquery-ui.min.js"></script><!-- /jquery-ui -->
<?php if($script->detect->isMobile()): ?>
<link href="<?php echo $script->settings['path'] ?>/clientscripts/mobile.css?c=<?php echo md5(time()); ?>" rel="stylesheet" type="text/css" />
<?php endif; ?>
</head>
<body>
<div id="background"></div>
<div id="wrapper">
  <div id="header">
    <a href="<?php echo $script->settings['path'] ?>"><h1><?php echo $script->language['website_title']; ?></h1></a>
    <div id="change_language">
	<?php if($script->language['shortcut'] == 'en'): ?>
      <a class="btn btn-default" href="<?php echo $script->settings['path'] ?>?lang=ar"><i class="glyphicon glyphicon glyphicon-globe"></i> العربية</a>
    <?php else: ?>
      <a class="btn btn-default" href="<?php echo $script->settings['path'] ?>?lang=en"><i class="glyphicon glyphicon glyphicon-globe"></i> English</a>
    <?php endif; ?>
    </div>
    <h4><?php echo $script->language['website_slogan']; ?></h4>
    <div id="navigation" class="btn-group" role="group">
      <?php if($script->detect->isMobile() && !$script->detect->isTablet()){ ?>
      <a class="btn btn-default" href="<?php echo $script->settings['path'] ?>"><i class="glyphicon glyphicon-home"></i> </a>
      <a class="btn btn-default" href="<?php echo $script->settings['path'] ?>/faq"><i class="glyphicon glyphicon-info-sign"></i> </a>
      <a class="btn btn-default" href="#"><i class="glyphicon glyphicon-plus"></i> <?php echo $script->language['navigation_add']; ?></a>
      <a class="btn btn-default" href="#' ?>"><i class="glyphicon glyphicon-log-out"></i> </a>
      <?php }else{ ?>
      <a class="btn btn-default" href="<?php echo $script->settings['path'] ?>"><i class="glyphicon glyphicon-home"></i> <?php echo $script->language['navigation_home']; ?></a>
      <a class="btn btn-default" href="<?php echo $script->settings['path'] ?>/faq"><i class="glyphicon glyphicon-info-sign"></i> <?php echo $script->language['navigation_faq']; ?></a>
      <a class="btn btn-default" href="#"><i class="glyphicon glyphicon-plus"></i> <?php echo $script->language['navigation_add']; ?></a>
      <a class="btn btn-default" href="#"><i class="glyphicon glyphicon-log-out"></i> <?php echo $script->language['navigation_logout']; ?></a>
	  <?php } ?>
    </div>   
    <div class="clear"></div>
  </div>
  <div id="container">
  
