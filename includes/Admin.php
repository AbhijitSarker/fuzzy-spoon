<?php

namespace Fuzzy\Spoon;

//the admin class
class Admin
{
    //initialize the class
    function __construct()
    {
        $addressbook = new Admin\Addressbook();

        $this->dispatch_actions($addressbook);

        new Admin\Menu($addressbook);
    }

    public function dispatch_actions($addressbook)
    {
        add_action('admin_init', [$addressbook, 'form_handler']);
    }
}
