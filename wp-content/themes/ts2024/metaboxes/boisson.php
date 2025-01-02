<?php

class BoissonMetaBox {
    const META_KEY = 'ts24_boisson';
    const NONCE_KEY = 'ts24_boisson_nonce';

    public static function register() {
        add_action('add_meta_boxes', [self::class, 'add']);
        add_action('save_post', [self::class, 'save']);
    }

    public static function add() {
        $post_types = [ 'proTeamSquare', 'packTeamSquare', 'eventsTeamSquare'];
        foreach ($post_types as $post_type) {
            add_meta_box(self::META_KEY, 'Boisson', [self::class, 'render'], $post_type, 'side');
        }
    }

    public static function render($post) {
        $value = get_post_meta($post->ID, self::META_KEY, true);
        wp_nonce_field(self::NONCE_KEY, self::NONCE_KEY);
        ?>
        <input type="hidden" value="0" name="<?php echo self::META_KEY; ?>">
        <input type="checkbox" value="1" name="<?php echo self::META_KEY; ?>" <?= $value === '1' ? 'checked' : '' ?>>
        <label for="ts24Boisson">Les boissons sont offertes ?</label>
        <?php
    }

    public static function save($post_id) {
        if (!isset($_POST[self::NONCE_KEY]) || !wp_verify_nonce($_POST[self::NONCE_KEY], self::NONCE_KEY)) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (array_key_exists(self::META_KEY, $_POST)) {
            if ($_POST[self::META_KEY] === "0") {
                delete_post_meta($post_id, self::META_KEY);
            } else {
                update_post_meta($post_id, self::META_KEY, 1);
            }
        }
    }
}

BoissonMetaBox::register();

?>
