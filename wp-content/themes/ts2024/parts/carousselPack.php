
<div class="popularSection">
    <div class="popularHead">
        <div class="popularHeadLeft">
            <p class="subHeading">Nos Offres Packagées</p>
            <p class="titleMedium">Célébrations en Groupe avec Avantages</p>
            <p class="heroP">Organisez une célébration inoubliable en groupe : des tournées offertes pour les adultes et, pour les anniversaires enfants, profitez de gâteaux, médailles et bonbons pour une fête pleine de surprises !
            </p>
        </div>
        <div class="popularHeadRight">
        <?php
                    $pack_category_id = 195;
                    $pack_category_link = get_category_link($pack_category_id);
                    ?>

                    <a href="<?php echo esc_url($pack_category_link); ?>" class="moreLink">Voir tout</a>
        </div>

    </div>
    <!---------------------------------------------- caroussel populaire ----------------------------------------->


    <div class="popularMainWrapper">
        <div class="popularMain" id="popularMain2">


            <?php

            $args = array(
                'post_type' => 'packTeamSquare',

            );


            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post(); ?>

                    <a href="<?php the_permalink(); ?>" class="popularCard">

                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('post-thumbnail', ['class' => 'popularCardImg']); ?>
                        <?php endif; ?>

                        <div class="popularCardBtm">
                            <p class="cardTitle"><?php the_title(); ?></p>

                            <p class="cardTag">
                                <?php
                                $post_tags = get_the_tags();
                                if ($post_tags) {
                                    foreach ($post_tags as $tag) {
                                        echo $tag->name . ' ';
                                    }
                                }
                                ?>
                            </p>
                            <p class="cardSpec">
                                <?php
                                $informations = get_post_meta(get_the_ID(), 'ts24_informations', true);
                                if ($informations) {
                                    echo esc_html($informations);
                                }
                                ?>
                            </p>

                            <div class="cardPromo">
                                <?php
                                $priceReduction = get_post_meta(get_the_ID(), 'ts24_prixReduction', true);
                                $price = get_post_meta(get_the_ID(), 'ts24_prix', true);

                                if ($price && $priceReduction) :
                                    // Calcul du pourcentage de réduction
                                    $reduction = $price - $priceReduction;
                                    $pourcentageReduction = ($reduction / $price) * 100;
                                ?>
                                    <p class="cardPrice">
                                        <span class="cardPriceBold"><?php echo esc_html($priceReduction); ?>€</span> /pers.
                                    </p>

                                    <p class="lineTrought">
                                        <?php echo esc_html($price); ?>€
                                    </p>
                                    <p class="cardPercent">-<?php echo esc_html(round($pourcentageReduction)); ?>%</p>
                                <?php endif; ?>


                                <?php
                                $domicile = get_post_meta(get_the_ID(), 'ts24_domicile', true);
                                if ($domicile == 1) :
                                ?>
                                    <div class="cardMyTable">
                                        <p>Disponible à domicile</p>
                                    </div>
                                <?php endif; ?>

                                <?php
                                $boisson = get_post_meta(get_the_ID(), 'ts24_boisson', true);
                                if ($boisson == 1) :
                                ?>
                                    <div class="cardMyTable">
                                        <p>Boissons offertes</p>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </a>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p><?php _e('No popular articles found.', 'your-text-domain'); ?></p>
            <?php endif; ?>




        </div>




    </div>


    <div class="popularBtm">

        <div class="popularBtmRight">
            <button class="popularPagine" id="popularPagineBack2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15.41 7.41L14 6L8 12L14 18L15.41 16.59L10.83 12L15.41 7.41Z" fill="#60626E" />
                </svg>
            </button>
            <button class="popularPagine" id="popularPagineNext2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M8.59 16.59L10 18L16 12L10 6L8.59 7.41L13.17 12L8.59 16.59Z" fill="#60626E" />
                </svg>
            </button>
        </div>
    </div>
</div>


</div>





<!---------------------------------------------- end caroussel ----------------------------------------->

