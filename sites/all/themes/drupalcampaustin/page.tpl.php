<?php
// $Id: page.tpl.php,v 1.1.2.1 2009/02/24 15:34:45 dvessel Exp $
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <?php print $scripts; ?>
</head>

<body class="<?php print $body_classes; ?>">

  <div id="page" class="clearfix">


    <div id="header-wrapper" class="clearfix">
      <div id="header-container" class="container-16">

        <div id="logo" class="grid-4">
         <a href="<?php print $front_page; ?>" title="DrupalCamp Austin" rel="home nofollow"><img src="<?php print $base_path . $directory; ?>/images/DCA_logo.png" alt="DrupalCamp Austin" /></a>
        </div><!-- /#logo -->

        <div id="header" class="grid-6">
          FPO
          <?php print $header; ?>
        </div> <!-- /#header -->

        <div id="register" class="grid-6">
          FPO
        </div><!-- /#register -->

        <?php /*
        <?php if ($search_box): ?>
          <div id="search-box" class="grid-16 clearfix"><?php print $search_box; ?></div>
        <?php endif; ?>
        */ ?>

        <?php if ($main_menu_links || $secondary_menu_links): ?>
          <div id="menu" class="grid-16 clearfix">
            <?php print $main_menu_links; ?>
            <?php print $secondary_menu_links; ?>
          </div>
        <?php endif; ?>

      </div> <!-- /#header-container -->
    </div> <!-- /#header-wrapper -->


    <?php if ($is_front): ?>
      <div id="preface-wrapper" class="clearfix">
    	  <div id="preface-container" class="container-16">
    	  	<div id="preface-left" class="grid-16 clearfix">
    	  		<?php if ($preface_left): ?>
        			<div class="<?php print $preface_left_classes; ?>"><?php print $preface_left; ?></div>
      			<?php endif ?> 
    	  	</div>

    	  	<div id="preface-right" class="grid-16 clearfix">
    	  		<?php if ($preface_right): ?>
        			<div class="<?php print $preface_right_classes; ?>"><?php print $preface_right; ?></div>
      			<?php endif ?> 
    	  	</div>
    	  </div> <!-- /#preface-container -->
      </div> <!-- /#preface-wrapper -->
    <?php endif; ?>


    <div id="main-wrapper" class="clearfix">
      <div id="main-container" class="container-16">

        <div id="main" class="column grid-9 clearfix">
          <?php print $breadcrumb; ?>

          <?php if ($title): ?>
            <h1 class="title" id="page-title"><?php print $title; ?></h1>
          <?php endif; ?>

          <?php if ($tabs): ?>
            <div class="tabs"><?php print $tabs; ?></div>
          <?php endif; ?>

          <?php print $messages; ?>
          <?php print $help; ?>

          <div id="main-content" class="region clearfix">
            <?php print $content; ?>
          </div> <!-- /#main-content -->

          <?php print $feed_icons; ?>
        </div> <!-- /#main -->

        <?php if ($sidebar_1): ?>
          <div id="sidebar-1" class="column sidebar region grid-4 clearfix">
            <?php print $sidebar_1; ?>
          </div> <!-- /#sidebar-1 -->
        <?php endif; ?>

        <?php if ($sidebar_2): ?>
          <div id="sidebar-2" class="column sidebar region grid-3 clearfix">
            SPONSORS
            <?php print $sidebar_2; ?>
          </div> <!-- /#sidebar-2 -->
        <?php endif; ?>

      </div> <!-- /#main-container -->
    </div> <!-- /#main-wrapper -->


    <div id="footer-wrapper" class="clearfix">
      <div id="footer-container" class="container-16">

        <?php if ($footer): ?>
          <div id="footer" class="region grid-16 clearfix">
              <?php print $footer; ?>
          </div> <!-- /#footer -->
        <?php endif; ?>

        <?php if ($footer_message): ?>
          <div id="footer-message" class="grid-16 clearfix">
            <?php print $footer_message; ?>
          </div> <!-- /# footer-message -->
        <?php endif; ?>

      </div> <!-- /#footer-container -->
    </div> <!-- /#footer-wrapper -->


  </div> <!-- /#page -->

  <?php print $closure; ?>

</body>
</html>
