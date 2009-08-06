<?php
// $Id: admin_links.admin.inc,v 1.1.2.8 2009/06/27 08:02:55 davereid Exp $

/**
 * @file
 * Admin page callbacks for the admin_links module.
 */

/**
 * Administration settings form.
 *
 * @see system_settings_form()
 */
function admin_links_settings_form() {
  $links = array();
  $query = db_query("SELECT path FROM {menu_router} WHERE tab_root = 'node/%' AND path <> 'node/%'");
  while ($result = db_result($query)) {
    $links[] = str_replace('node/%/', '', $result);
  }
  sort($links);

  $form['admin_links_exclude_links'] = array(
    '#type' => 'textarea',
    '#title' => t('Exclude the following content local tasks from being added to the content teaser links'),
    '#description' => t('One path per line. You can use <em>*</em> as a wildcard. Possible values: %list,', array('%list' => implode(', ', $links))),
    '#default_value' => admin_links_var('exclude_links'),
    '#wysiwyg' => FALSE,
  );
  $form['admin_links_link_new'] = array(
    '#type' => 'checkbox',
    '#title' => t('Add a link to create a new content of the same type (for example, <em>New Story</em>).'),
    '#default_value' => admin_links_var('link_new'),
  );
  $form['admin_links_universaledit'] = array(
    '#type' => 'checkbox',
    '#title' => t('Add support for the <a href="@ueb">Universal Edit Button</a> on editable content.', array('@ueb' => 'http://universaleditbutton.org/')),
    '#default_value' => admin_links_var('universaledit'),
  );

  return system_settings_form($form);
}
