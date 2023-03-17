<?php

/**
 * Plugin Name: Fuzzy Spoon
 * Plugin URI: https://abhijitsarker.github.io/my-portfolio/
 * Description: Custom plugin for wordpress development
 * Version: 1.0
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Abhijit Sarker
 * Author URI: https://abhijitsarker.github.io/my-portfolio/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI: https://example.com/my-plugin/
 * Text Domain: fuzzy-spoon
 * Domain Path: /languages
 */


if (!defined('ABSPATH')) {
    die;
}

require_once __DIR__ . "/vendor/autoload.php";

//main plugin class 
final class Fuzzy_Spoon
{
    //plugin version
    const version  = '1.0';

    //class constructor
    private function __construct()
    {
        $this->define_constants();

        register_activation_hook(__FILE__, [$this, 'activate']);

        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    //initialize a singleton instance
    //return \fuzzy-spoon
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    //defining constants
    public function define_constants()
    {
        define('FUZZY_SPOON_VERSION', self::version);
        define('FUZZY_SPOON_FILE', __FILE__);
        define('FUZZY_SPOON_PATH', __DIR__);
        define('FUZZY_SPOON_URL', plugins_url('', FUZZY_SPOON_FILE));
        define('FUZZY_SPOON_ASSETS', FUZZY_SPOON_URL . '/assets');
    }

    //
    public function init_plugin()
    {
        new \Fuzzy\Spoon\Assets();

        if (is_admin()) {
            new Fuzzy\Spoon\Admin();
        } else {
            new Fuzzy\Spoon\Frontend();
        }
    }


    //Do stuff on activation
    public function activate()
    {
        $installer = new \Fuzzy\Spoon\Installer;
        $installer->run();
    }
}

//initialize the main plugin
//return \fuzzy-spoon
function fuzzy_spoon()
{
    return Fuzzy_Spoon::init();
}


//kick off the plugin
fuzzy_spoon();
