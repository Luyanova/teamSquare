<?php get_header() ?>


<style>


@media(max-width: 1025px) {
footer {
    padding-bottom: 128px;
}

}

</style>





<?php the_content() ?>



<?php get_template_part('parts/carousselArticle'); ?>










<div class="reviewsContainerBG">
    <div class="reviewsContainer">
        <div class="reviewsHeader">
            <p class="reviewsHeaderTitle">Vos avis sont les meilleurs</p>
            <p class="reviewsHeaderP">Découvrez l’expérience de nos clients. Retrouvez tous les avis sur
                <a href="https://www.google.com/search?sca_esv=da4bf7f7e18dacaf&sca_upv=1&hl=fr&gl=FR&sxsrf=ADLYWIIVoOLLHNtFXpadHJ330XcPA2hO9Q:1721656030386&q=Team+Square,+3+Chem.+de+Bois+Bernard,+62110+Hénin-Beaumont&uds=ADvngMhyPfUFG7LriTnVal8nQT-sanIk2KfU2a2InbVyOzMDLh8z2mNr409PdK8FMRo3kaPPu6LHcZ49c5KOGSmHKyLOniJlO0QYWYGBzWn3AXjIQZc5I4foYRtyYILdHnNs-ngruDe88sg1Bj_tAyptgjSkxggBkFz0nNCKKMiO-rZ37vJPZvtehRFcuwQ39jeaUSYE0Lbd&si=ACC90nzcy7sviKw0NTZoUBUzhQehr3jouizIrVSf6avWI23m1fKj2TsoBWwg__nqZSt7_3kJUomYPLmLH7J07jgMj5hNGySc0XO80JGdE3YN0uGVObBqhEA%3D&sa=X&ved=2ahUKEwiRjPfA5LqHAxWFUaQEHbs5CMUQ3PALegQIFRAE&cshid=1721656034358806&biw=2798&bih=1485&dpr=0.9">Google</a>.
            </p>
        </div>


        <!-- appeller les avis qui ont comme catégorie "particulier"  -->

        <div class="reviewsMain">
            <?php

            $args = array(
                'post_type' => 'avisTeamSquare',
                'category_name' => 'particulier',
                'posts_per_page' => -1
            );

            $query = new WP_Query($args);

            // La boucle
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="review">
                        <?php echo wp_get_attachment_image(15970, 'medium', false, ['alt' => 'Étoiles']); ?>
                        <div class="comment"><?php the_excerpt(); ?></div>
                        <div class="reviewUser">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('thumbnail', ['alt' => get_the_title()]); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>" alt="Default Thumbnail">
                            <?php endif; ?>
                            <div class="reviewUserInfo">
                                <div class="reviewUserName"><?php the_title(); ?></div>
                                <div class="reviewUserProduct"><?php echo get_post_meta(get_the_ID(), 'ts24_informations', true); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p><?php _e('No avis found.', 'your-text-domain'); ?></p>
            <?php endif; ?>
        </div>

        <!-- --------------------------------------------fin avis-------------------------  -->



        <div class="popularBtm">

            <div class="popularBtmRight">
                <button class="popularPagine" id="reviewPagineBack">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M15.41 7.41L14 6L8 12L14 18L15.41 16.59L10.83 12L15.41 7.41Z" fill="#60626E" />
                    </svg>
                </button>
                <button class="popularPagine" id="reviewPagineNext">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M8.59 16.59L10 18L16 12L10 6L8.59 7.41L13.17 12L8.59 16.59Z" fill="#60626E" />
                    </svg>
                </button>
            </div>
        </div>  

    </div>


</div>




<?php get_template_part('parts/teamBuildingSection'); ?>



<?php get_template_part('parts/ctaSectionOrange'); ?>












<?php get_footer() ?>