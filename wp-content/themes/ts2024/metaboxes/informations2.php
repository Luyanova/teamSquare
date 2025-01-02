<?php

class Informations2MetaBox {
    const META_KEY = 'ts24_informations2';
    const NONCE_KEY = 'ts24_informations2_nonce';
    const DEFAULT_VALUE = '2 à 4 Activités';

    public static function register() {
        add_action('add_meta_boxes', [self::class, 'add']);
        add_action('save_post', [self::class, 'save']);
    }

    public static function add() {
        $post_types = ['eventsTeamSquare', 'salleTeamSquare', 'proTeamSquare', 'packTeamSquare'];
        foreach ($post_types as $post_type) {
            add_meta_box(self::META_KEY, 'Informations 2', [self::class, 'render'], $post_type, 'side', 'default');
        }
    }

    public static function render($post) {
        $value = get_post_meta($post->ID, self::META_KEY, true);
        if (empty($value)) {
            $value = self::DEFAULT_VALUE;
        }
        wp_nonce_field(self::NONCE_KEY, self::NONCE_KEY);
        ?>
        <textarea name="<?php echo self::META_KEY; ?>" rows="5" style="width:100%;"><?php echo esc_textarea($value); ?></textarea>
        <label for="<?php echo self::META_KEY; ?>">Informations complémentaires qui s'affiche sur une deuxième ligne</label>
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
            update_post_meta($post_id, self::META_KEY, sanitize_textarea_field($_POST[self::META_KEY]));
        }
    }
}

InformationsMetaBox::register();

?>
