<?php

function dcatx_preprocess(&$vars, $hook) {
  if (($hook == 'box') && ($vars['title'] == 'Post new comment')) {
    $vars['template_files'][] = 'box-comment_form';
  }
}


function dcatx_preprocess_node(&$vars) {
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
      dcatx_preprocess_node_profile($vars, $node, $node_author);
      break;
    case 'sponsor':
      dcatx_preprocess_node_sponsor($vars, $node, $node_author);
      break;
    case 'session':
      dcatx_preprocess_node_session($vars, $node, $node_author);
      break;
    default:
      break;
  }

  $vars['node_classes'] = implode(' ', $node_classes);
}


function dcatx_preprocess_node_profile(&$vars, $node, $node_author) {
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
  $vars['roles'] = dcatx_serialize($roles);

  // Create a uniform name for the profile picture
  $vars['profile_picture'] = $vars['field_user_picture_rendered'];

  // Build a list of action links
  $vars['profile_action_links'] = dcatx_profile_action_links($node);

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
//  krumo($vars['field_profile_skills']);
  if ($vars['field_profile_skills'][0]['view']) {
    foreach ($vars['field_profile_skills'] as $skill) {
      $skill_path = $skill['view'];
      $synonyms = taxonomy_get_synonyms($skill['value']);
      if (!empty($synonyms)) {
        $skill_path = $synonyms[0];
      }
      else {
        $skill_path = str_replace(' ', '-', $skill_path);
        $skill_path = str_replace('/', '-', $skill_path);
        $skill_path = strtolower($skill_path);
      }
      $profile_skills[] = l($skill['view'], 'attendees/interest/' . $skill_path);
    }
  }
  if (!empty($profile_skills)) {
    $vars['profile_skills'] = theme('item_list', $profile_skills);
  }

  // Add a non-breaking space to content if it's empty
  // Otherwise, the left column will collapse
  if(empty($vars['content'])) {
    $vars['content'] = '&nbsp;';
  }
}

function ns() {
  $args = func_get_args();
  $default = array_shift($args);
  // Get the type of class, i.e., 'grid', 'pull', 'push', etc.
  // Also get the default unit for the type to be procesed and returned.
  list($type, $return_unit) = explode('-', $default);

  // Process the conditions.
  $flip_states = array('var' => 'int', 'int' => 'var');
  $state = 'var';
  foreach ($args as $arg) {
    if ($state == 'var') {
      $var_state = !empty($arg);
    }
    elseif ($var_state) {
      $return_unit = $return_unit - $arg;
    }
    $state = $flip_states[$state];
  }

  $output = '';
  // Anything below a value of 1 is not needed.
  if ($return_unit > 0) {
    $output = $type . '-' . $return_unit;
  }
  return $output;
}


function dcatx_preprocess_node_sponsor(&$vars, $node, $node_author) {
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


function dcatx_preprocess_node_session(&$vars, $node, $node_author) {
  global $user;

  // Add session voting if it's open.
  if (SESSION_VOTING_OPEN) {
    if (user_access('rate content') && fivestar_validate_target('node', $node->nid)) {
      // Display the Fivestar rating.
      $vars['vote'] = '<div class="vote-form">' . fivestar_widget_form($node) . '</div>';
    }
    elseif ($user->uid != 0) {
      $vars['vote'] = l('<img src="/' . path_to_theme() . '/images/session-vote-purchase.png" alt="' . t('You must purchase admission to vote on sessions') . '" />', 'register/admission', array('html' => TRUE));
    }
    else {
      $vars['vote'] = l('<img src="/' . path_to_theme() . '/images/session-vote-login.png" alt="' . t('You must be logged in and registered to vote on sessions') . '" />', 'user/login', array('html' => TRUE));
    }
  }

  // Add session attendance flag if it's open.
  if (SESSION_ATTENDANCE_OPEN) {
    if (dcatx_library_user_has_role('attendee', $user)) {
      $vars['attend'] = flag_create_link('session_attend', $node->nid);
    }
    elseif ($user->uid != 0) {
      $vars['attend'] = l('<img src="/' . path_to_theme() . '/images/session-attend-purchase.png" alt="' . t('You must purchase admission to attend sessions') . '" />', 'register/admission', array('html' => TRUE));
    }
    else {
      $vars['attend'] = l('<img src="/' . path_to_theme() . '/images/session-attend-login.png" alt="' . t('You must be logged in and registered to attend sessions') . '" />', 'user/login', array('html' => TRUE));
    }
  }

  // Add the user picture.
  if ($node->teaser) {
    $vars['profile_picture'] = dcatx_profile_picture($node_author, $node_author->profile, TRUE, 'user_picture_50x50');
  }
  else {
    $vars['profile_picture'] = dcatx_profile_picture($node_author, $node_author->profile);
  }

  // Add user "action" links (contact, etc.).
  $vars['profile_action_links'] = dcatx_profile_action_links($node_author->profile);
}


function dcatx_preprocess_comment_wrapper(&$vars) {
  $node = $vars['node'];

  $vars['comments_exist'] = FALSE;
  if ($node->comment_count > 0) {
    $vars['comments_exist'] = TRUE;
  }
}


function dcatx_preprocess_comment(&$vars) {
  global $user;
  static $thread_number = 0;
  static $thread_child_number = 0;
  $node = $vars['node'];
  $comment = $vars['comment'];
  $comment_author = user_load($comment->uid);

  /*
   * Add comment classes
   */

  // Add some default classes
  $comment_classes = array('comment', $vars['status']);

  // Is this comment new?
  if ($comment->new) {
    $comment_classes[] = 'comment-new';
  }

  // Is this comment unpublished?
  if ($comment->status) {
    $comment_classes[] = 'comment-unpublished';
  }

  // Is this comment authored by the node's author?
  if ($node->uid == $comment->uid) {  
    $comment_classes[] = 'comment-author';
  }

  // Is this comment authored by the current user?
  if ($user->uid == $comment->uid) {  
    $comment_classes[] = 'comment-mine';
  }

  // Is this a top-level comment?
  if ($comment->depth === 0) {
    $thread_number++; // Increment thread number for color below
    $comment_classes[] = 'comment-thread-top';
    $thread_child_number = 0;
  }
  else {
    $comment_classes[] = 'comment-thread-child';
    $thread_child_number++; // Increment thread child number for even/odd striping
    if ($thread_child_number % 2) {
      $comment_classes[] = 'comment-thread-child-odd';
    }
    else {
      $comment_classes[] = 'comment-thread-child-even';
    }
  }

  $vars['profile_picture'] = dcatx_profile_picture($comment_author, $comment_author->profile, TRUE, 'user_picture_50x50');

  $vars['comment_classes'] = implode(' ', $comment_classes);
}


function dcatx_profile_picture($user, $profile_node, $linked = TRUE, $preset = NULL) {
  $profile_node_built = node_build_content($profile_node);

  if (!empty($preset)) {
    $picture = theme('imagecache', $preset, $profile_node_built->field_user_picture[0]['filepath']);
  }
  else {
    $picture = drupal_render($profile_node_built->content['group_profile_personal']['group']['field_user_picture']['field']);
  }

  if ($linked) {
    return l($picture, 'user/' . $user->uid, array('html' => TRUE, 'attributes' => array('title' => t('View @name\'s profile', array('@name' => $profile_node->title)), 'rel' => 'nofollow')));
  }

  return $picture;
}


function dcatx_preprocess_flag(&$vars) {
  $flag = $vars['flag'];

  if ($flag->name == 'session_attend') {
    $image_file = path_to_theme() . '/images/session-attend-' . ($vars['action'] == 'flag' ? 'yes' : 'no') . '.png';
    // Uncomment the following line when debugging.
    // drupal_set_message("Flag is looking for '$image_file'...");
    if (file_exists($image_file)) {
      $vars['link_text'] = '<img src="' . base_path() . $image_file . '" alt="' . ($vars['action'] == 'flag' ? $flag->flag_short : $flag->unflag_short) . '" />';
    }
  }
}


function dcatx_profile_action_links($profile_node) {
  $profile_action_links = array();

  $profile_action_links[] = l(t('Contact'), 'user/' . $profile_node->uid . '/contact', array('attributes' => array('title' => t('Contact @name', array('@name' => $profile_node->title)))));

  return theme('item_list', $profile_action_links);
}


function dcatx_serialize($items) {
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
 * Override theme_node_submitted().
 */
function dcatx_username($object) {

  if ($object->uid && $object->name) {
    // Shorten the name when it is too long or it will break many tables.
    if (drupal_strlen($object->name) > 20) {
      $name = drupal_substr($object->name, 0, 15) .'...';
    }
    else {
      $name = $object->name;
    }

    // BEGIN CUSTOMIZATIONS
    $user = user_load($object->uid);
    $name = $user->profile->title;

    if ($name[strlen($name) - 1] == 's') {
      $title_text = t("View @name' profile", array('@name' => $name));
    }
    else {
      $title_text = t("View @name's profile", array('@name' => $name));
    }

    $output = l($name, 'user/'. $user->uid, array('attributes' => array('title' => $title_text)));
    // END CUSTOMIZATIONS
  }
  else if ($object->name) {
    // Sometimes modules display content composed by people who are
    // not registered members of the site (e.g. mailing list or news
    // aggregator modules). This clause enables modules to display
    // the true author of the content.
    if (!empty($object->homepage)) {
      $output = l($object->name, $object->homepage, array('attributes' => array('rel' => 'nofollow')));
    }
    else {
      $output = check_plain($object->name);
    }

    $output .= ' ('. t('not verified') .')';
  }
  else {
    $output = check_plain(variable_get('anonymous', t('Anonymous')));
  }

  return $output;
}


/**
 * Override theme_node_submitted().
 */
function dcatx_node_submitted($node) {
  return t('!username | @date',
    array(
      '!username' => theme('username', $node),
      '@date' => format_date($node->created, 'custom', 'l, F jS, Y'),
    ));
}


/**
 * Override theme_comment_submitted().
 */
function dcatx_comment_submitted($comment) {
  return t('!username | @date',
    array(
      '!username' => theme('username', $comment),
      '@date' => format_date($comment->timestamp, 'custom', 'l, F jS, Y'),
    ));
}


/**
 * Override theme_status_messages().
 *
 * Appends "messages-" to the message $type class to prevent collisions with div.warning.
 * Adds "messages-multiple" class when more than one message of a particular type is present.
 */
function dcatx_status_messages($display = NULL) {
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
function dcatx_help() {
  if ($help = menu_get_active_help()) {
    if (substr($help, 0, 3) != '<p>') {
      $help = '<p>'. $help .'</p>';
    }
    return '<div class="help">'. $help .'</div>';
  }
}


function dcatx_item_list($items = array(), $title = NULL, $type = 'ul', $attributes = NULL) {
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


function dcatx_menu_local_tasks() {
  $output = '';

  if ($primary = menu_primary_local_tasks()) {
    $output .= '<ul class="tabs primary clearfix">' . $primary . '</ul>';
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $output .= '<ul class="tabs secondary clearfix">' . $secondary . '</ul>';
  }

  return $output;
}
