<?php


//insert a new address
//return int / wperror
function wd_ac_insert_address($args = [])
{
    global $wpdb;

    if (empty($args['name'])) {
        return new \WP_Error('no-name', __('You must have a name', 'fuzzy-spoon'));
    }

    $defaults = [
        'name' => '',
        'address' => '',
        'phone' => '',
        'created_by' => get_current_user_id(),
        'created_at' => current_time('mysql'),

    ];

    wp_parse_args($args, $defaults);

    $inserted = $wpdb->insert(
        "{$wpdb->prefix}addresses",
        $args,
        [
            '%s',
            '%s',
            '%s',
            '%d',
            '%s'
        ]

    );

    if (!$inserted) {
        return new WP_Error('failed-to-insert', __('Failed to insert data', 'fuzzy-spoon'));
    }

    return $wpdb->insert_id;
}
