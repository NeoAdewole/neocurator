<?php
add_action(
  'enqueue_block_editor_assets',
  function () {
    $project_panel_assets_path = NEOCURATOR__PLUGIN_DIR . 'build/plugin/project-meta-panel.asset.php';
    if (file_exists($project_panel_assets_path) && 'project' === get_post_type()) {
      $assets = require $project_panel_assets_path;
      wp_enqueue_script(
        'project-meta-panel',
        plugin_dir_url(__FILE__) . '../build/plugin/project-meta-panel.js',
        $assets['dependencies'],
        $assets['version'],
        true,
      );
    }
  }
);

function neocurator_project_post_types_render_callback($atts, $content, $block)
{
  ob_start();
  require plugin_dir_path(__FILE__) . '../build/blocks/project-meta-block/template.php';
  return ob_get_clean();
}
