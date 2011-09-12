<?php
/**
 * @file node.tpl.php
 */
?>

<article id="node-<?php print $node->nid; ?>" class="<?php print $node_classes; ?> clearfix">

  <?php if (!$page): ?>
    <h2><a href="<?php print $node_url; ?>" title="<?php print $title; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>

  <?php if ($submitted): ?>
    <div class="submitted"><?php print $submitted; ?></div>
  <?php endif; ?>

  <?php if ($terms): ?>
    <div class="terms terms-inline"><?php print $terms; ?></div>
  <?php endif;?>

  <?php print $content; ?>

  <?php if ($links): ?>
    <div class="links">
      <?php print $links; ?>
    </div>
  <?php endif; ?>

</article>
