<?php

namespace Fuzzy\Spoon;

//frontend handler class

class Frontend
{
    function  __construct()
    {
        new Frontend\Shortcode();
        new Frontend\Enquiry();
    }
}
