<?php

function neocurator_add_custom_post_types($query)
{
  if (is_home() && $query->is_main_query()) {
    $query->set('post_type', array('post', 'project'));
  }
  return $query;
}
add_action('pre_get_posts', 'neocurator_add_custom_post_types');


// add_filter('single_project_template', 'load_single_project_template', 10, 1);
/* function load_single_project_template($single_template)
{
  $object                            = get_queried_object();
  $single_posttype_postname_template = locate_template("single-{$object->post_type}-{$object->post_name}.php");

  if (file_exists($single_posttype_postname_template)) {
    // serve template file from the from the plugin
    return plugin_dir_path(__FILE__) .  '/includes/single-project.php';
  } else {
    return $single_template;
  }
} */
