<?php

namespace Fuzzy\Spoon;

//ajax handler class

class Ajax
{
    function __construct()
    {
        add_action('wp_ajax_f_spoon_enquiry', [$this, 'submit_enquiry']);
        add_action('wp_ajax_nopriv_f_spoon_enquiry', [$this, 'submit_enquiry']);

        add_action('wp_ajax_f_spoon_delete_contact', [$this, 'delete_contact']);
    }

    public function submit_enquiry()
    {
        // if (!wp_verify_nonce($_REQUEST['_wpnonce'], 'fs-enquiry-form')) {
        //     wp_send_json_error([
        //         'message' => 'nonce verification went wrong',

        //     ]);
        // }

        wp_send_json_success([
            'message' => 'Enquiry has been sent successfully'
        ]);

        // wp_send_json_error([
        //     'message' => 'Something went wrong',
        // ]);

        // wp_die();
    }

    public function delete_contact()
    {
        wp_send_json_success();
    }
}
