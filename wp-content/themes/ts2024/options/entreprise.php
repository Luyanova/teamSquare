<?php 
class TsMenuPage {

    const GROUP = 'entreprise_options';

    public static function register() {
        add_action('admin_menu', [self::class, 'addMenu']); 
        add_action('admin_init', [self::class, 'registerSettings']);
    }

    public static function registerSettings() {

        register_setting(self::GROUP, 'entreprise_lundiJeudi', ['default' => 'Rentrer valeur']);
        register_setting(self::GROUP, 'entreprise_vendredi', ['default' => 'Rentrer valeur']);
        register_setting(self::GROUP, 'entreprise_samedi', ['default' => 'Rentrer valeur']);
        register_setting(self::GROUP, 'entreprise_dimanche', ['default' => 'Rentrer valeur']);
        register_setting(self::GROUP, 'bandeau_message', ['default' => 'Rentrer le message ici']);
        register_setting(self::GROUP, 'entreprise_recrute', ['default' => false]);

        add_settings_section('entreprise_option_section', 'Gestion des paramètres', function() {}, self::GROUP);

        add_settings_field(
            'entreprise_option_horaireLundiJeudi', 
            'Horaire lundi au jeudi', 
            function() { 
                ?>
                <textarea name="entreprise_lundiJeudi"><?php echo esc_attr(get_option('entreprise_lundiJeudi')); ?></textarea>
                <?php
            },
            self::GROUP,
            'entreprise_option_section' 
        );

        add_settings_field(
            'entreprise_option_horaireVendredi', 
            'Horaire vendredi', 
            function() { 
                ?>
                <textarea name="entreprise_vendredi"><?php echo esc_attr(get_option('entreprise_vendredi')); ?></textarea>
                <?php
            },
            self::GROUP,
            'entreprise_option_section' 
        );

        add_settings_field(
            'entreprise_option_horaireSamedi', 
            'Horaire samedi', 
            function() { 
                ?>
                <textarea name="entreprise_samedi"><?php echo esc_attr(get_option('entreprise_samedi')); ?></textarea>
                <?php
            },
            self::GROUP,
            'entreprise_option_section' 
        );

        add_settings_field(
            'entreprise_option_horaireDimanche', 
            'Horaire dimanche', 
            function() { 
                ?>
                <textarea name="entreprise_dimanche"><?php echo esc_attr(get_option('entreprise_dimanche')); ?></textarea>
                <?php
            },
            self::GROUP,
            'entreprise_option_section' 
        );

        add_settings_field(
            'entreprise_option_bandeauMessage', 
            'Bandeau Message', 
            function() { 
                ?>
                <textarea name="bandeau_message"><?php echo esc_attr(get_option('bandeau_message')); ?></textarea>
                <?php
            },
            self::GROUP,
            'entreprise_option_section' 
        );

        add_settings_field(
            'entreprise_option_recrute', 
            'Team Square recrute', 
            function() { 
                ?>
                <input type="checkbox" name="entreprise_recrute" value="1" <?php checked(1, get_option('entreprise_recrute', 0)); ?> />
                <?php
            },
            self::GROUP,
            'entreprise_option_section' 
        );
    }

    public static function addMenu() {
        add_options_page("Gestion de l'entreprise", "Entreprise", "manage_options", self::GROUP, [self::class, 'render']);
    }

    public static function render() {
        ?>
        <div class="wrap">
            <h1>Sélection des paramètres</h1>
            <form action="options.php" method="post">
                <?php
                settings_fields(self::GROUP); 
                do_settings_sections(self::GROUP);
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}

TsMenuPage::register();
?>
