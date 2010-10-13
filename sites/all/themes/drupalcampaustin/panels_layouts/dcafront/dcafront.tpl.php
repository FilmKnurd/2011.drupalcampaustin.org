<?php
// dcafront.tpl.php
/**
 * @file
 * Template for a 2 column panel layout. First Column is split
 *
 * Variables:
 * - $id: An optional CSS id to use for the layout.
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout. This layout supports the following sections:
 *   - $content['left']: Content in the left column.
 *   - $content['middle']: Content in the middle column.
 *   - $content['right']: Content in the right column.
 */
?>

<div class="panel-display" <?php if (!empty($css_id)) { print "id=\"$css_id\""; } ?>>

  <div id="panel-front-left" class="panel grid-12">
  
    <div class="panel-panel grid-10 alpha">
    
      <div class="top-left" id="featured"><?php print $content['left_top']; ?></div>
      
      <div class="panels-row grid-5 alpha">
        <div class="bottom-left"><?php print $content['bottom_left']; ?></div>
      </div>
      
      <div class="panel-panel grid-5 alpha omega clearfix">
        <div class="bottom-right"><?php print $content['bottom_right']; ?></div>
      </div>
      
    </div>
    
    <div id="sidebar-right" class="panel-panel grid-2 alpha omega">
      <div class="clearfix"><?php print $content['sidebar_right']; ?></div>
    </div>
  
  </div><!-- /#panel-front-wrapper -->

</div>
