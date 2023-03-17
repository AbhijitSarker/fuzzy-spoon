<?php


//insert a new address
//return int / wperror
function fs_insert_address($args = [])
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

    $data = wp_parse_args($args, $defaults);

    if (isset($data['id'])) {

        $id = $data['id'];
        unset($data['id']);

        $updated = $wpdb->update(
            $wpdb->prefix . 'addresses',
            $data,
            ['id' => $id],
            [
                '%s',
                '%s',
                '%s',
                '%d',
                '%s'
            ],
            ['%d']
        );
        return $updated;
    } else {



        $inserted = $wpdb->insert(
            $wpdb->prefix . 'addresses',
            $data,
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
}

//fetch address
function fs_get_addresses($args = [])
{
    global $wpdb;

    $defaults  = [
        'number'  => 2,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'ASC'
    ];

    $args = wp_parse_args($args, $defaults);

    $sql = $wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}addresses
            ORDER BY {$args['orderby']} {$args['order']}
            LIMIT %d, %d",
        $args['offset'],
        $args['number']
    );

    $items = $wpdb->get_results($sql);

    return $items;
}

//GET THE COUNT OF TOTAL ADDRESSES
//RETURN INT
function fs_address_count()
{
    global $wpdb;

    return $wpdb->get_var("SELECT  count(id) FROM {$wpdb->prefix}addresses");
}

//fetch a single contact from db

function fs_get_address($id)
{
    global $wpdb;

    return $wpdb->get_row(
        $wpdb->prepare("SELECT * FROM {$wpdb->prefix}addresses WHERE id = %d", $id)
    );
}

//delete an addressS
function fs_delete_address($id)
{
    global $wpdb;

    return $wpdb->delete(
        $wpdb->prefix . 'addresses',
        ['id' => $id],
        ['%d']
    );
}
