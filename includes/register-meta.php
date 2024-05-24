<?php

/**
 * Register project meta
 */

register_post_meta(
  'project',
  'project-start',
  array(
    'show_in_rest' => true,
    'single' => true,
    'type' => 'string',
  )
);

register_post_meta(
  'project',
  'project-duration',
  array(
    'show_in_rest' => true,
    'single' => true,
    'type' => 'string',
  )
);

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
