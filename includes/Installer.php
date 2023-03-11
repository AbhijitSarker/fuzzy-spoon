<?php

namespace Fuzzy\Spoon;

class Installer
{
    //run the installer
    function run()
    {
        $this->add_version();
        $this->create_table();
    }

    function add_version()
    {
        $installed = get_option('fuzzy_spoon_installed');

        if (!$installed) {
            update_option('fuzzy_spoon_installed', time());
        }

        update_option('fuzzy_spoon_version', FUZZY_SPOON_VERSION);
    }

    //create  necessary database table
    function create_table()
    {
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();

        $schema =   "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}addresses` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `name` varchar(100) NOT NULL DEFAULT '',
                        `address` varchar(255) DEFAULT NULL,
                        `phone` varchar(30) DEFAULT NULL,
                        `created_by` bigint(20) unsigned NOT NULL,
                        `created_at` datetime NOT NULL,
                        PRIMARY KEY (`id`)
                    ) $charset_collate";

        if (!function_exists('dbDelta')) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta($schema);
    }
}
