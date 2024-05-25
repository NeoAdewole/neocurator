<?php

/**
 * Block markup
 */
$date     = get_post_meta(get_the_ID(), 'project-start', true);
$name = get_post_meta(get_the_ID(), 'project-name', true);
$duration = get_post_meta(get_the_ID(), 'project-duration', true);
$project_type = get_post_meta(get_the_ID(), 'project-type', true);
$project_status = get_post_meta(get_the_ID(), 'project-status', true);

?>
<!-- Display project details saved in meta -->
<ul <?php echo get_block_wrapper_attributes(); ?>>
  <h4>Project details</h4>
  <li class="">
    <span>Project Name: <?php echo esc_html($name); ?></span>
  </li>
  <li>
    <span>Project Start Date:
      <?php echo date_i18n(get_option('date_format'), strtotime($date)); ?>
    </span>
  </li>
  <li><span>Duration: <?php echo esc_html(human_readable_duration($duration)); ?></span></li>
  <li class="project-types">
    <span>Project Type: <?= esc_html($project_type) ?></span>
  </li>
  <li class="status">
    <span>Project Status: <?= esc_html($project_status) ?></span>
  </li>
</ul>