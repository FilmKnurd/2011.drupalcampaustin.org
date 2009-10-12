<?php // $Id: page.tpl.php,v 1.15.4.7 2008/12/23 03:40:02 designerbrent Exp $ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>">
<head>
	<title><?php print $head_title ?></title>
	<meta http-equiv="content-language" content="<?php print $language->language ?>" />
	<?php print $meta; ?>
  <?php print $head; ?>
  <?php print $styles; ?>
  <!--[if lte IE 7]>
    <link rel="stylesheet" href="<?php print $path; ?>blueprint/blueprint/ie.css" type="text/css" media="screen, projection">
  	<link href="<?php print $path; ?>css/ie.css" rel="stylesheet"  type="text/css"  media="screen, projection" />
  <![endif]-->  
  <!--[if lte IE 6]>
  	<link href="<?php print $path; ?>css/ie6.css" rel="stylesheet"  type="text/css"  media="screen, projection" />
  <![endif]-->  
</head>

<body class="<?php print $body_classes; ?>">

<div class="container">

<div id="header-wrapper">
  <div id="header">
  	<div id="header-top">

  		<!--<?php print $header_top; ?>  -->
    	<h1 id="logo">
      		<a title="<?php print $site_name; ?><?php if ($site_slogan != '') print ' &ndash; '. $site_slogan; ?>" href="<?php print url(); ?>"><?php print $site_name; ?><?php if ($site_slogan != '') print ' &ndash; '. $site_slogan; ?></a>
    	</h1>
    	
    	<div id="register">
    		<?php if ($register): ?>
    			<?php print $register; ?>
    			<!-- <div class="<?php print $register_classes; ?>"><?php print $register; ?></div> -->
  			<?php endif ?> 
    	</div>
    </div> <!-- End header-top -->
    
	    <?php print $header; ?>
	    <div id="primary">
	  
						 			<!--  <div id="primary">
					        			<?php print theme('links', $primary_links); ?>
					      			</div> -->
      			
	    	<?php if (isset($primary_links)) : ?>
	      		<?php print theme('links', $primary_links, array('id' => 'nav', 'class' => 'links')) ?>
	    	<?php endif; ?>
	    </div>
    
    	<div id="secondary">
	    <?php if (isset($secondary_links)) : ?>
	      <?php print theme('links', $secondary_links, array('id' => 'subnav', 'class' => 'links')) ?>
	    <?php endif; ?> 
	    </div> <!-- End secondary -->  
	     
  </div> <!-- End Header -->
  
  </div> <!-- End Header Wrapper -->
  
  <div id="preface-wrapper">
	  <div id="preface">
	  	<div id="featured">
	  		<?php if ($featured): ?>
    			<div class="<?php print $featured_classes; ?>"><?php print $featured; ?></div>
  			<?php endif ?> 
	  	</div>
	  	
	  	<div id="preface-right">
	  		<?php if ($preface_right): ?>
    			<div class="<?php print $preface_right_classes; ?>"><?php print $preface_right; ?></div>
  			<?php endif ?> 
	  	</div>
	  </div>
  
  </div> <!-- End preface-wrapper -->

  
  <div id="main-wrapper">
  <div id="main">  
		<?php if ($main): ?>
    		<?php print $main; ?>
  		<?php endif ?>
					      		
  		<div id="content">
  		
  			<div id="before-content">
  				<?php if ($before_content): ?>
    				<div class="<?php print $before_content_classes; ?>"><?php print $before_content; ?></div>
  				<?php endif ?> 
  			</div>
  			
	  	   <div id="main-content">
		 
    		 <?php print $main_content; ?>
    				
    				<!-- <?php if ($breadcrumb != '') {
        				print $breadcrumb;
     				 }

      				if ($tabs != '') {
       					print '<div class="tabs">'. $tabs .'</div>';
      				}

      				if ($messages != '') {
        				print '<div id="messages">'. $messages .'</div>';
      				}
      
      				if ($title != '') {
        				print '<h2>'. $title .'</h2>';
      				}      

      				print $help;       

      				print $content;
     				print $feed_icons;
    				?>
    		
            		</div> <!-- END content-->
            		-->
    	</div>
    	
    	<div id="outer">
    		<?php if ($outer): ?>
    			<?php print $outer; ?>
    			<!-- <div class="<?php print $left_classes; ?>"><?php print $outer; ?></div> -->
  			<?php endif ?> 
  		</div>
    	
    	<div id="inner">
      		<?php if ($inner): ?>
      			<?php print $inner; ?>
    			<!--  <div class="<?php print $right_classes; ?>"><?php print $inner; ?></div> -->
  			<?php endif ?>
    	</div>
 
   </div> <!-- End div main -->
  </div> <!-- End div main-wrapper -->

<div id="footer-wrapper">
    <?php if ($footer_message | $footer): ?>
      <div id="footer" class="clear">
        <?php if ($footer): ?>
          <?php print $footer; ?>
        <?php endif; ?>
        <?php if ($footer_message): ?>
          <div id="footer-message"><?php print $footer_message; ?></div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
</div>
  
 </div> <!-- End container -->
 
  <?php print $scripts ?>
  <?php print $closure; ?>
  


</div>

</body>
</html>
