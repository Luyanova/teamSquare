<!-- Ici, on charge la page "accueil" donc on peut ajouter en static la hero section par exemple mais appeller du texte écrit avec Gutenberg de Wp sur la page accueil par exemple -->




<?php get_header() ?>


<div>
    <div class="hero">
        <div class="heroMain">
            <div>
            </div>
            <div class="heroTxtCTA">
                <div class="heroTxt">
                    <p class="subHeading">
                        Vibrez, Célébrez, Ensemble
                    </p>
                    <h1 class="heroHeadLine">
                        Des expériences uniques <span class="heroHeadLineGrey active">entre collègues</span> <span class="heroHeadLineGrey">entre amis</span> <span class="heroHeadLineGrey">en famille</span>
                    </h1>
                    <p class="heroP">
                        Team Square allie loisir, sport et innovation pour des moments mémorables.
                        Vivez des activités et des moments inoubliables à proximité de Lille,
                        à Hénin-Beaumont, dans le Nord Pas-de-Calais.
                    </p>
                </div>
                <div class="heroCTAs">
                    <?php
                    $particulier_category_id = 176;
                    $particulier_category_link = get_category_link($particulier_category_id);
                    ?>

                    <a href="<?php echo esc_url($particulier_category_link); ?>" class="CTA-orange">Voir les activités</a>
                    <?php
                    $pageEvent_id = 5964;
                    $pageEvent_url = get_permalink($pageEvent_id);
                    echo '<a class="CTA-white" href="' . esc_url($pageEvent_url) . '">Louer une salle</a>';
                    ?>
                </div>
            </div>
            <div class="heroReview">
                <div class="heroReviewPictures">
                    <?php echo wp_get_attachment_image(16100, 'full', false, ['alt' => 'Avatar utilisateur', 'class' => 'reviewPic']); ?>
                    <?php echo wp_get_attachment_image(16101, 'full', false, ['alt' => 'Avatar utilisateur', 'class' => 'reviewPic']); ?>
                    <?php echo wp_get_attachment_image(16102, 'full', false, ['alt' => 'Avatar utilisateur', 'class' => 'reviewPic']); ?>
                </div>
                <div class="rateStars">
                    <div class="rate">
                        <div class="stars">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                <path d="M8.75 0L11.1105 4.75099L16.3585 5.52786L12.5694 9.24101L13.4523 14.4721L8.75 12.016L4.04772 14.4721L4.93056 9.24101L1.14155 5.52786L6.38945 4.75099L8.75 0Z" fill="#FBBC04" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                <path d="M8.75 0L11.1105 4.75099L16.3585 5.52786L12.5694 9.24101L13.4523 14.4721L8.75 12.016L4.04772 14.4721L4.93056 9.24101L1.14155 5.52786L6.38945 4.75099L8.75 0Z" fill="#FBBC04" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                <path d="M8.75 0L11.1105 4.75099L16.3585 5.52786L12.5694 9.24101L13.4523 14.4721L8.75 12.016L4.04772 14.4721L4.93056 9.24101L1.14155 5.52786L6.38945 4.75099L8.75 0Z" fill="#FBBC04" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                <path d="M8.75 0L11.1105 4.75099L16.3585 5.52786L12.5694 9.24101L13.4523 14.4721L8.75 12.016L4.04772 14.4721L4.93056 9.24101L1.14155 5.52786L6.38945 4.75099L8.75 0Z" fill="#FBBC04" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                <path d="M8.75 0L11.2046 4.62154L16.3585 5.52786L12.7216 9.29045L13.4523 14.4721L8.75 12.176L4.04772 14.4721L4.77839 9.29045L1.14155 5.52786L6.29541 4.62154L8.75 0Z" fill="#60626E" />
                                <mask id="mask0_1383_3287" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="11" height="16">
                                    <rect x="0.75" width="9.42857" height="16" fill="#D9D9D9" />
                                </mask>
                                <g mask="url(#mask0_1383_3287)">
                                    <path d="M8.75 0L11.2046 4.62154L16.3585 5.52786L12.7216 9.29045L13.4523 14.4721L8.75 12.176L4.04772 14.4721L4.77839 9.29045L1.14155 5.52786L6.29541 4.62154L8.75 0Z" fill="#FBBC04" />
                                </g>
                            </svg>
                        </div>
                        <p class="starScore">
                            4,6
                        </p>
                    </div>
                    <p class="reviewOnGoogle">+1500 avis sur <a href="https://www.google.com/search?sca_esv=9980f8d855368397&sca_upv=1&hl=fr&gl=FR&sxsrf=ADLYWIKJ0tR7c7tL5hYWq7I7xatj4pdc4A:1721251584271&q=team+square+avis&uds=ADvngMjE7B3wrbuyIi35p38ZYr6KtaRed0QaV9c-VYQBzThICvDoG7i3UXBywfhou9habq-Wnc1ssdsaj8vftN0gZID6Q7gKtaZGR96MaGeWloTKVM5k68m5ZFp8V-Nuxz7-4NB1hiOHp2iaoZYgZ0OQl_7cVRC5JE2DkiaU-qWmnUa5dL9lLigKVUHioWelnpmSWLtz9mR6_bPDxj5h5lqZ0pOcFtB--A&si=ACC90nyY_P7isI4B2KtisjEhl7ETd9ltY_rZHT55aeNrl2g6-_lR8eLOyMkdhhp_CG8gKQF4nzxyRyi7foJvYBPMjYyEwmEjXZItsYRvD5_islFH0pbwfpWlP6bZCvCuD_Gi-VkWB--vq7VWU1pOyh6FUBUx_wBm3w%3D%3D&sa=X&ved=2ahUKEwjQl__pga-HAxWpTqQEHb39B9UQxKsJegQIDxAB&ictx=1&biw=1661&bih=847&dpr=1.13" target="_blank"><span class="heroGoogle">Google</span></a></p>
                </div>
            </div>
        </div>
        <div class="heroIllustration">
            <?php echo wp_get_attachment_image(16199, 'full', false, ['alt' => 'Illustration catégorie', 'class' => 'heroImg2 active']); ?>
            <?php echo wp_get_attachment_image(16200, 'full', false, ['alt' => 'Illustration catégorie', 'class' => 'heroImg2']); ?>
            <?php echo wp_get_attachment_image(16201, 'full', false, ['alt' => 'Illustration catégorie', 'class' => 'heroImg2']); ?>
        </div>
    </div>

    <div class="popularSection">
        <div class="popularHead">
            <div class="popularHeadLeft">
                <p class="subHeading">Découvrez Nos Expériences Uniques</p>
                <p class="titleMedium">Activités Phare Du Moment</p>
                <p class="heroP">Explorez plus de 22 activités incontournables pour des moments mémorables.</p>
            </div>
            <div class="popularHeadRight">
                <a href="<?php echo esc_url($particulier_category_link); ?>" class="moreLink">Voir tout</a>
            </div>
        </div>

        <!---------------------------------------------- caroussel populaire ----------------------------------------->


        <div class="popularMainWrapper">
            <div class="popularMain">


                <?php

                $args = array(
                    'post_type' => ['activiteTeamSquare', 'eventsTeamSquare', 'proTeamSquare', 'packTeamSquare'],
                    'meta_query' => array(
                        array(
                            'key' => 'ts24_populaire',
                            'value' => '1',
                            'compare' => '='
                        )
                    )
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
                                    $post_categories = get_the_category();
                                    if ($post_categories) {
                                        foreach ($post_categories as $category) {
                                            echo esc_html($category->name) . ' ';
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

                                    <?php else : ?>
                                        <p class="cardPrice">
                                            <span class="cardPriceBold"><?php echo esc_html($priceReduction ? $priceReduction : $price); ?>€</span> /pers.
                                        </p>
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
                <button class="popularPagine" id="popularPagineBack">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M15.41 7.41L14 6L8 12L14 18L15.41 16.59L10.83 12L15.41 7.41Z" fill="#60626E" />
                    </svg>
                </button>
                <button class="popularPagine" id="popularPagineNext">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M8.59 16.59L10 18L16 12L10 6L8.59 7.41L13.17 12L8.59 16.59Z" fill="#60626E" />
                    </svg>
                </button>
            </div>
        </div>
    </div>


</div>





<!---------------------------------------------- end caroussel ----------------------------------------->











<div class="CTA-Section">
    <svg class="svg1" xmlns="http://www.w3.org/2000/svg" width="846" height="487" viewBox="0 0 846 487" fill="none">
        <path d="M-309.065 326.653C-309.756 327.446 -309.716 328.638 -308.972 329.382L-255.653 382.701C-254.834 383.52 -253.492 383.475 -252.731 382.602L511.833 -493.885C512.524 -494.678 512.484 -495.87 511.74 -496.614L458.421 -549.933C457.602 -550.752 456.261 -550.707 455.499 -549.834L-309.065 326.653Z" fill="url(#paint0_linear_475_4800)" fill-opacity="0.03" />
        <path d="M524.978 -483.376C524.159 -484.195 522.818 -484.15 522.056 -483.277L-242.508 393.21C-243.199 394.002 -243.159 395.195 -242.415 395.939L-189.096 449.258C-188.277 450.077 -186.936 450.031 -186.174 449.159L578.39 -427.328C579.081 -428.121 579.041 -429.313 578.297 -430.057L524.978 -483.376Z" fill="url(#paint1_linear_475_4800)" fill-opacity="0.03" />
        <path d="M591.534 -416.819C590.716 -417.638 589.374 -417.593 588.613 -416.72L-175.951 459.767C-176.642 460.559 -176.602 461.752 -175.858 462.496L-122.539 515.815C-121.72 516.634 -120.379 516.588 -119.617 515.716L644.947 -360.771C645.638 -361.564 645.598 -362.756 644.854 -363.5L591.534 -416.819Z" fill="url(#paint2_linear_475_4800)" fill-opacity="0.03" />
        <path d="M658.091 -350.262C657.273 -351.081 655.931 -351.036 655.17 -350.163L-109.394 526.324C-110.085 527.116 -110.045 528.309 -109.301 529.053L-55.9817 582.372C-55.1627 583.191 -53.8216 583.145 -53.0603 582.273L711.504 -294.214C712.195 -295.007 712.154 -296.199 711.411 -296.943L658.091 -350.262Z" fill="url(#paint3_linear_475_4800)" fill-opacity="0.03" />
        <path d="M724.648 -283.706C723.829 -284.524 722.488 -284.479 721.727 -283.606L-42.837 592.881C-43.5284 593.673 -43.4878 594.866 -42.7441 595.61L10.5753 648.929C11.3942 649.748 12.7354 649.702 13.4966 648.83L778.061 -227.657C778.752 -228.45 778.711 -229.642 777.968 -230.386L724.648 -283.706Z" fill="url(#paint4_linear_475_4800)" fill-opacity="0.03" />
        <path d="M791.205 -217.149C790.386 -217.967 789.045 -217.922 788.284 -217.049L23.7199 659.438C23.0285 660.23 23.0691 661.423 23.8128 662.167L77.1322 715.486C77.9511 716.305 79.2922 716.259 80.0535 715.387L844.618 -161.1C845.309 -161.893 845.268 -163.086 844.525 -163.829L791.205 -217.149Z" fill="url(#paint5_linear_475_4800)" fill-opacity="0.03" />
        <defs>
            <linearGradient id="paint0_linear_475_4800" x1="45.2297" y1="-139.77" x2="490.323" y2="305.323" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint1_linear_475_4800" x1="45.2297" y1="-139.77" x2="490.323" y2="305.323" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint2_linear_475_4800" x1="45.2297" y1="-139.77" x2="490.323" y2="305.323" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint3_linear_475_4800" x1="45.2297" y1="-139.77" x2="490.323" y2="305.323" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint4_linear_475_4800" x1="45.2297" y1="-139.77" x2="490.323" y2="305.323" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint5_linear_475_4800" x1="45.2297" y1="-139.77" x2="490.323" y2="305.323" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
        </defs>
    </svg>
    <div class="CTA-SectionMiddle">
        <div class="CTA-SM-Head">
            <p class="subHeading">À propos de Team Square</p>
            <p class="titleMedium">Créateurs de souvenirs inoubliables, chaque moment compte.</p>
        </div>
        <p class="heroP">Notre équipe vous concocte des aventures personnalisées, teintées de passion et de fun,
            dans une atmosphère accueillante à Hénin-Beaumont.</p>

        <?php
        $pageContact_id = 136; 
        $pageContact_url = get_permalink($pageContact_id); 
        ?>
        <a class="CTA-WhiteGradient" href="<?php echo esc_url($pageContact_url); ?>">
            <div class="CTA-white">Nous Contacter</div>
        </a>

    </div>
    <svg class="svg2" xmlns="http://www.w3.org/2000/svg" width="846" height="487" viewBox="0 0 846 487" fill="none">
        <path d="M-309.065 326.653C-309.756 327.446 -309.716 328.638 -308.972 329.382L-255.653 382.701C-254.834 383.52 -253.492 383.475 -252.731 382.602L511.833 -493.885C512.524 -494.678 512.484 -495.87 511.74 -496.614L458.421 -549.933C457.602 -550.752 456.261 -550.707 455.499 -549.834L-309.065 326.653Z" fill="url(#paint0_linear_475_4800)" fill-opacity="0.03" />
        <path d="M524.978 -483.376C524.159 -484.195 522.818 -484.15 522.056 -483.277L-242.508 393.21C-243.199 394.002 -243.159 395.195 -242.415 395.939L-189.096 449.258C-188.277 450.077 -186.936 450.031 -186.174 449.159L578.39 -427.328C579.081 -428.121 579.041 -429.313 578.297 -430.057L524.978 -483.376Z" fill="url(#paint1_linear_475_4800)" fill-opacity="0.03" />
        <path d="M591.534 -416.819C590.716 -417.638 589.374 -417.593 588.613 -416.72L-175.951 459.767C-176.642 460.559 -176.602 461.752 -175.858 462.496L-122.539 515.815C-121.72 516.634 -120.379 516.588 -119.617 515.716L644.947 -360.771C645.638 -361.564 645.598 -362.756 644.854 -363.5L591.534 -416.819Z" fill="url(#paint2_linear_475_4800)" fill-opacity="0.03" />
        <path d="M658.091 -350.262C657.273 -351.081 655.931 -351.036 655.17 -350.163L-109.394 526.324C-110.085 527.116 -110.045 528.309 -109.301 529.053L-55.9817 582.372C-55.1627 583.191 -53.8216 583.145 -53.0603 582.273L711.504 -294.214C712.195 -295.007 712.154 -296.199 711.411 -296.943L658.091 -350.262Z" fill="url(#paint3_linear_475_4800)" fill-opacity="0.03" />
        <path d="M724.648 -283.706C723.829 -284.524 722.488 -284.479 721.727 -283.606L-42.837 592.881C-43.5284 593.673 -43.4878 594.866 -42.7441 595.61L10.5753 648.929C11.3942 649.748 12.7354 649.702 13.4966 648.83L778.061 -227.657C778.752 -228.45 778.711 -229.642 777.968 -230.386L724.648 -283.706Z" fill="url(#paint4_linear_475_4800)" fill-opacity="0.03" />
        <path d="M791.205 -217.149C790.386 -217.967 789.045 -217.922 788.284 -217.049L23.7199 659.438C23.0285 660.23 23.0691 661.423 23.8128 662.167L77.1322 715.486C77.9511 716.305 79.2922 716.259 80.0535 715.387L844.618 -161.1C845.309 -161.893 845.268 -163.086 844.525 -163.829L791.205 -217.149Z" fill="url(#paint5_linear_475_4800)" fill-opacity="0.03" />
        <defs>
            <linearGradient id="paint0_linear_475_4800" x1="45.2297" y1="-139.77" x2="490.323" y2="305.323" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint1_linear_475_4800" x1="45.2297" y1="-139.77" x2="490.323" y2="305.323" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint2_linear_475_4800" x1="45.2297" y1="-139.77" x2="490.323" y2="305.323" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint3_linear_475_4800" x1="45.2297" y1="-139.77" x2="490.323" y2="305.323" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint4_linear_475_4800" x1="45.2297" y1="-139.77" x2="490.323" y2="305.323" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
            <linearGradient id="paint5_linear_475_4800" x1="45.2297" y1="-139.77" x2="490.323" y2="305.323" gradientUnits="userSpaceOnUse">
                <stop />
                <stop offset="1" stop-opacity="0" />
            </linearGradient>
        </defs>
    </svg>
</div>

<?php get_template_part('parts/carousselPack'); ?>

<div class="evg">
    <div class="evgImgContainer">
        <!-- <img class="evgImg1" src="img/evg.png" alt=""> -->
        <?php echo wp_get_attachment_image(16213, 'full', false, ['alt' => 'Illustration catégorie', 'class' => 'evgImg1']); ?>
        <?php echo wp_get_attachment_image(16214, 'full', false, ['alt' => 'Illustration catégorie', 'class' => 'evgImg2']); ?>
    </div>
    <div class="evgContainer">
        <div class="evgHeading">
            <div class="evgTitle">
                <p class="subHeading">Moments Inoubliables</p>
                <p class="titleMedium">EVG/EVJF : Activités Fun, Tournées Offertes et Options Festives</p>
            </div>
            <p class="heroP">Choisissez nos offres dégressives pour un EVG ou EVJF sur mesure : plus d'activités, plus de fun, et des tournées offertes pour une journée inoubliable entre amis !
</p>
        </div>
        <div class="evgList">
            <div class="evgListItem">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="21" viewBox="0 0 18 21" fill="none">
                    <path d="M17.1501 12.8629C17.3801 12.0929 17.5001 11.2829 17.5001 10.4429C17.5001 9.60287 17.3801 8.79287 17.1501 8.02287C17.9301 7.42287 18.1701 6.32287 17.6601 5.44287C17.1501 4.56287 16.0801 4.21287 15.1701 4.59287C14.0601 3.42287 12.6101 2.56287 10.9901 2.17287C10.8501 1.19287 10.0101 0.442871 9.00005 0.442871C7.99005 0.442871 7.15005 1.19287 7.02005 2.17287C5.39005 2.56287 3.95005 3.42287 2.83005 4.59287C1.92005 4.21287 0.850051 4.56287 0.340051 5.44287C-0.169949 6.32287 0.0700513 7.42287 0.850051 8.02287C0.620051 8.79287 0.500051 9.60287 0.500051 10.4429C0.500051 11.2829 0.620051 12.0929 0.850051 12.8629C0.0700513 13.4629 -0.169949 14.5629 0.340051 15.4429C0.850051 16.3229 1.92005 16.6729 2.83005 16.2929C3.23005 16.7129 3.66005 17.0829 4.13005 17.4129L2.78005 20.4429H4.66005L5.64005 18.2529C6.08005 18.4429 6.54005 18.5929 7.02005 18.7129C7.15005 19.6929 7.99005 20.4429 9.00005 20.4429C10.0101 20.4429 10.8501 19.6929 10.9801 18.7129C11.4401 18.6029 11.8901 18.4529 12.3201 18.2729L13.3001 20.4429H15.1801L13.8401 17.4429C14.3201 17.1029 14.7701 16.7229 15.1801 16.2929C16.0901 16.6729 17.1701 16.3229 17.6701 15.4429C18.1701 14.5629 17.9301 13.4629 17.1501 12.8629ZM10.5601 17.1929C10.1901 16.7329 9.63005 16.4429 9.00005 16.4429C8.37005 16.4429 7.80005 16.7329 7.43005 17.1929C7.03005 17.1029 6.64005 16.9829 6.27005 16.8229L7.70005 13.6329C8.10005 13.7929 8.54005 13.8829 9.00005 13.8829C9.44005 13.8829 9.87005 13.8029 10.2601 13.6529L11.6801 16.8329C11.3201 16.9829 10.9501 17.1029 10.5601 17.1929ZM7.48005 10.4629C7.48005 9.63287 8.15005 8.96287 8.98005 8.96287C9.81005 8.96287 10.4801 9.63287 10.4801 10.4629C10.4801 11.2929 9.81005 11.9629 8.98005 11.9629C8.15005 11.9629 7.48005 11.2929 7.48005 10.4629ZM15.7101 12.4529C15.1001 12.5229 14.5301 12.8629 14.1901 13.4429C13.8701 14.0029 13.8501 14.6429 14.0701 15.1929C13.7901 15.4829 13.4901 15.7429 13.1701 15.9829L11.6701 12.6329C12.1601 12.0429 12.4501 11.2929 12.4501 10.4729C12.4501 8.58287 10.9001 7.06287 8.99005 7.06287C7.08005 7.06287 5.53005 8.59287 5.53005 10.4729C5.53005 11.2729 5.81005 12.0129 6.28005 12.6029L4.76005 15.9929C4.45005 15.7629 4.16005 15.5129 3.89005 15.2329C4.15005 14.6729 4.13005 14.0129 3.80005 13.4429C3.46005 12.8529 2.87005 12.5029 2.24005 12.4529C2.02005 11.7729 1.91005 11.0529 1.91005 10.3029C1.91005 9.66287 2.00005 9.04287 2.16005 8.45287C2.82005 8.42287 3.46005 8.07287 3.81005 7.45287C4.18005 6.82287 4.16005 6.07287 3.82005 5.47287C4.74005 4.49287 5.93005 3.78287 7.27005 3.44287C7.61005 4.03287 8.26005 4.44287 9.00005 4.44287C9.74005 4.44287 10.3901 4.04287 10.7301 3.44287C12.0701 3.78287 13.2601 4.51287 14.1701 5.49287C13.8501 6.08287 13.8401 6.82287 14.2001 7.44287C14.5501 8.04287 15.1601 8.39287 15.8001 8.44287C15.9601 9.03287 16.0501 9.65287 16.0501 10.3029C16.0501 11.0529 15.9301 11.7729 15.7101 12.4529Z" fill="#60626E" />
                </svg>
                <p>Activités ludiques pour une journée unique</p>
            </div>
            <div class="evgListItem">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="13" viewBox="0 0 24 13" fill="none">
                    <path d="M4 7.44287C5.1 7.44287 6 6.54287 6 5.44287C6 4.34287 5.1 3.44287 4 3.44287C2.9 3.44287 2 4.34287 2 5.44287C2 6.54287 2.9 7.44287 4 7.44287ZM5.13 8.54287C4.76 8.48287 4.39 8.44287 4 8.44287C3.01 8.44287 2.07 8.65287 1.22 9.02287C0.48 9.34287 0 10.0629 0 10.8729V12.4429H4.5V10.8329C4.5 10.0029 4.73 9.22287 5.13 8.54287ZM20 7.44287C21.1 7.44287 22 6.54287 22 5.44287C22 4.34287 21.1 3.44287 20 3.44287C18.9 3.44287 18 4.34287 18 5.44287C18 6.54287 18.9 7.44287 20 7.44287ZM24 10.8729C24 10.0629 23.52 9.34287 22.78 9.02287C21.93 8.65287 20.99 8.44287 20 8.44287C19.61 8.44287 19.24 8.48287 18.87 8.54287C19.27 9.22287 19.5 10.0029 19.5 10.8329V12.4429H24V10.8729ZM16.24 8.09287C15.07 7.57287 13.63 7.19287 12 7.19287C10.37 7.19287 8.93 7.58287 7.76 8.09287C6.68 8.57287 6 9.65287 6 10.8329V12.4429H18V10.8329C18 9.65287 17.32 8.57287 16.24 8.09287ZM8.07 10.4429C8.16 10.2129 8.2 10.0529 8.98 9.75287C9.95 9.37287 10.97 9.19287 12 9.19287C13.03 9.19287 14.05 9.37287 15.02 9.75287C15.79 10.0529 15.83 10.2129 15.93 10.4429H8.07ZM12 2.44287C12.55 2.44287 13 2.89287 13 3.44287C13 3.99287 12.55 4.44287 12 4.44287C11.45 4.44287 11 3.99287 11 3.44287C11 2.89287 11.45 2.44287 12 2.44287ZM12 0.442871C10.34 0.442871 9 1.78287 9 3.44287C9 5.10287 10.34 6.44287 12 6.44287C13.66 6.44287 15 5.10287 15 3.44287C15 1.78287 13.66 0.442871 12 0.442871Z" fill="#60626E" />
                </svg>
                <p>Tarifs de groupe pour une expérience inédite</p>
            </div>
            <div class="evgListItem">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <g clip-path="url(#clip0_475_4832)">
                        <path d="M7 16.4429C7.55 16.4429 8 16.8929 8 17.4429C8 18.5429 7.1 19.4429 6 19.4429C5.83 19.4429 5.67 19.4229 5.5 19.3929C5.81 18.8429 6 18.1829 6 17.4429C6 16.8929 6.45 16.4429 7 16.4429ZM18.67 3.44287C18.41 3.44287 18.16 3.54287 17.96 3.73287L9 12.6929L11.75 15.4429L20.71 6.48287C21.1 6.09287 21.1 5.46287 20.71 5.07287L19.37 3.73287C19.17 3.53287 18.92 3.44287 18.67 3.44287ZM7 14.4429C5.34 14.4429 4 15.7829 4 17.4429C4 18.7529 2.84 19.4429 2 19.4429C2.92 20.6629 4.49 21.4429 6 21.4429C8.21 21.4429 10 19.6529 10 17.4429C10 15.7829 8.66 14.4429 7 14.4429Z" fill="#60626E" />
                    </g>
                    <defs>
                        <clipPath id="clip0_475_4832">
                            <rect width="24" height="24" fill="white" transform="translate(0 0.442871)" />
                        </clipPath>
                    </defs>
                </svg>
                <p>Organisation sans stress avec nos services personnalisés</p>
            </div>
        </div>
        <div class="evgCTAs">
            <?php
            $evg_post_id = 15934;
            $evg_post_link = get_permalink($evg_post_id);
            ?>
            <a class="CTA-WhiteGradient" href="<?php echo esc_url($evg_post_link); ?>">
                <div class="CTA-orange">
                    <p>Découvrir l'offre</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                        <g clip-path="url(#clip0_882_2296)">
                            <path d="M10.0001 6.94287L8.59009 8.35287L13.1701 12.9429L8.59009 17.5329L10.0001 18.9429L16.0001 12.9429L10.0001 6.94287Z" fill="#FAF9FA" />
                        </g>
                        <defs>
                            <clipPath id="clip0_882_2296">
                                <rect width="24" height="24" fill="white" transform="translate(0 0.942871)" />
                            </clipPath>
                        </defs>
                    </svg>
                </div>
            </a>
            <a class="CTA-WhiteGradient" href="<?php echo esc_url($pageContact_url); ?>">
                <div class="CTA-white">Nous Contacter</div>
            </a>
        </div>
    </div>
</div>

<div class="LpGridContainer">
    <div class="LpGridHeading">
        <div class="LpGridTitle">
            <p class="subHeading">Notre Gamme de Prestations</p>
            <p class="titleMedium">Services d'Excellence pour des Événements Exceptionnels</p>
        </div>
        <p class="heroP">
Explorez la qualité et la variété de nos services pour rendre vos événements inoubliables. Location
de salles, activités diversifiées et solutions sur-mesure vous sont proposées.
        </p>
    </div>
    <div class="LpGrid">
        <div id="grid1">
            <a href="<?php echo esc_url($particulier_category_link); ?>">
                <div class="GridCarHeading">
                    <p class="GchTitle">Des activités ludiques et sportives</p>
                    <div class="GchLink">
                        <p>Découvrir toutes les activités</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="none">
                            <path d="M-8.76148e-05 10.59L1.40991 12L7.40991 6L1.40991 -5.24537e-07L-8.68122e-05 1.41L4.57991 6L-8.76148e-05 10.59Z" fill="#FAF9FA" />
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        <?php
        $events_page_id = 5964;
        $events_page_link = get_permalink($events_page_id);
        ?>

        <div id="grid2">
            <a href="<?php echo esc_url($events_page_link); ?>">
                <div class="GridCarHeading">
                    <div class="GchTitleContianer">
                        <p class="GchTitle-medium">
                            Location de salle pour un évènement inoubliable
                        </p>
                        <p class="GchSubTitle">Mariage - Anniversaire - Baptême - Séminaire</p>
                    </div>
                    <div class="GchLink">
                        <p>Découvrir</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="none">
                            <path d="M-8.76148e-05 10.59L1.40991 12L7.40991 6L1.40991 -5.24537e-07L-8.68122e-05 1.41L4.57991 6L-8.76148e-05 10.59Z" fill="#FAF9FA" />
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        <?php
        $teamBuilding_page_id = 16420;
        $teamBuilding_page_link = get_permalink($teamBuilding_page_id);
        ?>

        <div id="grid3">


            <a href="<?php echo esc_url($teamBuilding_page_link); ?>">
                <div class="GridCarHeading">
                    <p class="GchTitle">Un Team Building sur-mesure pour votre équipe</p>
                    <div class="GchLink">
                        <p>Découvrir</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12" fill="none">
                            <path d="M-8.76148e-05 10.59L1.40991 12L7.40991 6L1.40991 -5.24537e-07L-8.68122e-05 1.41L4.57991 6L-8.76148e-05 10.59Z" fill="#FAF9FA" />
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        <?php
        $anniversaire_page_id = 17053;
        $anniversaire_page_link = get_permalink($anniversaire_page_id);
        ?>

        <div id="grid4">
            <a href="<?php echo esc_url($anniversaire_page_link); ?>" class="linkGrid">
                <div class="gridSmallCardMain">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <path d="M4 44L14 16L32 34L4 44ZM10.6 37.4L24.7 32.4L15.6 23.3L10.6 37.4ZM29.1 25.1L27 23L38.2 11.8C39.2667 10.7333 40.55 10.2 42.05 10.2C43.55 10.2 44.8333 10.7333 45.9 11.8L47.1 13L45 15.1L43.8 13.9C43.3333 13.4333 42.75 13.2 42.05 13.2C41.35 13.2 40.7667 13.4333 40.3 13.9L29.1 25.1ZM21.1 17.1L19 15L20.2 13.8C20.6667 13.3333 20.9 12.7667 20.9 12.1C20.9 11.4333 20.6667 10.8667 20.2 10.4L18.9 9.1L21 7L22.3 8.3C23.3667 9.36667 23.9 10.6333 23.9 12.1C23.9 13.5667 23.3667 14.8333 22.3 15.9L21.1 17.1ZM25.1 21.1L23 19L30.2 11.8C30.6667 11.3333 30.9 10.75 30.9 10.05C30.9 9.35 30.6667 8.76667 30.2 8.3L27 5.1L29.1 3L32.3 6.2C33.3667 7.26667 33.9 8.55 33.9 10.05C33.9 11.55 33.3667 12.8333 32.3 13.9L25.1 21.1ZM33.1 29.1L31 27L34.2 23.8C35.2667 22.7333 36.55 22.2 38.05 22.2C39.55 22.2 40.8333 22.7333 41.9 23.8L45.1 27L43 29.1L39.8 25.9C39.3333 25.4333 38.75 25.2 38.05 25.2C37.35 25.2 36.7667 25.4333 36.3 25.9L33.1 29.1Z" fill="#FAF9FA" />
                    </svg>
                    <p class="GchTitle-medium">Un anniversaire unique</p>
                    <p class="GchP">En famille ou entre amis, profitez d’une expérience unique pour votre
                        anniversaire, adulte ou enfant.</p>
                </div>
                <p class="GchLink">En savoir plus</p>
            </a>
        </div>
        <div id="grid5">
            <?php
            $eventPage_id = 5964;
            $eventPage_url = get_permalink($eventPage_id);
            ?>
            <a class="linkGrid" href="<?php echo esc_url($eventPage_url . '#targetAdvantages'); ?>">
                <div class="gridSmallCardMain">
                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 38 38" fill="none">
  <path d="M16 16C17.1 16 18.0417 15.6083 18.825 14.825C19.6083 14.0417 20 13.1 20 12C20 10.9 19.6083 9.95833 18.825 9.175C18.0417 8.39167 17.1 8 16 8C14.9 8 13.9583 8.39167 13.175 9.175C12.3917 9.95833 12 10.9 12 12C12 13.1 12.3917 14.0417 13.175 14.825C13.9583 15.6083 14.9 16 16 16ZM16 24C17.5 24 18.9083 23.6833 20.225 23.05C21.5417 22.4167 22.6833 21.5167 23.65 20.35C22.4833 19.5833 21.2583 19 19.975 18.6C18.6917 18.2 17.3667 18 16 18C14.6333 18 13.3083 18.2 12.025 18.6C10.7417 19 9.51667 19.5833 8.35 20.35C9.31667 21.5167 10.4583 22.4167 11.775 23.05C13.0917 23.6833 14.5 24 16 24ZM35.2 38L25.8 28.6C24.4333 29.6667 22.925 30.5 21.275 31.1C19.625 31.7 17.8667 32 16 32C11.5333 32 7.75 30.45 4.65 27.35C1.55 24.25 0 20.4667 0 16C0 11.5333 1.55 7.75 4.65 4.65C7.75 1.55 11.5333 0 16 0C20.4667 0 24.25 1.55 27.35 4.65C30.45 7.75 32 11.5333 32 16C32 17.8667 31.7 19.625 31.1 21.275C30.5 22.925 29.6667 24.4333 28.6 25.8L38 35.2L35.2 38ZM16 28C19.3333 28 22.1667 26.8333 24.5 24.5C26.8333 22.1667 28 19.3333 28 16C28 12.6667 26.8333 9.83333 24.5 7.5C22.1667 5.16667 19.3333 4 16 4C12.6667 4 9.83333 5.16667 7.5 7.5C5.16667 9.83333 4 12.6667 4 16C4 19.3333 5.16667 22.1667 7.5 24.5C9.83333 26.8333 12.6667 28 16 28Z" fill="#FAF9FA"/>
</svg>
                    <p class="GchTitle-medium">Des services de qualité pour votre prochain événement</p>
                    <p class="GchP">Une équipe de prestataires locaux pour vos évènements.</p>
                </div>
                <p class="GchLink">En savoir plus</p>
            </a>
        </div>


    </div>
</div>

<?php get_template_part('parts/blogTroisArticles'); ?>



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


<?php get_template_part('parts/faqSectionParticulier'); ?>



<?php get_footer() ?>