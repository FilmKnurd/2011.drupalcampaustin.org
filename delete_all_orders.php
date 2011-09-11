<?php
/*
  include_once './includes/bootstrap.inc';
  drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

  global $user;

  if ($user->uid == 1) {
    $result = db_query("select * from uc_orders");
    while($row = db_fetch_object($result)){
      //# uncomment below to view an order and exit
      //# usefull to write a query to only delete certain orders
      //print_r($row);
      //exit;
      print "deleting order $row->order_id\n";
      uc_order_delete($row->order_id); // comment this out for testing
    }
  } else {
    print "Only Administrator can delete orders.";
  }
*/
