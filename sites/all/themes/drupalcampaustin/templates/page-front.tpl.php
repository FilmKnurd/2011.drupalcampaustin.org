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
  
    <div id="primary-wrapper" class="container-16 clearfix">
      <?php if ($primary_links): ?>
        <div id="primary-menu" class="grid-10 alpha omega">
           <?php print theme('links', $primary_links); ?>
        </div><!-- /#primary-menu -->
      <?php endif; ?>
      <?php if ($user_menu): ?>
        <div id="user-menu">
          <?php print $user_menu; ?>
        </div> <!-- /#user-menu -->
      <?php endif; ?>
    </div> <!-- /#primary-wrapper -->

    <div id="header-wrapper" class="clearfix">
      <div id="header-container" class="container-16">

        <div class="grid-6 alpha omega">
          <a id="logo" href="<?php print $front_page; ?>" title="DrupalCamp Austin" rel="home nofollow">DrupalCamp Austin</a>
        </div> <!-- /#logo -->

        <div id="header" class="prefix-8 grid-8 clearfix">
          <?php print $header; ?>
        </div> <!-- /#header -->
       <div class="ddbc">Design Development Business Community</div>
       <div class="time-cost"></div>
        </div>
      </div> <!-- /#header-container -->
    </div> <!-- /#header-wrapper -->

    <div id="main-wrapper">
      <div id="main-container" class="container-12"><div class="clearfix">

        <div id="main" class="column clearfix">
          <?php if ($tabs): ?>
            <div class="tabs grid-12"><?php print $tabs; ?></div>
          <?php endif; ?>

          <?php if ($messages || $help): ?>
            <div class="grid-12">
              <?php print $messages; ?>
              <?php print $help; ?>
            </div>
          <?php endif; ?>

          <div id="main-content" class="clearfix">
            <?php print $content; ?>
          </div> <!-- /#main-content -->
        </div> <!-- /#main -->

      </div></div> <!-- /#main-container -->
    </div> <!-- /#main-wrapper -->


    <div id="footer-wrapper">
      <div id="footer-container" class="container-16"><div class="clearfix">

        <?php if ($footer): ?>
          <div id="footer" class="grid-16 clearfix">
              <?php print $footer; ?>
          </div> <!-- /#footer -->
        <?php endif; ?>

        <?php if ($footer_message): ?>
          <div id="footer-message" class="grid-12">
            <?php print $footer_message; ?>
          </div> <!-- /# footer-message -->
        <?php endif; ?>

        <div id="footer-menu" class="grid-4">
          <ul>
            <li><a href="/privacy" title="Privacy policy">Privacy policy</a></li>
            <li><a href="/credits" title="Credits and thanks">Credits</a></li>
          </ul>
        </div> <!-- /#footer-menu -->

      </div></div> <!-- /#footer-container -->
    </div> <!-- /#footer-wrapper -->


  </div> <!-- /#page -->

  <?php print $closure; ?>

</body>
</html>
