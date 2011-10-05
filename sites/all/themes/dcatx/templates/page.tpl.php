<?php
/**
 * @file
 * Basic html.tpl.php structure of a single Drupal page
 */
 
?><!doctype html>
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>> <!--<![endif]-->

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width,initial-scale=1,target-densityDpi=device-dpi">

  <title><?php print $head_title; ?></title>
  
  <?php print $styles; ?>
 
  <!--[if lt IE 9]>
  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  
  <script src="<?php echo $base_path . $directory ?>/js/libs/modernizr-2.0.6.min.js"></script>
  <script src="<?php echo $base_path . $directory ?>/js/script.js"></script>

  <?php print $head; ?>
</head>

<body class="<?php print $body_classes; ?>">
  
  <section id="page-container" class="container-12">
    <nav id="super-header" class="grid-12">
	  <?php if ($super_header): ?>
		<?php print $super_header; ?>
	  <?php endif; ?>
    </nav>

    <header class="grid-12">
	  <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" title="DrupalCamp Austin" rel="home nofollow" id="logo">
	    <figure class="logo"><script>document.write(getImageTag());</script></figure></a>
	  <?php endif; ?>
	
	  <?php if ($primary_links): ?>
        <nav id="primary-menu" class="grid-9">
           <?php print theme('links', $primary_links); ?>
        </nav><!-- /#primary-menu -->
      <?php endif; ?>
      <?php if ($user_menu): ?>
        <div id="user-menu">
          <?php print $user_menu; ?>
        </div> <!-- /#user-menu -->
      <?php endif; ?>

      <?php print $header; ?>
    </header> <!-- /#header -->
        

    <section id="main" class="grid-8">

      <?php if ($secondary_links): ?>
        <div id="secondary" >
          <?php print theme('links', $secondary_links, array('class' => 'links secondary-links clearfix')); ?>
        </div> <!-- /#secondary -->
      <?php endif; ?>
  
      <?php print $messages; ?>
  
      <?php if ($title): ?>
        <h2 class="title" id="page-title"><?php print $title; ?></h2>
      <?php endif; ?>
  
      <?php if ($tabs): ?>
        <div class="tabs"><?php print $tabs; ?></div>
      <?php endif; ?>
  
      <?php print $help; ?>
  
      <?php print $content; ?>
    </section> <!-- /#main -->

    <?php if ($sidebar): ?>
      <section id="sidebar" class="grid-4">
        <?php print $sidebar; ?>
      </section> <!-- /#sidebar-left -->
    <?php endif; ?>
  </section><!-- /#page-container -->
  
  <?php if ($sponsors): ?>
    <footer id="sponsors">
	  <div class="inner container-12">
        <?php print $sponsors; ?>
	  </div>
    </footer>
  <?php endif; ?>

  <footer>
	
    <?php if ($footer): ?>
	  <div class="container-12">
        <?php print $footer; ?>
	    <?php if ($footer_message): ?>
	      <div id="footer-message">
			<?php print $footer_message; ?>
		  </div>
	    <?php endif; ?>

	  </div>
    <?php endif; ?>
  </footer> <!-- /footer -->
  
  <?php print $scripts; ?>

  <?php print $closure; ?>

  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->

</body>
</html>