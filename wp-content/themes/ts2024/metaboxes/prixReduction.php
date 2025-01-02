<?php
class PrixReductionMetaBox
{
    const META_KEY = 'ts24_prixReduction';
    const NONCE_KEY = 'ts24_prixReduction_nonce';

    public static function register()
    {
        add_action('add_meta_boxes', [self::class, 'add']);
        add_action('save_post', [self::class, 'save']);
    }

    public static function add()
    {
        $post_types = ['activiteTeamSquare', 'eventsTeamSquare', 'salleTeamSquare', 'proTeamSquare', 'packTeamSquare'];
        foreach ($post_types as $post_type) {
            add_meta_box(self::META_KEY, 'Prix Réduit (vrai prix)', [self::class, 'render'], $post_type, 'side');
        }
    }

    public static function render($post)
    {
        $value = get_post_meta($post->ID, self::META_KEY, true);
        wp_nonce_field(self::NONCE_KEY, self::NONCE_KEY);
        ?>
        <label for="<?php echo self::META_KEY; ?>">Prix Réduit (vrai prix) :</label>
        <input type="number" id="<?php echo self::META_KEY; ?>" name="<?php echo self::META_KEY; ?>" value="<?php echo esc_attr($value); ?>" step="0.01" min="0">
        <?php
    }

    public static function save($post_id)
    {
        if (!isset($_POST[self::NONCE_KEY]) || !wp_verify_nonce($_POST[self::NONCE_KEY], self::NONCE_KEY)) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (array_key_exists(self::META_KEY, $_POST)) {
            $selected_price = sanitize_text_field($_POST[self::META_KEY]);
            if (is_numeric($selected_price)) {
                update_post_meta($post_id, self::META_KEY, $selected_price);
            }
        }
    }
}

PrixReductionMetaBox::register();
?>
