<?php

// Neocurator creates custom meta-data for potfolio projects

// add_action('load-post.php', 'neo_project_meta_box');
// add_action('load-post-new.php', 'neo_project_meta_box');

/* Meta box setup function. */
function neo_project_meta_box()
{

  /* Add meta boxes on the 'add_meta_boxes' hook. */
  add_action('add_meta_boxes', 'register_project_meta_box');

  /* Save post meta on the 'save_post' hook. */
  add_action('save_post', 'save_project_details_meta', 10, 2);
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function register_project_meta_box()
{

  add_meta_box(
    'project-details',      // Unique ID
    esc_html__('Project Class', 'example'),    // Title
    'project_details_meta_box',   // Callback function
    'project',         // Screen: Admin page (or post type)
    'normal',         // Context
    'default',         // Priority
    array(
      '__block_editor_compatible_meta_box' => false,
    )
  );
}

function project_details_meta_box($object, $box)
{ ?>

  <?php wp_nonce_field(basename(__FILE__), 'project_details_nonce'); ?>

  <p>
    <label for="project-details"><?php _e("Add a custom CSS class, which will be applied to WordPress' post class.", 'example'); ?></label>
    <br />
    <input class="widefat" type="text" name="project-class" id="project-class" value="<?php echo esc_attr(get_post_meta($object->ID, 'project_class', true)); ?>" size="30" />
  </p>
  <p>
    <label for="portfolio_project_Type">Project Type</label>
    <input type="text" size="80" name="project_type" id="my_project_type" value="<?php echo esc_attr(get_post_meta($object->ID, 'project_type', true)); ?>" />
  </p>

  <p>
    <label for="project_status">Current Status</label>
    <select name="project_status" value="<?php echo $selected ?>">
      <option value="wip" <?php selected($selected, 'wip'); ?>>Work In Progress</option>
      <option value="complete" <?php selected($selected, 'complete'); ?>>Completed</option>
      <option value="concept" <?php selected($selected, 'concept'); ?>>Concept</option>
    </select>
  </p>
<?php }

/* Save the meta box's post metadata. */
function save_project_details_meta($post_id, $post)
{

  /* Verify the nonce before proceeding. */
  if (!isset($_POST['project_details_nonce']) || !wp_verify_nonce($_POST['project_details_nonce'], basename(__FILE__)))
    return $post_id;

  /* Get the post type object. */
  $post_type = get_post_type_object($post->post_type);

  /* Check if the current user has permission to edit the post. */
  if (!current_user_can($post_type->cap->edit_post, $post_id))
    return $post_id;

  /* Get the posted data and sanitize it for use as an HTML class. */
  $new_meta_value = (isset($_POST['project-class']) ? sanitize_html_class($_POST['project-class']) : '');

  /* Get the meta key. */
  $meta_key = 'project_class';
  $key_1 = 'project_type';
  $key_2 = 'project_status';

  /* Get the meta value of the custom field key. */
  $meta_value = get_post_meta($post_id, $meta_key, $key_1, $key_2, false);

  /* If a new meta value was added and there was no previous value, add it. */
  if ($new_meta_value && '' == $meta_value)
    add_post_meta($post_id, $meta_key, $new_meta_value, $key_1, $key_2, false);

  /* If the new meta value does not match the old value, update it. */
  elseif ($new_meta_value && $new_meta_value != $meta_value)
    update_post_meta($post_id, $meta_key, $key_1, $key_2, $new_meta_value);

  /* If there is no new meta value but an old value exists, delete it. */
  elseif ('' == $new_meta_value && $meta_value)
    delete_post_meta($post_id, $meta_key, $key_1, $key_2, $meta_value);
}

function neocurator_get_author_name($object, $field_name, $request)
{
  return get_the_author_meta('display_name');
}
function neocurator_get_image_src($object, $field_name, $request)
{
  if ($object['featured_media'] == 0) {
    return $object['featured_media'];
  }
  $feat_img_array = wp_get_attachment_image_src($object['featured_media'], 'medium_large', true);
  return $feat_img_array[0];
}

function neocurator_published_date($object, $field_name, $request)
{
  return get_the_time('F j, Y');
}

?>