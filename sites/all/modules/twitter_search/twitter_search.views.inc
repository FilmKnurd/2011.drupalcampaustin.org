<?php
/**
 * @file
 *  Provide views data and handlers.
 */

/**
 * Implementation of hook_views_data().
 */
function twitter_search_views_data() {
  $data = array();

   $data['twitter_search'] = array(
    'twitter_search_id' => array(
      'title' => t('twitter_search_id'),
      'help' => t('Unique identifier for each {twitter_search} string.'),
      'field' => array(
        'handler' => 'views_handler_field',
        'click sortable' => TRUE,
      ),
      'filter' => array(
        'handler' => 'views_handler_filter_numeric',
        'allow empty' => TRUE,
      ),
      'argument' => array(
        'handler' => 'views_handler_argument_numeric',
      ),
      'sort' => array(
        'handler' => 'views_handler_sort',
      ),
    ),
    'search' => array(
      'title' => t('search'),
      'help' => t('Search string to query Twitter for.'),
      'field' => array(
        'handler' => 'views_handler_field',
        'click sortable' => TRUE,
      ),
      'filter' => array(
        'handler' => 'views_handler_filter_string',
        'allow empty' => TRUE,
      ),
      'argument' => array(
        'handler' => 'views_handler_argument_string',
      ),
      'sort' => array(
        'handler' => 'views_handler_sort',
      ),
    ),
    'last_twitter_id' => array(
      'title' => t('last_twitter_id'),
      'help' => t('Unique identifier for the latest {twitter} post for this search.'),
      'field' => array(
        'handler' => 'views_handler_field',
        'click sortable' => TRUE,
      ),
      'filter' => array(
        'handler' => 'views_handler_filter_numeric',
        'allow empty' => TRUE,
      ),
      'argument' => array(
        'handler' => 'views_handler_argument_numeric',
      ),
      'sort' => array(
        'handler' => 'views_handler_sort',
      ),
    ),
    'last_refresh' => array(
      'title' => t('last_refresh'),
      'help' => t('A UNIX timestamp marking the date Twitter statuses were last fetched on.'),
      'field' => array(
        'handler' => 'views_handler_field',
        'click sortable' => TRUE,
      ),
      'filter' => array(
        'handler' => 'views_handler_filter_numeric',
        'allow empty' => TRUE,
      ),
      'argument' => array(
        'handler' => 'views_handler_argument_numeric',
      ),
      'sort' => array(
        'handler' => 'views_handler_sort',
      ),
    ),
    'table' => array(
      'group' => t('Twitter: Search'),
      'base' => array(
        'field' => 'twitter_search_id',
        'title' => t('Twitter search'),
        'help' => t('Twitter searches.'),
        'weight' => 10,
        'database' => 'default',
      ),
      'join' => array(
        'twitter_search_tweet' => array(
          'left_field' => 'twitter_search_id',
          'field' => 'twitter_search_id',
        ),
        'twitter' => array(
          'left_table' => 'twitter_search_tweet',
          'left_field' => 'twitter_search_id',
          'field' => 'twitter_search_id',
        ),
      ),
    ),
  );

  $data['twitter_search_tweet'] = array(
    'twitter_search_id' => array(
      'title' => t('twitter_search_id'),
      'help' => t('Unique identifier for each {twitter_search} string.'),
      'field' => array(
        'handler' => 'views_handler_field',
        'click sortable' => TRUE,
      ),
      'filter' => array(
        'handler' => 'views_handler_filter_numeric',
        'allow empty' => TRUE,
      ),
      'argument' => array(
        'handler' => 'views_handler_argument_numeric',
      ),
      'sort' => array(
        'handler' => 'views_handler_sort',
      ),
    ),
    'twitter_id' => array(
      'title' => t('twitter_id'),
      'help' => t('Unique identifier for each {twitter} post.'),
      'field' => array(
        'handler' => 'views_handler_field',
        'click sortable' => TRUE,
      ),
      'filter' => array(
        'handler' => 'views_handler_filter_numeric',
        'allow empty' => TRUE,
      ),
      'argument' => array(
        'handler' => 'views_handler_argument_numeric',
      ),
      'sort' => array(
        'handler' => 'views_handler_sort',
      ),
    ),
    'table' => array(
      'group' => t('Twitter: Search'),
      'join' => array(
      'twitter_search' => array(
          'left_field' => 'twitter_search_id',
          'field' => 'twitter_search_id',
        ),
        'twitter' => array(
          'left_field' => 'twitter_id',
          'field' => 'twitter_id',
        ),
      ),
    ),
  );
  return $data;
}
