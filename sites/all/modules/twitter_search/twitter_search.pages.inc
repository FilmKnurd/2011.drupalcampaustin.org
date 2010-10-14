<?php
/**
 * @file
 *  Administration pages and code for the Twitter search module.
 */

/**
 * Lists search strings.
 *
 * @return
 *  Page HTML.
 */
function twitter_search_list_page() {
  // Get search strings from database.
  $sql = "SELECT twitter_search_id, search
          FROM {twitter_search}
          ORDER BY last_refresh";
  $results = db_query($sql);

  $header = array(t('Search'), t('Operations'));

  $rows = array();
  while ($search = db_fetch_array($results)) {
    $rows[] = array(
      check_plain($search['search']),
      array('data' => l(t('delete'), 'admin/settings/twitter_search/delete/' . $search['twitter_search_id'])),
    );
  }

  if (empty($rows)) {
    $rows[] = array(
      array(
        'data' => t('No search terms have been created.'),
        'colspan' => '2',
        'class' => 'message',
      ),
    );
  }

  return theme('table', $header, $rows);
}

/**
 * Administration form.
 *
 * @return
 *  FAPI array.
 */
function twitter_search_add_form() {
  $form['search_string'] = array(
    '#type' => 'textfield',
    '#title' => t('Text to search Twitter for'),
    '#default_value' => '',
    '#required' => TRUE,
    '#size' => 50,
    '#maxlength' => 140,
    '#description' => t("Limited to 140 characters."),
  );
  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save search'),
  );
  $form['#submit'][] = 'twitter_search_add_form_submit';

  return $form;
}

/**
 * Search string form submit handler.
 *
 * @see twitter_search_add_form()
 *
 * @return
 *  FAPI array.
 */
function twitter_search_add_form_submit($form, &$form_state) {
  $search = array(
    'search' => check_plain($form_state['values']['search_string']),
    'last_twitter_id' => 0,
    'last_refresh' => 0,
  );

  // Insert entry into the database.
  drupal_write_record('twitter_search', $search);

  drupal_set_message(t('Twitter search text saved.'), 'status');
  $form_state['redirect'] = 'admin/settings/twitter_search';
  return;
}

/**
 * Menu callback; delete a single Twitter search.
 */
function twitter_search_delete_confirm(&$form_state) {
  $twitter_search_id = check_plain(arg(4));

  $sql = "SELECT search
          FROM {twitter_search}
          WHERE twitter_search_id = %d";
  $search_string = db_result(db_query($sql, $twitter_search_id));

  $form['twitter_search_id'] = array(
    '#type' => 'value',
    '#value' => $twitter_search_id,
  );
  $form['search_string'] = array(
    '#type' => 'value',
    '#value' => $search_string,
  );

  $message = t('Are you sure you want to delete the Twitter search "%search"?', array('%search' => $search_string));
  $caption = '<p>'. t('This action cannot be undone.') .'</p>';

  return confirm_form($form, $message, 'admin/settings/twitter_search', $caption, t('Delete'));
}

/**
 * Delete confirm sumbit handler.
 *
 * @see twitter_search_delete_confirm()
 */
function twitter_search_delete_confirm_submit($form, &$form_state) {
  $twitter_search_id = check_plain($form_state['values']['twitter_search_id']);
  $search_string = check_plain($form_state['values']['search_string']);

  $sql = "DELETE FROM {twitter_search}
          WHERE twitter_search_id = %d";
  $result = db_query($sql, $twitter_search_id);

  drupal_set_message(t('The search "%search" has been deleted.', array('%search' => $search_string)));

  $form_state['redirect'] = 'admin/settings/twitter_search';
  return;
}
