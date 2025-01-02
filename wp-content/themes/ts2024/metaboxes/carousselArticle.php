<?php
class CarousselArticleMetaBox
{
    const META_KEY = 'ts24_caroussel_article';
    const NONCE_KEY = 'ts24_caroussel_article_nonce';

    // Enregistrement des actions
    public static function register()
    {
        add_action('add_meta_boxes', [self::class, 'add']);
        add_action('save_post', [self::class, 'save']);
    }

    // Ajout de la metabox aux types de post spécifiés
    public static function add()
    {
        $post_types = ['activiteTeamSquare', 'eventsTeamSquare', 'proTeamSquare', 'packTeamSquare'];
        foreach ($post_types as $post_type) {
            add_meta_box(self::META_KEY, 'Caroussel Article', [self::class, 'render'], $post_type, 'side');
        }
    }

    // Rendu de la metabox avec les cases à cocher
    public static function render($post)
    {
        // Récupération des valeurs enregistrées
        $values = get_post_meta($post->ID, self::META_KEY, true);
        $values = is_array($values) ? $values : []; // Assurer que $values est un tableau

        // Génération du nonce pour la sécurité
        wp_nonce_field(self::NONCE_KEY, self::NONCE_KEY);

        // Définitions des valeurs et labels
        $options = [
            17637 => 'Réalité virtuelle',
            17045 => 'Académie de foot',
            17044 => 'Éléctrostimulation',
            17043 => 'Cube Challenge',
            17033 => 'Karaoké',
            17032 => 'I-Quizz',
            17009 => 'Hado',
            17008 => 'Simulateur Mirage 2000',
            17007 => 'Simulateur Airbus A320',
            17005 => 'Chasse au trésor',
            17003 => 'Olympiades',
            17001 => 'Jungle Adventure',
            17000 => 'Futsal',
            16998 => 'Bumball',
            16996 => 'Babyfoot Humain',
            16990 => 'Bazookaball',
            16988 => 'Archery Tag',
            16455 => 'Paintball',
            16994 => 'Bubblefoot',
            16992 => 'Gelball',
            16986 => 'Kidsball',
            16984 => 'Laser Tag',
            16103 => 'Lancer de hache',
            00001 => '_______________________',
            17557 => 'Ouranos',
            17550 => 'Dionysos',
            17067 => 'Événements familiaux',
            17066 => 'Baptême',
            17065 => 'Communion',
            17064=> 'Mariage',
            17063 => 'Apollon',
            17062 => 'Aphrodite',
            17061 => 'Athéna',
            16648 => 'Zeus',
            16386 => 'Anniversaire',
            0002 => '_______________________',
            17620 => 'Gestion des conflits',
            17075 => 'Associations & Clubs',
            17074 => 'Étudiants / BDE',
            17073 => 'Billetterie CSE',
            17072 => 'Comité d’Entreprise',
            17071 => 'Optimisation des performances',
            17070 => 'Gestion du stress',
            17069 => 'Prévention santé en entreprise',
            17068 => 'Communication Interne',
            16420 => 'Team Building / Séminaire',
            15918 => 'Cohésion d’équipe',
            003 => '_______________________',
            17055 => 'Entre Amis / En famille',
            17054 => 'Anniversaire Enfants',
            17053 => 'Anniversaire Adultes',
            17051 => 'EVJF',
            15934 => 'EVG',
            
        ];

        // Affichage des cases à cocher
        foreach ($options as $value => $label) {
            $checked = in_array($value, $values) ? 'checked' : '';
            echo '<label>';
            echo '<input type="checkbox" name="' . esc_attr(self::META_KEY) . '[]" value="' . esc_attr($value) . '" ' . $checked . '>';
            echo esc_html($label) . ' (' . esc_html($value) . ')';
            echo '</label><br>';
        }
    }

    // Sauvegarde des données de la metabox
    public static function save($post_id)
    {
        // Vérification du nonce
        if (!isset($_POST[self::NONCE_KEY]) || !wp_verify_nonce($_POST[self::NONCE_KEY], self::NONCE_KEY)) {
            return;
        }

        // Vérification des permissions
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Sauvegarde ou suppression des métadonnées
        if (isset($_POST[self::META_KEY])) {
            $selected_values = array_map('sanitize_text_field', $_POST[self::META_KEY]);
            $selected_values = array_filter($selected_values, 'is_numeric'); // Assurer que toutes les valeurs sont numériques
            update_post_meta($post_id, self::META_KEY, $selected_values);
        } else {
            delete_post_meta($post_id, self::META_KEY);
        }
    }
}

CarousselArticleMetaBox::register();
?>
