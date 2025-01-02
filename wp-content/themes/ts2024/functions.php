<?php

function ts24_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');

    register_nav_menu('activtesNav', 'Menu des activités dans la barre de navigation');
    register_nav_menu('groupesNav', 'Menu des groupes dans la barre de navigation');
    register_nav_menu('eventsNav', 'Menu events dans la barre de navigation');
    register_nav_menu('moreNav', 'Menu en savoir plus dans la barre de navigation');


    add_image_size('post-thumbnail', 1080, 1080, true);
    add_image_size('tax-thumbnail', 164, 164, true);
}

add_action('after_setup_theme', 'ts24_supports');

function disable_comments()
{
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
}

add_action('admin_init', 'disable_comments');


function ts24_register_assets()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0.0');
    wp_enqueue_style('normalize');

    wp_register_style('style', get_template_directory_uri() . '/style.css', array(), '1.0.0');
    wp_enqueue_style('style');

    if (is_front_page()) {
        wp_register_style('styleHome', get_template_directory_uri() . '/assets/css/styleHome.css', array(), '1.0.0');
        wp_enqueue_style('styleHome');
    }

    if (is_page('events')) {
        wp_register_style('styleEvent', get_template_directory_uri() . '/assets/css/styleEvent.css', array(), '1.0.0');
        wp_enqueue_style('styleEvent');
    }

    if (is_page('Pro')) {
        wp_register_style('stylePro', get_template_directory_uri() . '/assets/css/stylePro.css', array(), '1.0.0');
        wp_enqueue_style('stylePro');
    }

    if (is_page('a-propos')) {
        wp_register_style('styleA-Propos', get_template_directory_uri() . '/assets/css/styleA-Propos.css', array(), '1.0.0');
        wp_enqueue_style('styleA-Propos');
    }

    if (is_page('blog')) {
        wp_register_style('styleBlog', get_template_directory_uri() . '/assets/css/styleBlog.css', array(), '1.0.0');
        wp_enqueue_style('styleBlog');
    }

    if (is_singular('activiteTeamSquare')) {
        wp_register_style('single-activiteTeamSquare', get_template_directory_uri() . '/assets/css/single-activiteTeamSquare.css', array(), '1.0.0');
        wp_enqueue_style('single-activiteTeamSquare');
    }

    if (is_singular('post')) {
        wp_register_style('styleSingle', get_template_directory_uri() . '/assets/css/styleSingle.css', array(), '1.0.0');
        wp_enqueue_style('styleSingle');
    }



    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.7.1.slim.min.js', array(), null, true);
    wp_enqueue_script('jquery');

    wp_register_script('script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), null, true);
    wp_enqueue_script('script');
}

add_action('wp_enqueue_scripts', 'ts24_register_assets', 10);

function ts24_menu_class($classes)
{
    $classes[] = 'nav-items';
    return $classes;
}

function ts24_menu_link_class($attrs)
{
    $attrs['class'] = 'subMenuCatTitle';
    return $attrs;
}


add_filter('nav_menu_css_class', 'ts24_menu_class');

add_filter('nav_menu_link_attributes', 'ts24_menu_link_class');

function custom_excerpt_length($length)
{
    return 20;
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);

function custom_excerpt_more($more)
{
    return '...';
}

add_filter('pre_get_posts', 'limit_change_posts_archive');
function limit_change_posts_archive($query){
  
    if (!is_admin() && $query->is_main_query() && $query->is_archive) {
        $query->set('posts_per_page', 40);
    }
    return $query;
}


add_filter('excerpt_more', 'custom_excerpt_more');

function ts24_init()
{


    register_post_type('activiteTeamSquare', [
        'labels' => [
            'name' => 'Activités',
            'singular_name' => 'Activité',
            'search_items' => 'Rechercher des activités',
            'all_items' => 'Toutes les activités',
            'edit_item' => 'Éditer activité',
            'update_item' => 'Mettre à jour activité',
            'add_new_item' => 'Ajouter une nouvelle activité',
            'new_item_name' => 'Nom de la nouvelle activité',
            'menu_name' => 'Activités',
        ],
        'public' => true,
        'menu_position' => 3,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon' => 'dashicons-smiley',
        'taxonomies' => ['post_tag', 'category', 'filtreActiviteTeamSquare'],
        'has_archive' => false,
        'rewrite' => array('slug' => 'activiteTeamSquare', 'with_front' => false),
    ]);

    register_post_type('eventsTeamSquare', [
        'labels' => [
            'name' => 'Events',
            'singular_name' => 'Events',
            'search_items' => 'Rechercher des Events',
            'all_items' => 'Tous les Events',
            'edit_item' => 'Éditer Events',
            'update_item' => 'Mettre à jour Events',
            'add_new_item' => 'Ajouter une nouvelle Events',
            'new_item_name' => 'Nom de la nouvelle Events',
            'menu_name' => 'Events',
        ],
        'public' => true,
        'menu_position' => 3,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon' => 'dashicons-buddicons-tracking',
        'taxonomies' => ['post_tag', 'category'],
        'has_archive' => false,
        'rewrite' => array('slug' => 'eventsTeamSquare', 'with_front' => false),
    ]);
    
      register_post_type('apexTeamsquare', [
        'labels' => [
            'name' => 'Apex',
            'singular_name' => 'Article apex',
            'search_items' => 'Rechercher des apex',
            'all_items' => 'Toutes les apex',
            'edit_item' => 'Éditer apex',
            'update_item' => 'Mettre à jour apex',
            'add_new_item' => 'Ajouter une nouvelle apex',
            'new_item_name' => 'Nom de la nouvelle apex',
            'menu_name' => 'Apex',
        ],
        'public' => true,
        'menu_position' => 2,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor'],
        'menu_icon' => 'dashicons-id-alt',
        'taxonomies' => [],
        'has_archive' => false,
        'rewrite' => array('slug' => 'apexTeamsquare', 'with_front' => false),
    ]);

    

    register_post_type('proTeamSquare', [
        'labels' => [
            'name' => 'Professionnel',
            'singular_name' => 'Article professionnel',
            'search_items' => 'Rechercher des professionnels',
            'all_items' => 'Tout les professionnels',
            'edit_item' => 'Éditer professionnel',
            'update_item' => 'Mettre à jour professionnel',
            'add_new_item' => 'Ajouter un nouveau professionnel',
            'new_item_name' => 'Nom du nouveau professionnel',
            'menu_name' => 'Professionnel',
        ],
        'public' => true,
        'menu_position' => 3,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon' => 'dashicons-businesswoman',
        'taxonomies' => ['post_tag', 'category'],
        'has_archive' => false,
        'rewrite' => array('slug' => 'proTeamSquare', 'with_front' => false),
    ]);

    register_post_type('packTeamSquare', [
        'labels' => [
            'name' => 'Pack',
            'singular_name' => 'Pack',
            'search_items' => 'Rechercher des Packs',
            'all_items' => 'Tout les Packs',
            'edit_item' => 'Éditer Pack',
            'update_item' => 'Mettre à jour Pack',
            'add_new_item' => 'Ajouter un nouveau Pack',
            'new_item_name' => 'Nom du nouveau Pack',
            'menu_name' => 'Pack',
        ],
        'public' => true,
        'menu_position' => 3,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon' => 'dashicons-buddicons-groups',
        'taxonomies' => ['category', 'post_tag'],
        'has_archive' => false,
        'rewrite' => array('slug' => 'packTeamSquare', 'with_front' => false),
    ]);

    register_post_type('avisTeamSquare', [
        'labels' => [
            'name' => 'Avis',
            'singular_name' => 'Avis',
            'search_items' => 'Rechercher des Avis',
            'all_items' => 'Tout les Avis',
            'edit_item' => 'Éditer Avis',
            'update_item' => 'Mettre à jour Avis',
            'add_new_item' => 'Ajouter un nouvel Avis',
            'new_item_name' => 'Nom du nouvel Avis',
            'menu_name' => 'Avis',
        ],
        'public' => true,
        'menu_position' => 3,
        'show_in_menu' => true,
        'supports' => ['title', 'thumbnail', 'excerpt'],
        'menu_icon' => 'dashicons-awards',
        'taxonomies' => ['category'],
        'has_archive' => false,
        'publicly_queryable' => false,
    ]);

    register_post_type('faqTeamSquare', [
        'labels' => [
            'name' => 'Faq',
            'singular_name' => 'Faq',
            'search_items' => 'Rechercher des faq',
            'all_items' => 'Tout les faq',
            'edit_item' => 'Éditer faq',
            'update_item' => 'Mettre à jour faq',
            'add_new_item' => 'Ajouter un nouvel faq',
            'new_item_name' => 'Nom du nouvel faq',
            'menu_name' => 'Faq',
        ],
        'public' => true,
        'menu_position' => 3,
        'show_in_menu' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon' => 'dashicons-info-outline',
        'taxonomies' => ['category'],
        'has_archive' => false,
        'publicly_queryable' => false,
        'show_in_rest' => true,
    ]);

    register_post_type('employesTeamSquare', [
        'labels' => [
            'name' => 'Employés',
            'singular_name' => 'Employé',
            'search_items' => 'Rechercher des Employés',
            'all_items' => 'Tout les Employés',
            'edit_item' => 'Éditer Employés',
            'update_item' => 'Mettre à jour Employés',
            'add_new_item' => 'Ajouter un nouvel Employé',
            'new_item_name' => 'Nom du nouvel Employé',
            'menu_name' => 'Employés',
        ],
        'public' => true,
        'menu_position' => 3,
        'show_in_menu' => true,
        'supports' => ['title', 'thumbnail', 'excerpt'],
        'menu_icon' => 'dashicons-businessperson',
        'taxonomies' => [],
        'has_archive' => false,
        'publicly_queryable' => false,
    ]);

    
}


////////////////////////

function register_filtre_activite_taxonomy() {
    $labels = [
        'name' => 'Filtres activité',
        'singular_name' => 'Filtre activité',
        'search_items' => 'Rechercher des filtres',
        'all_items' => 'Tous les filtres',
        'parent_item' => 'Filtre parent',
        'parent_item_colon' => 'Filtre parent:',
        'edit_item' => 'Éditer filtre',
        'update_item' => 'Mettre à jour filtre',
        'add_new_item' => 'Ajouter un nouveau filtre',
        'new_item_name' => 'Nom du nouveau filtre',
        'menu_name' => 'Filtres activité',
    ];

    $args = [
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'filtre-activite'],
    ];

    register_taxonomy('filtreActiviteTeamSquare', ['activiteTeamSquare'], $args);
}

add_action('init', 'register_filtre_activite_taxonomy');


function filtre_activite_teamsquare_navigation() {
    // Récupérer les termes de la taxonomie
    $terms = get_terms([
        'taxonomy' => 'filtreActiviteTeamSquare',
        'hide_empty' => false,
    ]);

    // Initialiser la sortie HTML
    $output = '<div class="catFilterBtns">';
    
    // Récupérer le terme courant si nous sommes sur une archive de terme
    $current_term = '';
    if (is_tax('filtreActiviteTeamSquare')) {
        $current_term = get_queried_object();
    }

    // Ajouter le bouton "Voir tout"


                    $particulier_category_id = 176;
                    $particulier_category_link = get_category_link($particulier_category_id);
  
    
    $output .= '<div class="catFilterBtn' . (empty($current_term) ? ' active' : '') . '"><a href="' . esc_url($particulier_category_link) . '">Voir tout</a></div>';
    
    // Ajouter les boutons pour chaque terme
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $is_active = ($current_term && $current_term->term_id === $term->term_id) ? ' active' : '';
            $output .= '<div class="catFilterBtn' . $is_active . '"><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></div>';
        }
    } else {
        // Si aucun terme n'est trouvé
        $output .= '<div class="catFilterBtn">Aucun filtre trouvé</div>';
    }
    
    // Fermer le conteneur
    $output .= '</div>';

    return $output;
}

add_shortcode('filtre_activite_navigation', 'filtre_activite_teamsquare_navigation');



//////////////////////


function disable_category_archives() {
    if (is_category(array('blog', 'general', 'non-classe'))) { 
        wp_redirect(home_url()); 
        exit;
    }
}
add_action('template_redirect', 'disable_category_archives');



function namespace_add_custom_types( $query ) {
    if( (is_category() || is_tag()) && $query->is_archive() && empty( $query->query_vars['suppress_filters'] ) ) {
        $query->set( 'post_type', array(
            'post', 'activiteTeamSquare', 'eventsTeamSquare', 'proTeamSquare', 'packTeamSquare'
        ));
    }
}
add_action( 'pre_get_posts', 'namespace_add_custom_types' );


add_action('init', 'ts24_init');



/* --------------------------------- options -------------------------------- */

require_once('options/entreprise.php');
TsMenuPage::register();

/* --------------------------------- metaboxes ------------------------------ */

require_once('metaboxes/domicile.php');
DomicileMetaBox::register();

require_once('metaboxes/boisson.php');
BoissonMetaBox::register();

require_once('metaboxes/populaire.php');
PopulaireMetaBox::register();

require_once('metaboxes/prix.php');
PrixMetaBox::register();

require_once('metaboxes/prixReduction.php');
PrixReductionMetaBox::register(); 

require_once('metaboxes/informations.php');
InformationsMetaBox::register();

require_once('metaboxes/informations2.php');
Informations2MetaBox::register();

require_once('metaboxes/nav_groupe.php');
NavGroupeMetaBox::register();

require_once('metaboxes/nav_events.php');
NavEventsMetaBox::register();

require_once('metaboxes/carousselArticle.php');
CarousselArticleMetaBox::register();



/* -------------------------------------------------------------------------- */

