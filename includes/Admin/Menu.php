<?php

namespace Fuzzy\Spoon\Admin;

//the menu handler class

class Menu
{
    function __construct()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    public function admin_menu()
    {
        $parent_slug = 'fuzzy-spoon';
        $capability = 'manage_options';


        add_menu_page(__('Fuzzy Spoon', 'fuzzy-spoon'), __('Spoon', 'fuzzy-spoon'), $capability, $parent_slug,  [$this, 'addressbook_page'], 'dashicons-admin-tools');

        add_submenu_page($parent_slug, __('Address Book', 'fuzzy-spoon'), __('Address Book', 'fuzzy-spoon'), $capability, $parent_slug, [$this, 'addressbook_page']);

        add_submenu_page($parent_slug, __('settings', 'fuzzy-spoon'), __('Settings', 'fuzzy-spoon'), $capability, 'fuzzy-spoon-settings', [$this, 'settings_page']);
    }

    public function addressbook_page()
    {
        $addressbook = new Addressbook();
        $addressbook->plugin_page();
    }

    public function settings_page()
    {
        echo 'hello settings';
    }
}
