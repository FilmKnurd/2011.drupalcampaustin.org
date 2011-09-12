<?php
/**
 * @file
 * Template for Home page layout.
 */
?>
<section class="panel-display home-page clearfix" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>
  <div class="panel panel-row clearfix container-12">
    <div class="inside"><?php print $content['top']; ?></div>
  
    <div class="panel panel-col-first">
      <div class="inside"><?php print $content['left']; ?></div>
    </div>
  
    <div class="panel panel-col-last">
      <div class="inside"><?php print $content['right']; ?></div>
    </div>
  
  </div>
  
  <div class="panel panel-row clearfix">
    <div class="inside"><?php print $content['speakers']; ?></div>
  </div>

</section>