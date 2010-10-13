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
      'left_top' => t('Left Top'),
      'bottom_left' => t('Bottom left'),
      'bottom_right' => t('Bottom right'),
      'sidebar_right' => t('Sidebar Right')
     ),
  );

  return $items;
}
