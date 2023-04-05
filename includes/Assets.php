<?php

namespace Fuzzy\Spoon;

class Assets
{
    function __construct()
    {
        add_action('wp_enqueue_scripts',  [$this, 'enqueue_assets']);
        add_action('admin_enqueue_scripts',  [$this, 'enqueue_assets']);
    }

    public function get_scripts()
    {
        return [
            'fuzzy-script' => [
                'src' => FUZZY_SPOON_ASSETS . '/js/frontend.js',
                'version' => filemtime(FUZZY_SPOON_PATH . '/assets/js/frontend.js'),
                'deps' => ['jquery']
            ],
            'spoon-enquiry-script' => [
                'src'     => FUZZY_SPOON_ASSETS . '/js/enquiry.js',
                'version' => filemtime(FUZZY_SPOON_PATH . '/assets/js/enquiry.js'),
                'deps'    => ['jquery']
            ],
            'spoon-admin-script' => [
                'src'     => FUZZY_SPOON_ASSETS . '/js/admin.js',
                'version' => filemtime(FUZZY_SPOON_PATH . '/assets/js/admin.js'),
                'deps'    => ['jquery', 'wp-util']
            ],
        ];
    }

    public function get_styles()
    {
        return [
            'fuzzy-style' => [
                'src' => FUZZY_SPOON_ASSETS . '/css/frontend.css',
                'version' => filemtime(FUZZY_SPOON_PATH . '/assets/css/frontend.css')
            ],
            'fuzzy-admin-style' => [
                'src' => FUZZY_SPOON_ASSETS . '/css/admin.css',
                'version' => filemtime(FUZZY_SPOON_PATH . '/assets/css/admin.css')
            ],
            'spoon-enquiry-style' => [
                'src'     => FUZZY_SPOON_ASSETS . '/css/enquiry.css',
                'version' => filemtime(FUZZY_SPOON_PATH . '/assets/css/enquiry.css')
            ],
        ];
    }

    function enqueue_assets()
    {
        $scripts = $this->get_scripts();
        $styles = $this->get_styles();

        foreach ($scripts as $handle => $script) {

            $deps = isset($script['deps']) ? $script['deps'] : false;

            wp_register_script($handle, $script['src'], $deps, $script['version'], true);
        }

        foreach ($styles as $handle => $style) {

            $deps = isset($style['deps']) ? $style['deps'] : false;

            wp_register_style($handle, $style['src'], $deps, $style['version']);
        }

        wp_localize_script('spoon-enquiry-script', 'fuzzySpoon', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'error' => __('something went wrong', 'fuzzy-spoon'),
        ]);
        wp_localize_script('spoon-admin-script', 'fuzzySpoon', [
            'nonce' => wp_create_nonce('fs-admin-nonce'),
            'confirm' => __('Are you sure?', 'fuzzy-spoon'),
            'error' => __('something went wrong', 'fuzzy-spoon'),
        ]);
    }
}
