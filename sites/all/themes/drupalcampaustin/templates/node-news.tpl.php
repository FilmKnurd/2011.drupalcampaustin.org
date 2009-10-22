<div id="node-<?php print $node->nid; ?>" class="<?php print $node_classes; ?> clearfix">

  <?php if (!$page): ?>
    <h2><a href="<?php print $node_url; ?>" title="<?php print $title; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>

  <div class="meta">
  <?php if ($submitted): ?>
    <?php print t('Posted ') . format_date($node->created, 'custom', "F jS, Y") . t(' by ') . theme('username', $node); ?>
  <?php endif; ?>

  <?php if ($terms): ?>
    <div class="terms terms-inline"><?php print $terms; ?></div>
  <?php endif;?>
  </div>

  <div class="content">
    <?php print $content; ?>
  </div>

  <?php print $links; ?>
</div>
