<?php

namespace Fuzzy\Spoon\Frontend;


// Shortcode handler class

class Enquiry
{

    /**
     * Initializes the class
     */
    function __construct()
    {
        add_shortcode('spoon-enquiry', [$this, 'render_shortcode']);
    }


    // Shortcode handler class

    public function render_shortcode($atts, $content = '')
    {
        wp_enqueue_script('spoon-enquiry-script');
        wp_enqueue_style('spoon-enquiry-style');

        ob_start();
        include __DIR__ . '/views/enquiry.php';

        return ob_get_clean();
    }
}
