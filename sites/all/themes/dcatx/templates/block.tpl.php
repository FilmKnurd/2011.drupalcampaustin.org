<?php
/**
 * @file block.tpl.php
 *
 */
?>
<article id="block-<?php print $block->module .'-'. $block->delta; ?>" class="block block-<?php print $block->module ?>">
<?php if ($block->subject): ?>
  <h3 class="block-title"><?php print $block->subject ?></h3>
<?php endif;?>
  <div class="content">
    <?php print $block->content ?>
  </div>
</article>
