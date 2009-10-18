<?php

/**
 * Implementation of hook_panels_layouts().
 */
function drupalcampaustin_dcafront_panels_layouts() {
  $items['dcafront'] = array(
    'title' => t('DCA front 9/6 and 9/4/2'),
    'icon' => 'dcafront.png',
    'theme' => 'dcafront',
    'css' => 'dcafront.css',
    'panels' => array(
      'top_left' => t('Top left'),
      'top_right' => t('Top right'),
      'bottom_left' => t('Bottom left'),
      'bottom_right1' => t('Bottom right 1'),
      'bottom_right2' => t('Bottom right 2')
     ),
  );

  return $items;
}
