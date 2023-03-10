<?php

namespace Fuzzy\Spoon;

//the admin class
class Admin
{
    //initialize the class
    function __construct()
    {
        $this->dispatch_actions();

        new Admin\Menu();
    }

    public function dispatch_actions()
    {
        $addressbook = new Admin\Addressbook();
        add_action('admin_init', [$addressbook, 'form_handler']);
    }
}
