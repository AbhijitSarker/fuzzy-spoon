<?php

namespace Fuzzy\Spoon\Admin;

use WP_List_Table;

if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

//list table class
class Address_List extends WP_List_Table
{
    function __construct()
    {
        parent::__construct([
            'singular' => 'contact',
            'plural' => 'contacts',
            'ajax' => false,
        ]);
    }

    //message to show if no designation found
    function no_items()
    {
        _e('No address found', 'fuzzy-spoon');
    }

    public function get_columns()
    {
        return [
            'cb'         => '<input type="checkbox" />',
            'name'       => __('Name', 'fuzzy-spoon'),
            'address'    => __('Address', 'fuzzy-spoon'),
            'phone'      => __('Phone', 'fuzzy-spoon'),
            'created_at' => __('Date', 'fuzzy-spoon'),
        ];
    }


    //get sortable collums
    function get_sortable_columns()
    {
        $sortable_collumns = [
            'name' => ['name', true],
            'created_at' => ['created_at', true],
        ];

        return $sortable_collumns;
    }

    function get_bulk_actions()
    {
        $actions = array(
            'trash'  => __('Move to Trash', 'wedevs-academy'),
        );

        return $actions;
    }

    // Default column values
    // param  object $item
    // return string
    protected function column_default($item, $column_name)
    {

        switch ($column_name) {

            case 'created_at':
                return wp_date(get_option('date_format'), strtotime($item->created_at));
                break;
            default:
                return isset($item->$column_name) ? $item->$column_name : '';
        }
    }

    // Render the "name" column
    public function column_name($item)
    {
        $actions = [];

        $actions['edit']   = sprintf(
            '<a href="%s" title="%s">%s</a>',
            admin_url('admin.php?page=fuzzy-spoon&action=edit&id=' . $item->id),
            $item->id,
            __('Edit', 'fuzzy-spoon'),
            __('Edit', 'fuzzy-spoon')
        );

        $actions['delete'] = sprintf(
            '<a href="#" class="submitdelete" data-id="%s">%s</a>',
            $item->id,
            __('Delete', 'fuzzy-spoon'),
        );

        return sprintf(
            '<a href="%1$s"><strong>%2$s</strong></a> %3$s',
            admin_url('admin.php?page=fuzzy-spoon&action=view&id' . $item->id),
            $item->name,
            $this->row_actions($actions)
        );
    }

    //Render the "check book" column
    protected function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="address_id[]" value="%d" />',
            $item->id
        );
    }

    public function prepare_items()
    {
        $column   = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [$column, $hidden, $sortable];

        $per_page     = 20;
        $current_page = $this->get_pagenum();
        $offset       = ($current_page - 1) * $per_page;

        $args = [
            'number' => $per_page,
            'offset' => $offset,
        ];

        if (isset($_REQUEST['orderby']) && isset($_REQUEST['order'])) {
            $args['orderby'] = $_REQUEST['orderby'];
            $args['order']   = $_REQUEST['order'];
        }

        $this->items = fs_get_addresses([$args]);

        $this->set_pagination_args([
            'total_items' => fs_address_count(),
            'per_page'    => $per_page
        ]);
    }
}
