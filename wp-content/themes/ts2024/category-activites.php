<?php get_header(); ?>

<div class="head">
    <div class="pageTitle">
        <p>Toutes les activités</p>
    </div>
</div>

<?php get_template_part('parts/menuTaxActivites'); ?>

<div class="activitiesContainer">
    <?php echo do_shortcode('[filtre_activite_navigation]'); ?>

<div class="activities">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="activityCard">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('post-thumbnail', ['class' => 'activityCardImg']); ?>
                <?php else : ?>
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/cardImg1.png" alt="" class="activityCardImg">
                <?php endif; ?>

                <div class="activityCardBtm">
                    <p class="activityCardTitle"><?php the_title(); ?></p>
                    <p class="activityCardTag">
                        <?php
                        $post_categories = get_the_category();
                        if (!empty($post_categories)) {
                            foreach ($post_categories as $category) {
                                echo esc_html($category->name) . ' ';
                            }
                        } else {
                            echo 'Non catégorisé';
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

                </div>
                

                <?php
                $domicile = get_post_meta(get_the_ID(), 'ts24_domicile', true);
                if ($domicile == 1) :
                ?>
                    <div class="activityCardMyTable">
                        <p>Disponible à domicile</p>
                    </div>
                <?php endif; ?>

  
            </a>
        <?php endwhile; ?>
    <?php else : ?>
        <p><?php _e('No activities found.', 'your-text-domain'); ?></p>
    <?php endif; ?>
</div>


</div>

<?php get_template_part('parts/carousselPack'); ?>
<?php get_template_part('parts/teamBuildingSection'); ?>
<style>.CTA-Section-O { margin-top: 64px!important; }</style>
<?php get_template_part('parts/ctaSectionOrange'); ?>
<?php get_footer(); ?>
