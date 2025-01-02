<div class="avisContainer">

    <div class="avisTop">
        <h2>Témoignages clients</h2>
        <div class="avisTop">
            <p>Découvrez l’expérience de nos clients.</p>
            <p>Retrouvez tous les avis sur <a href="https://www.google.com/search?client=opera-gx&hs=UsT&sca_esv=fbe9ccf2a9e6ed60&sca_upv=1&sxsrf=ADLYWIIaWUrwQwQV2r9APXrBZaW0roiByQ:1719475143455&q=team+square&uds=ADvngMio_X9PYu6QBHgDWm5hmfgFyyvPyLDsuPn-cgKLz4Iw2cRvBZbnOCxFa5-tHJW6Q4dQydll5w-k9H3K5CM_pYwv3dPGe1NrGu_b0toR2Nfgj17RkYk&si=ACC90nzcy7sviKw0NTZoUBUzhQehr3jouizIrVSf6avWI23m1fKj2TsoBWwg__nqZSt7_3kJUomYPLmLH7J07jgMj5hNGySc0XO80JGdE3YN0uGVObBqhEA%3D&sa=X&ved=2ahUKEwjsnoCJqPuGAxW2-AIHHUsRDgMQ3PALegQIExAE&biw=1661&bih=847&dpr=1.13" class="linkAvis">Google.</a></p>
        </div>
    </div>
    <?php
    $parent_category = get_category_by_slug('avis');
    $parent_category_id = $parent_category ? $parent_category->term_id : 0;

    if ($parent_category_id) {
        
        $child_category = get_term_by('slug', 'avis-loisirs', 'category');
        $child_category_id = $child_category && $child_category->parent == $parent_category_id ? $child_category->term_id : 0;
    } else {
        $child_category_id = 0;
    }

    if ($child_category_id) {
        $args = array(
            'post_type' => 'avisTeamSquare',
            'posts_per_page' => -1,
            'category__in' => array($child_category_id),
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
                <div class="avisFlex">
                    <?php echo wp_get_attachment_image(15970, 'medium', false, ['alt' => 'Étoiles']); ?>
                    <p class="pavis"><?php the_excerpt(); ?></p>

                    <div class="avisProfil">
                        <?php echo get_the_post_thumbnail(get_the_ID(), 'post-thumbnail', ['class' => 'avisImg', 'alt' => 'Photo de profil']); ?>

                        <div class="avisProfilright">
                            <p class="pavis"><?php the_title(); ?></p>
                            <p class="pavis"><?php the_tags('', ', ', ''); ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>Aucun article trouvé dans la catégorie "avis-events".</p>
        <?php endif;
    } else {
        ?>
        <p>La catégorie "avis-events" n'existe pas ou n'a pas pour parent la catégorie "avis".</p>
    <?php
    }
    ?>

</div>
