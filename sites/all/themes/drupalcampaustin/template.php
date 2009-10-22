<?php

/*
function drupalcampaustin_preprocess_page(&$vars) {
}
*/

function drupalcampaustin_preprocess_node(&$vars) {
  global $user;
  $node = $vars['node'];
  $node_author = user_load($vars['uid']);

  /*
   * Add node classes
   */

  // Class for node type: "node-type-page", "node-type-story", "node-type-my-custom-type", etc.
  $node_classes = array('node-type-'. $node->type);

  // Is this node stickied?
  if ($vars['sticky']) {
    $node_classes[] = 'sticky';
  }

  // Is this node published?
  if ($node->status) {
    $node_classes[] = 'node-published';
    $vars['published'] = TRUE;
  }
  else {
    $node_classes[] = 'node-unpublished';
    $vars['published'] = FALSE;
  }

  // Is this node authored by the current user?
  $vars['is_my_node'] = FALSE;
  if ($node->uid && $node->uid == $user->uid) {
    $node_classes[] = 'node-mine';
    $vars['is_my_node'] = TRUE;
  }

  // Is this node a teaser?
  if ($vars['teaser']) {
    $node_classes[] = 'node-teaser';
  }

  // Is this a page with multiple nodes?
  if (!$vars['page']) {
    $node_classes[] = 'node-list';
  }

  /*
   * Content type-specific stuff
   */

  switch ($node->type) {
    case 'profile':
      $node_classes[] = 'profile-sponsor';
      drupalcamp_preprocess_node_profile($vars, $node, $node_author);
      break;
    case 'sponsor':
      $node_classes[] = 'profile-sponsor';
      drupalcamp_preprocess_node_sponsor($vars, $node, $node_author);
      break;
    default:
      break;
  }

  $vars['node_classes'] = implode(' ', $node_classes);
}

function drupalcamp_preprocess_node_profile(&$vars, $node, $node_author) {
  // Leave a helpful message for the user if they are viewing their own
  // profile page
  if ($vars['is_my_node']) {
    drupal_set_message(t('Hi! You are viewing your profile page. You can change this information by clicking the !edit link above. If you need to change account information (password, email address, etc.), you should visit !youraccountpage. You account page is not publicly visible.', array('!edit' => l(t('edit'), 'node/' . $node->nid . '/edit'), '!youraccountpage' => l(t('your account page'), 'user/' . $user->uid))));
  }

  // Build a list of roles
  $roles = array();
  if (in_array('organizer', $node_author->roles)) {
    $roles[] = t('Organizer');
  }
  if (in_array('sponsor', $node_author->roles)) {
    $roles[] = t('Sponsor');
  }
  // A user cannot be both a speaker and an attendee
  if (in_array('speaker', $node_author->roles)) {
    $roles[] = t('Speaker');
  }
  elseif (in_array('attendee', $node_author->roles)) {
    $roles[] = t('Attendee');
  }
  $vars['roles'] = drupalcampaustin_serialize($roles);

  // Build a list of action links
  $profile_action_links = array();
  $profile_action_links[] = l(t('Contact @name', array('@name' => $node->title)), 'user/' . $node->uid . '/contact');
  $vars['profile_action_links'] = theme('item_list', $profile_action_links);

  // Build a list of website links
  $profile_web_links = array();
  if ($vars['field_link_professional'][0]['view']) {
    $profile_web_links[] = $vars['field_link_professional'][0]['view'];
  }
  if ($vars['field_link_personal'][0]['view']) {
    $profile_web_links[] = $vars['field_link_personal'][0]['view'];
  }
  if ($vars['field_link_twitter'][0]['view']) {
    $profile_web_links[] = $vars['field_link_twitter'][0]['view'];
  }
  if ($vars['field_link_flickr'][0]['view']) {
    $profile_web_links[] = $vars['field_link_flickr'][0]['view'];
  }
  if (!empty($profile_web_links)) {
    $vars['profile_web_links'] = theme('item_list', $profile_web_links);
  }

  // Build a list of skills (areas of interest)
  $profile_skills = array();
  if ($vars['field_profile_skills'][0]['view']) {
    foreach ($vars['field_profile_skills'] as $skill) {
      $profile_skills[] = l($skill['view'], 'directory/interest-area/' . $skill['value']);
    }
  }
  if (!empty($profile_skills)) {
    $vars['profile_skills'] = theme('item_list', $profile_skills);
  }
}

function drupalcamp_preprocess_node_sponsor(&$vars, $node, $node_author) {
  // Add sponsor level text
  $vars['sponsor_level'] = $vars['field_sponsor_level'][0]['view'];
  if ($vars['teaser']) {
    $vars['sponsor_level'] .= ': ' . $node->title;
  }

  // Build a list of website links
  $sponsor_web_links = array();
  if ($vars['field_link_professional'][0]['view']) {
    $sponsor_web_links[] = $vars['field_link_professional'][0]['view'];
  }
  if ($vars['field_link_twitter'][0]['view']) {
    $sponsor_web_links[] = $vars['field_link_twitter'][0]['view'];
  }
  if (!empty($sponsor_web_links)) {
    $vars['sponsor_web_links'] = theme('item_list', $sponsor_web_links);
  }

  // Build list of attendees
  $sponsor_attendees = array();
  $field_sponsor_attendees = $vars['field_sponsor_attendees'];
  foreach ($field_sponsor_attendees as $field_sponsor_attendee) {
    if (!empty($field_sponsor_attendee['view'])) {
      $sponsor_attendees[] = $field_sponsor_attendee['view'];
    }
  }
  if (!empty($sponsor_attendees)) {
    $vars['sponsor_attendees'] = theme('item_list', $sponsor_attendees);
  }
}

function drupalcampaustin_serialize($items) {
  $output = '';
  $item_count = count($items);

  switch ($item_count) {
    case 0 : // No items
      break;

    case 1 : // One item (output: "Item1")
      $output .= implode('', $items);
      break;

    case 2 : // Two authors (output: "Item1 and Item2")
      $output .= implode(t(' and '), $items);
      break;

    default : // More than two items (output: "Item1, Item2, and Item3")
      $i = 1;
      foreach ($items as $item) {
        // If this is the last author
        if ($i == $item_count) {
          $output .= t('and ') . $item;
        }
        else {
          $output .= $item .', ';
        }
        $i++;
      }
      break;
  }

  return $output;
}

/**
 * Override theme_status_messages().
 *
 * Appends "messages-" to the message $type class to prevent collisions with div.warning.
 * Adds "messages-multiple" class when more than one message of a particular type is present.
 */
function drupalcampaustin_status_messages($display = NULL) {
  /* DEBUGGING | TODO: REMOVE
  drupal_set_message('Message1. Appends "messages-" to the message $type class to prevent collisions with div.warning. Adds "messages-multiple" class when more than one message of a particular type is present.');
  drupal_set_message('Message2. Appends "messages-" to the message $type class to prevent collisions with div.warning. Adds "messages-multiple" class when more than one message of a particular type is present.');
  drupal_set_message('Message3');
  drupal_set_message('Message4');
  
  drupal_set_message('Message1. Appends "messages-" to the message $type class to prevent collisions with div.warning. Adds "messages-multiple" class when more than one message of a particular type is present.', 'warning');
  drupal_set_message('Message2. Appends "messages-" to the message $type class to prevent collisions with div.warning. Adds "messages-multiple" class when more than one message of a particular type is present.', 'warning');
  drupal_set_message('Message3', 'warning');
  drupal_set_message('Message4', 'warning');
  
  drupal_set_message('Message1', 'error');
  drupal_set_message('Message2', 'error');
  drupal_set_message('Message3', 'error');
  drupal_set_message('Message4', 'error');
  */

  $output = '';
  foreach (drupal_get_messages($display) as $type => $messages) {
    $output .= '<div class="messages messages-' . $type;
    if (count($messages) > 1) {
      $output .= ' messages-multiple">' . "\n" . '<ul>' . "\n";
      foreach ($messages as $message) {
        $output .= '<li>' . $message . '</li>' . "\n";
      }
      $output .= '</ul>' . "\n";
    }
    else {
      $output .= '">'. $messages[0];
    }
    $output .= '</div>' . "\n";
  }
  return $output;
}

/**
 * Override theme_help().
 *
 * Wraps help in <p> tags if they don't already exist.
 */
function drupalcampaustin_help() {
  if ($help = menu_get_active_help()) {
    if (substr($help, 0, 3) != '<p>') {
      $help = '<p>'. $help .'</p>';
    }
    return '<div class="help">'. $help .'</div>';
  }
}

function drupalcampaustin_item_list($items = array(), $title = NULL, $type = 'ul', $attributes = NULL) {
  $output = '<div class="item-list">';
  if (isset($title)) {
    $output .= '<h3>'. $title .'</h3>';
  }

  if (!empty($items)) {
    $output .= "<$type". drupal_attributes($attributes) .'>';
    $num_items = count($items);
    foreach ($items as $i => $item) {
      $attributes = array();
      $children = array();
      if (is_array($item)) {
        foreach ($item as $key => $value) {
          if ($key == 'data') {
            $data = $value;
          }
          elseif ($key == 'children') {
            $children = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $data = $item;
      }
      if (count($children) > 0) {
        $data .= theme_item_list($children, NULL, $type, $attributes); // Render nested list
      }
      else {
        // Single-level lists will have zebra values added
        if ($i % 2) {
          $attributes['class'] = empty($attributes['class']) ? 'even' : ($attributes['class'] .' even');
        }
        else {
          $attributes['class'] = empty($attributes['class']) ? 'odd' : ($attributes['class'] .' odd');
        }
      }
      if ($i == 0) {
        $attributes['class'] = empty($attributes['class']) ? 'first' : ($attributes['class'] .' first');
      }
      if ($i == $num_items - 1) {
        $attributes['class'] = empty($attributes['class']) ? 'last' : ($attributes['class'] .' last');
      }
      $output .= '<li'. drupal_attributes($attributes) .'>'. $data ."</li>\n";
    }
    $output .= "</$type>";
  }
  $output .= '</div>';

  return $output;
}

function drupalcampaustin_menu_local_tasks() {
  $output = '';

  if ($primary = menu_primary_local_tasks()) {
    $output .= '<ul class="tabs primary clearfix">' . $primary . '</ul>';
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $output .= '<ul class="tabs secondary clearfix">' . $secondary . '</ul>';
  }

  return $output;
}
