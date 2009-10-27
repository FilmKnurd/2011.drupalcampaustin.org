<?php
// $Id: views-view-fields.tpl.php,v 1.6 2008/09/24 22:48:21 merlinofchaos Exp $
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->separator: an optional separator that may appear before a field.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */

$name = $row->node_users_node_data_field_profile_firstname_field_profile_firstname_value . ' ' . $row->node_users_node_data_field_profile_firstname_field_profile_lastname_value;
$name_link = l($name, 'node/' . $row->node_users_nid);
?>

<?php foreach ($fields as $id => $field): ?>
    <div class="picture"><?php print $field->content; ?></div>
    <div class="profile-link"><?php print $name_link; ?></div>
<?php endforeach; ?>
