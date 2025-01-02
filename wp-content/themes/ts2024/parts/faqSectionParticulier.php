
<div class="faqs">
    <p class="titleMedium">
        FAQs
    </p>
    <div class="questionsContainer">
        <hr>
        <?php
        // Arguments pour la requête WP_Query
        $args = array(
            'post_type' => 'faqTeamSquare',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category', // Taxonomie de la catégorie
                    'field'    => 'slug',     // On utilise le slug pour identifier la catégorie
                    'terms'    => 'particulier', // Le slug de la catégorie que vous voulez inclure
                ),
            ),
            'posts_per_page' => -1 // Récupérer tous les articles
        );

        // La requête WP_Query
        $query = new WP_Query($args);

        // La boucle
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
                <div class="faq">
                    <div class="question">
                        <p class="questionText"><?php the_title(); ?></p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                            <path d="M24 13.3331L22.12 11.4531L16 17.5598L9.88 11.4531L8 13.3331L16 21.3331L24 13.3331Z" fill="#0B0C11" />
                        </svg>
                    </div>
                    <div class="answer">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p><?php _e('No FAQs found.', 'your-text-domain'); ?></p>
        <?php endif; ?>
    </div>

</div>