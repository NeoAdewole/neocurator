<?php

class Neocurator
{

  private static $initiated = false;

  public static function init()
  {
    if (!self::$initiated) {
      self::init_hooks();
    }
  }

  /**
   * Initializes WordPress hooks
   */
  private static function init_hooks()
  {
    self::$initiated = true;
  }

  /**
   * Activate Neocurator plugin 
   * Checks WP Version compatibility, Create Project Post Type, Creates social rating table.
   */
  public static function nc_plugin_activation()
  {
    if (version_compare($GLOBALS['wp_version'], NEOCURATOR__MINIMUM_WP_VERSION, '<')) {
      load_plugin_textdomain('neocurator');

      $message = '<strong>' . esc_html__(
        sprintf(
          'NeoCurator %1$f! requires WordPress %2$f or higher.',
          NEOCURATOR_VERSION,
          NEOCURATOR__MINIMUM_WP_VERSION
        ),
        'neocurator'
      ) . '</strong> ' . __(
        sprintf(
          "Please <a href='%s'>upgrade WordPress</a> to a current version to use this plugin.",
          "https://codex.wordpress.org/Upgrading_WordPress"
        ),
        "neocurator"
      );

      // neocurator::nc_bail_on_activation($message);
    } elseif (!empty($_SERVER['SCRIPT_NAME']) && false !== strpos($_SERVER['SCRIPT_NAME'], '/wp-admin/plugins.php')) {
      add_option('Activated_neocurator', true);
    }

    // create_project_post_type();
    flush_rewrite_rules();
  }

  public static function nc_bail_on_activation($message, $deactivate = true)
  {
?>
    <!doctype html>
    <html>

    <head>
      <meta charset="<?php bloginfo('charset'); ?>" />
      <style>
        * {
          text-align: center;
          margin: 0;
          padding: 0;
          font-family: "Lucida Grande", Verdana, Arial, "Bitstream Vera Sans", sans-serif;
        }

        p {
          margin-top: 1em;
          font-size: 18px;
        }
      </style>
    </head>

    <body>
      <p><?php echo esc_html($message); ?></p>
    </body>

    </html>
<?php
    if ($deactivate) {
      $plugins = get_option('active_plugins');
      $clearblocks = plugin_basename(CLEARBLOCKS__PLUGIN_DIR . 'clearblocks.php');
      $update  = false;
      foreach ($plugins as $i => $plugin) {
        if ($plugin === $clearblocks) {
          $plugins[$i] = false;
          $update = true;
        }
      }

      if ($update) {
        update_option('active_plugins', array_filter($plugins));
      }
    }
    exit;
  }

  /**
   * Removes all connection options
   * @static
   */
  public static function nc_plugin_deactivation()
  {
    // Unregister the post type, so the rules are no longer in memory.
    unregister_post_type('project');
    // Clear the permalinks to remove our post type's rules from the database.
    flush_rewrite_rules();

    // Remove any scheduled cron jobs.
    // $clearblocks_cron_events = array(
    //   'clearblocks_schedule_cron_recheck',
    //   'clearblocks_scheduled_delete',
    // );

    // foreach ($clearblocks_cron_events as $clearblocks_cron_event) {
    //   $timestamp = wp_next_scheduled($clearblocks_cron_event);

    //   if ($timestamp) {
    //     wp_unschedule_event($timestamp, $clearblocks_cron_event);
    //   }
    // }
  }
}
