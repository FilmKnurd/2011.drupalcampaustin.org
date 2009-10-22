<?php
// $Id: panels-threecol-33-34-33.tpl.php,v 1.1.2.2 2009/04/30 20:41:45 merlinofchaos Exp $
/**
 * @file
 * Template for a 3 column panel layout.
 *
 * This template provides a three column panel display layout, with
 * each column roughly equal in width.
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

  <div id="panel-front-top" class="panels-row grid-17">
  
    <div class="panel-panel grid-10 alpha">
      
      <div class="inside" id="featured"><?php print $content['top_left']; ?></div>
    </div>
  
    <div class="panel-panel grid-7 omega">
      <div class="inside"><?php print $content['top_right']; ?></div>
    </div>
  
  </div><!-- /#panel-front-top -->

  <div id="panel-front-bottom" class="panels-row grid-17">

    <div id="sidebar-0" class="panel-panel grid-10 alpha">
      <div class="inside"><?php print $content['bottom_left']; ?></div>
    </div>

    <div id="sidebar-1" class="panel-panel grid-4">
      <div class="inside"><?php print $content['bottom_right1']; ?></div>
    </div>

    <div id="sidebar-2" class="panel-panel grid-3 omega">
      <div class="inside"><?php print $content['bottom_right2']; ?></div>
    </div>
  
  </div><!-- /#panel-front-bottom -->

</div>
