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
  
  <div class="container-12">
    <section id="super-header" class="grid-12">
	  <a href="#" id="twitter">Twitter</a>
    </section>
  
    <?php if ($logo): ?>
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" title="DrupalCamp Austin" rel="home nofollow" id="logo">
      <figure class="logo"><script>document.write(getImageTag());</script></figure></a>
    <?php endif; ?>

    <?php if ($primary_links): ?>
      <nav id="primary-menu">
         <?php print theme('links', $primary_links); ?>
      </nav><!-- /#primary-menu -->
    <?php endif; ?>
    <?php if ($user_menu): ?>
      <div id="user-menu">
        <?php print $user_menu; ?>
      </div> <!-- /#user-menu -->
    <?php endif; ?>

    <header>
      <?php print $header; ?>
    </header> <!-- /#header -->
        

    <section id="main">

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
      <section id="sidebar">
        <?php print $sidebar; ?>
      </section> <!-- /#sidebar-left -->
    <?php endif; ?>
  </div><!-- /.container-12 -->

  <footer class="container-12">

    <?php if ($footer): ?>
      <?php print $footer; ?>
    <?php endif; ?>

    <?php if ($footer_message): ?>
      <div id="footer-message">
        <?php print $footer_message; ?>
      </div> <!-- /# footer-message -->
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