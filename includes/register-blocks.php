<?php

/** 
 * Register block for project post type
 */

function neocurator_project_post_types_block_init()
{
  $blocks = [
    ['name' => 'project'],
    ['name' => 'project-meta-block', 'options' => ['render_callback' => 'neocurator_project_post_types_render_callback']],
  ];

  foreach ($blocks as $block) {
    register_block_type(
      NEOCURATOR__PLUGIN_DIR . 'build/blocks/' . $block['name'],
      isset($block['options']) ? $block['options'] : []
    );
  }

  // Register the project post type
  create_project_post_type();
}
add_action('init', 'neocurator_project_post_types_block_init');
