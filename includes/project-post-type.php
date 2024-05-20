<?php

/** 
 * Register project post type
 */
function create_project_post_type()
{
  $labels = array(
    'name' => 'Projects',
    'singular_name' => 'Project',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Project',
    'edit' => 'Edit',
    'edit_item' => 'Edit Project',
    'new_item' => 'New Project',
    'view' => 'View',
    'view_item' => 'View Project',
    'search_items' => 'Search Projects',
    'not_found' => 'No Projects found',
    'not_found_in_trash' => 'No Projects found in Trash',
    'menu_name' => 'Projects',
    'parent' => 'Parent Project',
    'featured_image' => 'Default is Featured Image',
    'set_featured_image' => 'Set featured image',
    'remove_featured_image' => 'Remove featured image',
    'use_featured_image' => 'Use as featured image',
  );
  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'menu_position'      => 5,
    'taxonomies'         => array(''),
    'menu_icon'          => plugins_url('../images/image.png', __FILE__),
    'has_archive'        => true,
    'exclude_from_search' => false,
    'capability_type'    => 'post',
    'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields'),
    'description'        => __('A custom post type for portfolio projects', 'neocurator'),
    'show_in_rest'       => true,
    'rewrite'            => array('slug' => 'projects'),
    'template'           => array(
      array('core/image', array(
        'align'         => 'left',
      )),
      array('core/heading', array(
        'align'         => 'Add Author...',
      )),
      array('core/paragraph', array(
        'align'         => 'Add Description...',
      )),
    ),
  );

  register_post_type('project', $args);
}

// add_action('init', 'create_project_post_type');


/** 
 * Register block for project post type
 */

function neocurator_project_post_types_block_init()
{
  register_block_type(
    plugin_dir_path(__FILE__) . 'build',
    array(
      'render_callback' => 'neocurator_project_post_types_render_callback'
    )
  );
  // Register the project post type
  create_project_post_type();
}
add_action('init', 'neocurator_project_post_types_block_init');

function neocurator_project_post_types_render_callback($atts, $content, $block)
{
  ob_start();
  require plugin_dir_path(__FILE__) . 'build/template.php';
  return ob_get_clean();
}
/**
 * Register projrct meta
 */

register_post_meta(
  'project',
  'project-name',
  array(
    'show_in_rest' => true,
    'single' => true,
    'type' => 'string',
  )
);

register_post_meta(
  'project',
  'project-type',
  array(
    'show_in_rest' => true,
    'single' => true,
    'type' => 'string',
  )
);
