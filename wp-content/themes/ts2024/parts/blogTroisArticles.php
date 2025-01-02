<!----------------------- 3 articles du blog -------------->

<div class="news">
    <div class="newsHeading">
        <div class="newsHeadingMain">
            <p class="subHeading">Blog</p>
            <p class="titleMedium">Nos Dernières Actualités</p>
        </div>
        <p class="heroP">Plongez dans notre blog et découvrez des articles inspirants, des nouveautés et des conseils pour
profiter pleinement de vos expériences à Team Square.</p>
    </div>
    <div class="newsCardContainer">
        <?php
        // Arguments pour la requête WP_Query
        $args = array(
            'post_type' => 'post',        // Assurez-vous de cibler les articles de base
            'category_name' => 'blog-particulier',    // Nom de la catégorie à cibler
            'posts_per_page' => 3         // Nombre de posts à récupérer
        );

        // La requête WP_Query
        $query = new WP_Query($args);

        // La boucle
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>

                <a href="<?php the_permalink(); ?>" class="newsCard">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('full', ['class' => 'newsCardImg']); ?>
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/img/default-image.png" alt="Default Image" class="newsCardImg">
                    <?php endif; ?>
                    <div class="newsCardText">
                        <div class="newsCardMainText">
                            <div class="newsCardTitle"><?php the_title(); ?></div>
                            <div class="newsCardP"><?php the_excerpt(); ?></div>
                        </div>
                        <p class="newsCardSubText">
                            <?php
                            $informations = get_post_meta(get_the_ID(), 'ts24_informations', true);
                            if ($informations) {
                                echo esc_html($informations);
                            }
                            ?>
                        </p>
                    </div>
                </a>

        <?php endwhile;
            // Réinitialisation des données de post
            wp_reset_postdata();
        else : ?>
            <p><?php _e('No articles found.', 'your-text-domain'); ?></p>
        <?php endif; ?>
    </div>
    <a href="<?php echo esc_url(get_permalink(17253)); ?>" class="CTA-WhiteGradient">
        <div class="CTA-white">Voir tout</div>
    </a>
</div>

<!------------------------- fin blog -------------->

