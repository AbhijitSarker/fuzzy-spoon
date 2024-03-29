<div class="spoon-enquiry-form" id="spoon-enquiry-form">

    <form action="" method="post">

        <div class="form-row">
            <label for="name"><?php _e('Name', 'fuzzy-spoon'); ?></label>

            <input type="text" id="name" name="name" value="" required>
        </div>

        <div class="form-row">
            <label for="email"><?php _e('E-Mail', 'fuzzy-spoon'); ?></label>

            <input type="email" id="email" name="email" value="" required>
        </div>

        <div class="form-row">
            <label for="message"><?php _e('Message', 'fuzzy-spoon'); ?></label>

            <textarea name="message" id="message" required></textarea>
        </div>

        <div class="form-row">

            <?php wp_nonce_field('fs-enquiry-form'); ?>

            <input type="hidden" name="action" value="f_spoon_enquiry">
            <input type="submit" name="send_enquiry" value="<?php esc_attr_e('Send Enquiry', 'fuzzy-spoon'); ?>">
        </div>

    </form>
</div>