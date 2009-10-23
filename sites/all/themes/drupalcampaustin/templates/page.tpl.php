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
      <div id="header-container" class="container-17">

        <div id="logo" class="grid-6">
          <a href="<?php print $front_page; ?>" title="DrupalCamp Austin" rel="home nofollow"><img src="<?php print $base_path . $directory; ?>/images/DCA_logo.png" alt="DrupalCamp Austin" /></a>
        </div> <!-- /#logo -->

        <div id="header" class="grid-10 prefix-1 clearfix">
          <?php print $header; ?>
        </div> <!-- /#header -->

        <?php /*
        <?php if ($search_box): ?>
          <div id="search-box" class="grid-16 clearfix"><?php print $search_box; ?></div>
        <?php endif; ?>
        */ ?>

        <?php /*if ($main_menu_links || $secondary_menu_links): ?>
          <div id="menu" class="grid-17 clearfix">
            <?php print $main_menu_links; ?>
            <?php print $secondary_menu_links; ?>
          </div>
        <?php endif; */?>

      </div> <!-- /#header-container -->
    </div> <!-- /#header-wrapper -->


    <div id="primary-wrapper">
      <div id="primary-container" class="container-17"><div class="clearfix">
        <?php if ($primary_links): ?>
           <?php print theme('links', $primary_links); ?>
         <?php endif; ?>
      </div></div> <!-- /#primary-container -->
    </div> <!-- /#primary-wrapper -->


    <div id="main-wrapper">
      <div id="main-container" class="container-17"><div class="clearfix">

        <div id="main" class="column grid-10 clearfix">
          <?php if ($title): ?>
            <h1 class="title" id="page-title"><?php print $title; ?></h1>
          <?php endif; ?>

          <?php if ($tabs): ?>
            <div class="tabs"><?php print $tabs; ?></div>
          <?php endif; ?>

          <?php print $messages; ?>
          <?php print $help; ?>

          <div id="main-content" class="clearfix">
            <?php print $content; ?>
          </div> <!-- /#main-content -->
        </div> <!-- /#main -->

        <?php if ($sidebar_1): ?>
          <div id="sidebar-1" class="column sidebar grid-4 clearfix">
            <?php print $sidebar_1; ?>
          </div> <!-- /#sidebar-1 -->
        <?php endif; ?>

        <?php if ($sidebar_2): ?>
          <div id="sidebar-2" class="column sidebar grid-3 clearfix">
            <?php print $sidebar_2; ?>
          </div> <!-- /#sidebar-2 -->
        <?php endif; ?>

      </div></div> <!-- /#main-container -->
    </div> <!-- /#main-wrapper -->


    <div id="footer-wrapper" class="clearfix">
      <div id="footer-container" class="container-17">

        <?php if ($footer): ?>
          <div id="footer" class="grid-17 clearfix">
              <?php print $footer; ?>
          </div> <!-- /#footer -->
        <?php endif; ?>

        <?php if ($footer_message): ?>
          <div id="footer-message" class="grid-10">
            <?php print $footer_message; ?>
          </div> <!-- /# footer-message -->
        <?php endif; ?>

        <div id="footer-menu" class="grid-7">
          <ul>
            <li><a href="/privacy" title="Privacy policy">Privacy policy</a></li>
            <li><a href="/credits" title="Credits and thanks">Credits</a></li>
          </ul>
        </div>

      </div> <!-- /#footer-container -->
    </div> <!-- /#footer-wrapper -->


  </div> <!-- /#page -->

  <?php print $closure; ?>

</body>
</html>
