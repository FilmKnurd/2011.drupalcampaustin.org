/* $Id: maxlength.js,v 1.1.6.6.2.13 2010/06/27 07:44:50 dereine Exp $ */

Drupal.maxLength_limit = function (field, maxlength) {

  // calculate the remaining count of chars
  var limit = maxlength.limit;
  var length = field.val().length;
  var remainingCount = limit - length;

  // if there is not remaining char, we clear additional content
  if (remainingCount < 0) {
    field.val(field.val().substr(0, limit));
    remainingCnt = 0;
  }

  // Update the remaing chars text.
  maxlength.span_remaining_count.html(remainingCount.toString());
  // And the current count.
  if (maxlength.show_count) {
    maxlength.span_count.html(length.toString());
  }
}

Drupal.behaviors.maxlength = function (context) {
  // Get all the settings, and save the limits in the fields.
  var maxlength = {};
  var element = {};
  var limit = 50;
  for (var id in Drupal.settings.maxlength) {
    limit = Drupal.settings.maxlength[id];
    element = $("#"+ id);
    maxlength = $('#maxlength-' + element.attr('id').substr(5));

    maxlength.limit = limit;
    maxlength.show_count = false;
    maxlength.span_remaining_count = maxlength.find('span.maxlength-counter-remaining');
    maxlength.find('span.maxlength-count', function() {
      maxlength.show_count = true;
      maxlength.span_count = maxlength.find('span.maxlength-count');
    });

    // Update the count at the page load.
    Drupal.maxLength_limit(element, maxlength);

    element.load(function() {
      Drupal.maxLength_limit(element, maxlength);
    });
    element.keyup(function() {
      Drupal.maxLength_limit(element, maxlength);
    });
    element.change(function() {
      Drupal.maxLength_limit(element, maxlength);
    });
  }
}
