=== ts2024 ===
Requires at least: 6.4
Tested up to: 6.5.4
Requires PHP: 7.0
=== ts2024 ===


<!-- ----------------------------------------------------------------------- -->

ATTENTION NE SUROUT PAS TOUCHER À SES FICHIERS SANS AVOIR UNE BONNE CONNAISSANCE DE WORDPRESS ET PHP (et encore moins aux autres dossiers de wordpress cf: wp-admin , wp-includes )


Lors du déploiement modifier cette ligne dans toutes les fichiers php l'utilisant : (afin d'assurer le bon chargement des images statiques contenues dans la médiatéque)
$urlSite = 'http://localhost/wordpress/';

par : 

$urlSite = 'https://www.team-square.fr/';


La bonne manière de charger une vignette au format 310x310 (ratio 1:1 pour la vignette des articles, crop = true) :

<?php the_post_thumbnail('post-thumbnail', ['class' => 'post-thumbnail', 'alt' => '', 'style' => '']); ?>

(post-thumbnail est déclaré par défaut donc ce n'est pas génant si il est oublié)

J'utilise le même système pour les menus des taxonomies : 

add_image_size('tax-thumbnail', 164, 164, true);


NB concernant la génération de nouveaux formats d'image en utilisant add_image_size() : Cette fonction n'est pas rétroactive, mais 
l'utilisation du plug-in "Regenerate thumbnails" peut permettre de régénérer les thumbnails aifn d'avoir les nouveaux formats créés


<!-- ----------------------------------------------------------------------- -->

NB écrire cette séction du readme avec Ethan, cette section contiendrait des consignes préscises pour créer de nouveaux articles grâce
aux templates, pour quelqu'un qui n'est pas familier avec le développement 

<!-- ----------------------------------------------------------------------- -->

ATTENTION METADONNÉES DES ARTICLES : à cause du plugin de gestion des droits des utilisateurs il semblerait que je n'étais pas capable d'ajouter des META dans la table "postmeta", il semblerait que celui en charge de l'écriture des articles doivent avoir tout les drois (plugin de gestion des drois désactivés), il faudrait tester et mettre à jour cette section du readme avec mon nouveau code ainsi que le plugin activé 
L'utilisateur doit avoir le droit d'éditer l'article pour éditer les métadonnées de l'article
vérifier avec current_user_can('edit_post', $post -> ID)
<!-- cf documentation pour les autres arguments de la fonction -->


<!-- ----------------------------------------------------------------------- -->

Code pour appeler le label "disponible à domicile" (actuellement cette fonction n'est disponible que sur les articles activités cocher ou décocher cette case n'aura aucun effet dans les autres articles) : 



                    <?php if (get_post_meta(get_the_ID(), DomicileMetaBox::META_KEY, true) === '1') : ?>
            <label for="">Disponible À Domicile</label>
        <?php endif ?>

        <?php if (get_post_meta(get_the_ID(), BoissonMetaBox::META_KEY, true) === '1') : ?>
            <label for="">Boisson offertes</label>
        <?php endif ?>

        <?php
        $prix = get_post_meta(get_the_ID(), PrixMetaBox::META_KEY, true);
        if ($prix) : ?>
            <label for="">Prix: <?= esc_html($prix) ?> €</label>
        <?php endif ?>

        <?php
        $prixReduction = get_post_meta(get_the_ID(), PrixReductionMetaBox::META_KEY, true);
        if ($prixReduction) : ?>
            <label for="">Prix Réduction: <?= esc_html($prixReduction) ?> €</label>
        <?php endif ?>

          <?php
        if ($prix && $prixReduction) :
            $reduction = $prix - $prixReduction;
            $pourcentageReduction = ($reduction / $prix) * 100;
        ?>
            <label for="">Pourcentage de Réduction: <?= esc_html(round($pourcentageReduction)) ?> %</label>
        <?php endif ?>

        
<!-- ------------------------- Récupérer les tags -------------------------- -->

   <?php

        $post_tags = get_the_tags();
        if ($post_tags) {
            echo '<ul>';
            foreach ($post_tags as $tag) {
                echo '<li>' . $tag->name . '</li>';
            }
            echo '</ul>';
        }
        ?>

        <!-- ------------------- bandeau au dessus de la navbar -------------------- -->

        pour modifier le message affiché, il faut se rendre dans l'admin wp; dans le dashboard : réglages >> entreprise





<!-- -------------------------------- icon --------------------------------- -->

Les icons doivent venir de Material Symbols and icons (https://fonts.google.com/icons) avec une graisse de 300



<!-- ----------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------- -->
<!-- ----------------------------------------------------------------------- -->

Développé avec <3 par Lucas Chedhomme au backend/frontend et Valentin Verin au frontend
Designé avec <3 par Tanguy Caruel 
























.teamBuildingWrap {
    display: flex;
    max-width: 1438px;
    padding: 112px 0px;
    justify-content: space-between;
    align-items: center;
    margin: auto;

   
    width: 100%;
    height: 900px;
    padding: 64px;

    flex-shrink: 0;
   

    .titleMedium {
        color: var(--Neutral-009, #0b0c11);
        text-align: center;
    }

}




<?php wp_nav_menu([
    'theme_location' => 'footerActivites',
    'menu_class' => 'menuFooterActivites'
]) ?>

<?php wp_nav_menu([
    'theme_location' => 'footerAutres',
    'menu_class' => 'menuFooterAutres'
]) ?>

</div>




<div class="wrapFooter">

    <a title="home" href="<?php echo get_option('home'); ?>/"><?php  echo wp_get_attachment_image(15678, 'medium', false, ['alt' => 'Illustration catégorie', 'style' => 'logoNav']); ?></a>

    <h4 class="titleFooter">Horaire</h4>

    <div class="wrapHoraire">
        <p class="labelHoraire">Lundi au Jeudi</p>
        <?php $horaire_lundi_jeudi = get_option('entreprise_lundiJeudi');if ($horaire_lundi_jeudi !== false) {echo '<p class="horaireFooter">' . esc_html($horaire_lundi_jeudi) . '</p>';} else {echo '<p>L\'option n\'est pas définie.</p>';} ?>
    </div>

    <div class="wrapHoraire">
        <p class="labelHoraire">Vendredi</p>
        <?php $entreprise_vendredi = get_option('entreprise_vendredi');if ($entreprise_vendredi !== false) {echo '<p class="horaireFooter">' . esc_html($entreprise_vendredi) . '</p>';} else {echo '<p>L\'option n\'est pas définie.</p>';} ?>
    </div>

    <div class="wrapHoraire">
        <p class="labelHoraire">Samedi</p>
        <?php $entreprise_vendredi = get_option('entreprise_samedi');if ($entreprise_samedi !== false) {echo '<p class="horaireFooter">' . esc_html($entreprise_samedi) . '</p>';} else {echo '<p>L\'option n\'est pas définie.</p>';} ?>
    </div>

    <div class="wrapHoraire">
        <p class="labelHoraire">Dimanche</p>
        <?php $entreprise_dimanche = get_option('entreprise_dimanche');if ($entreprise_dimanche !== false) {echo '<p class="horaireFooter">' . esc_html($entreprise_dimanche) . '</p>';} else {echo '<p>L\'option n\'est pas définie.</p>';} ?>
    </div>



</div>