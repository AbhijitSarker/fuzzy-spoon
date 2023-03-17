<?php

namespace  Fuzzy\Spoon\Frontend;

//shortcode handler class

class Shortcode
{

    //initializes the class
    function __construct()
    {
        add_shortcode('fuzzy-spoon', [$this,  'render_shortcode']);
    }

    //shortcode handler class
    //param array  $atts
    //param string

    //string
    public function render_shortcode($atts, $content = '')
    {
        wp_enqueue_script('fuzzy-script');
        wp_enqueue_style('fuzzy-style');

        return '<div class="spoon-shortcode">Hello from shortcode.</div>';
    }
}
