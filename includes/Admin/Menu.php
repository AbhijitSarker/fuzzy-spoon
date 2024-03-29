<?php

namespace Fuzzy\Spoon\Admin;

//the menu handler class

class Menu
{
    public $addressbook;


    function __construct($addressbook)
    {
        $this->addressbook = $addressbook;
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    public function admin_menu()
    {
        $parent_slug = 'fuzzy-spoon';
        $capability = 'manage_options';


        $hook = add_menu_page(__('Fuzzy Spoon', 'fuzzy-spoon'), __('Spoon', 'fuzzy-spoon'), $capability, $parent_slug,  [$this->addressbook, 'plugin_page'], 'dashicons-admin-tools');

        add_submenu_page($parent_slug, __('Address Book', 'fuzzy-spoon'), __('Address Book', 'fuzzy-spoon'), $capability, $parent_slug, [$this->addressbook, 'plugin_page']);

        add_submenu_page($parent_slug, __('settings', 'fuzzy-spoon'), __('Settings', 'fuzzy-spoon'), $capability, 'fuzzy-spoon-settings', [$this, 'settings_page']);

        add_action('admin_head-' . $hook, [$this, 'enqueue_assets']);
    }

    public function settings_page()
    {
        echo 'hello settings';
    }

    public function enqueue_assets()
    {
        wp_enqueue_style('fuzzy-admin-style');
        wp_enqueue_script('spoon-admin-script');
    }
}
