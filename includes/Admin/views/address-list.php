<div class="wrap">
    <h1 class="wp-heading-inline"><?php _e('Address Book', 'fuzzy-spoon'); ?></h1>

    <a href="<?php echo admin_url('admin.php?page=fuzzy-spoon&action=new'); ?>" class="page-title-action"> <?php _e('Add new', 'fuzzy-spoon'); ?></a>

    <form action="" method="post">
        <?php
        $table = new Fuzzy\Spoon\Admin\Address_List();
        $table->prepare_items();
        // $table->search_box('search', 'search_id');
        $table->display();
        ?>
    </form>
</div>