<?php

namespace Fuzzy\Spoon\Admin;

use Fuzzy\Spoon\Traits\Form_Error;

//address book handler
class Addressbook
{
    use Form_Error;

    public function plugin_page()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        switch ($action) {
            case 'new':
                $template = __DIR__ . '/views/address-new.php';
                break;

            case 'edit':
                $address = fs_get_address($id);
                $template = __DIR__ . '/views/address-edit.php';
                break;

            case 'view':
                $template = __DIR__ . '/views/address-view.php';
                break;

            default:
                $template =  __DIR__ . '/views/address-list.php';
                break;
        }

        if (file_exists($template)) {
            include $template;
        }
    }


    //handle the form 
    //return void
    public function form_handler()
    {
        if (!isset($_POST['submit_address'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['_wpnonce'], 'new-address')) {
            wp_die('Are you cheating?');
        }

        if (!current_user_can('manage_options')) {
            wp_die('Are you cheating?');
        }

        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

        $name    = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $address = isset($_POST['address']) ? sanitize_textarea_field($_POST['address']) : '';
        $phone   = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';

        if (empty($name)) {
            $this->errors['name'] = __('Please provide a name', 'fuzzy-spoon');
        }

        if (empty($phone)) {
            $this->errors['phone'] = __('Please provide a phone number.', 'fuzzy-spoon');
        }

        if (!empty($this->errors)) {
            return;
        }

        $args = [
            'name'    => $name,
            'address' => $address,
            'phone'   => $phone
        ];

        if ($id) {
            $args['id'] = $id;
        }

        $insert_id = fs_insert_address($args);

        if (is_wp_error($insert_id)) {
            wp_die($insert_id->get_error_message());
        }

        if ($id) {
            $redirected_to = admin_url('admin.php?page=fuzzy-spoon&action=edit&address-updated=true&id=' . $id);
        } else {

            $redirected_to = admin_url('admin.php?page=fuzzy-spoon&inserted=true');
        }


        wp_redirect($redirected_to);
        exit;
    }

    public function delete_address()
    {
        if (!wp_verify_nonce($_REQUEST['_wpnonce'], 'fs-delete-address')) {
            wp_die('Are you cheating?');
        }

        if (!current_user_can('manage_options')) {
            wp_die('Are you cheating?');
        }

        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

        if (fs_delete_address($id)) {
            $redirected_to = admin_url('admin.php?page=fuzzy-spoon&address-deleted=true');
        } else {
            $redirected_to = admin_url('admin.php?page=fuzzy-spoon&address-deleted=false');
        }

        wp_redirect($redirected_to);
        exit;
    }
}
