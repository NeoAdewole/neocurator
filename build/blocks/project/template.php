<?php

/**
 * Block markup
 */
$date     = get_post_meta(get_the_ID(), 'project-start', true);
$duration = get_post_meta(get_the_ID(), 'project-duration', true);
$project_type = get_post_meta(get_the_ID(), 'project-type', true);

?>
<!-- Determine how project is displayed based on type -->
<ul <?php echo get_block_wrapper_attributes(); ?>>
  <li>
    <span>Project Start Date:
      <?php echo date_i18n(get_option('date_format'), strtotime($date)); ?>
    </span>
  </li>
  <li><span>Duration: <?php echo esc_html(human_readable_duration($duration)); ?></span></li>
  <li class="project-type">
    <span>Project Type: <?= esc_html($project_type) ?></span>
  </li>
</ul>