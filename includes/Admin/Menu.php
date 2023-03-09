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
        add_menu_page(__('Fuzzy Spoon', 'fuzzy-spoon'), __('Spoon', 'fuzzy-spoon'),  'manage_options', 'fuzzy_spoon',  [$this, 'plugin_page'], 'dashicons-admin-tools');
    }

    public function plugin_page()
    {
        echo 'hello world';
    }
}
