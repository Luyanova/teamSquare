<?php
get_header();
?>








<div class="head">

<div class="pageTitle">
    <p><?php single_cat_title(); ?></p>
</div>

</div>


<div class="activitiesContainer">

<?php echo do_shortcode('[filtre_activite_navigation]'); ?>

<div class="activities">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="activityCard">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('post-thumbnail', ['class' => 'activityCardImg']); ?>
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/img/cardImg1.png" alt="" class="activityCardImg">
                    <?php endif; ?>

                    <div class="activityCardBtm">
                        <p class="activityCardTitle"><?php the_title(); ?></p>
                        <p class="activityCardTag">
                            <?php
                            $post_tags = get_the_tags();
                            if ($post_tags) {
                                foreach ($post_tags as $tag) {
                                    echo $tag->name . ' ';
                                }
                            }
                            ?>
                        </p>
                        <p class="activityCardSpec">
                            <?php
                            $informations = get_post_meta(get_the_ID(), 'ts24_informations', true);
                            if ($informations) {
                                echo esc_html($informations);
                            }
                            ?>
                        </p>

                        <div class="activityCardPricing">
    <?php
    $price = get_post_meta(get_the_ID(), 'ts24_prix', true);
    $priceReduction = get_post_meta(get_the_ID(), 'ts24_prixReduction', true);

    if ($price && !$priceReduction) :
    ?>
        <p class="activityCardPrice">
            <span class="activityCardPriceBold"><?php echo esc_html($price); ?>€</span> /pers.
        </p>
    <?php
    elseif ($price && $priceReduction) :
        
        $reduction = $price - $priceReduction;
        $pourcentageReduction = ($reduction / $price) * 100;
    ?>
        <p class="cardPrice">
            <span class="cardPriceBold"><?php echo esc_html($priceReduction); ?>€</span> /pers.
        </p>

        <p class="lineThrough">
            <?php echo esc_html($price); ?>€
        </p>
        <p class="cardPercent">-<?php echo esc_html(round($pourcentageReduction)); ?>%</p>
    <?php endif; ?>
</div>

                    </div>

                    <?php
                    $domicile = get_post_meta(get_the_ID(), 'ts24_domicile', true);
                    if ($domicile == 1) :
                    ?>
                        <div class="activityCardMyTable">
                            <p>Disponible à domicile</p>
                        </div>
                    <?php endif; ?>

                    <?php
                    $boisson = get_post_meta(get_the_ID(), 'ts24_boisson', true);
                    if ($boisson == 1) :
                    ?>
                        <div class="activityCardMyTable">
                            <p>Boissons offertes</p>
                        </div>
                    <?php endif; ?>

                </a>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p><?php _e('No activities found.', 'your-text-domain'); ?></p>
        <?php endif; ?>
    </div>

</div>






<?php get_template_part('parts/menuTaxActivites'); ?>


<?php get_template_part('parts/carousselPack'); ?>




<?php get_template_part('parts/teamBuildingSection'); ?>

<style> .CTA-Section-O { margin-top: 64px!important; }</style>

<?php get_template_part('parts/ctaSectionOrange'); ?>




<?php get_footer() ?>