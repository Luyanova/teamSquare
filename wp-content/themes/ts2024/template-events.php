<!-- La "homepage" de ts events(sur la page events)  -->

<?php
// Template Name: Events
get_header('events');
?>


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
                        Une célébration inoubliable pour <span class="heroHeadLineGrey active">un Mariage</span> <span class="heroHeadLineGrey">un Anniversaire</span><span class="heroHeadLineGrey">un Évènement Pro</span>
                    </h1>
                    <p class="heroP">
                        Chez Team Square Events, nous vous proposons la location de 9 salles de réception modernes à Hénin-Beaumont, idéales pour accueillir vos événements privés. Nos salles, pouvant accueillir de 10 à 500 personnes, sont accompagnées de services complémentaires. Notre équipe dédiée assure une organisation sans faille, pour faire de votre événement un succès. Découvrez la salle qui convient le mieux à vos besoins et personnalisez votre expérience.
                    </p>
                </div>
                <div class="heroCTAs">

 

                    <?php
                    $pageContact_id = 136;
                    $pageContact_url = get_permalink($pageContact_id);
                    echo '<a class="CTA-white" href="' . esc_url($pageContact_url) . '">Demander un devis gratuit</a>';
                    ?>


                </div>
            </div>
            <div class="heroSpec">
                <p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                        <g clip-path="url(#clip0_597_7803)">
                            <path d="M8.99991 16.6698L4.82991 12.4998L3.40991 13.9098L8.99991 19.4998L20.9999 7.49984L19.5899 6.08984L8.99991 16.6698Z" fill="#60626E" />
                        </g>
                        <defs>
                            <clipPath id="clip0_597_7803">
                                <rect width="24" height="24" fill="white" transform="translate(0 0.5)" />
                            </clipPath>
                        </defs>
                    </svg>
                    Salles équipées
                </p>
                <p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                        <g clip-path="url(#clip0_597_7803)">
                            <path d="M8.99991 16.6698L4.82991 12.4998L3.40991 13.9098L8.99991 19.4998L20.9999 7.49984L19.5899 6.08984L8.99991 16.6698Z" fill="#60626E" />
                        </g>
                        <defs>
                            <clipPath id="clip0_597_7803">
                                <rect width="24" height="24" fill="white" transform="translate(0 0.5)" />
                            </clipPath>
                        </defs>
                    </svg>
                    -50% avec la prestation traiteur
                </p>
                <p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                        <g clip-path="url(#clip0_597_7803)">
                            <path d="M8.99991 16.6698L4.82991 12.4998L3.40991 13.9098L8.99991 19.4998L20.9999 7.49984L19.5899 6.08984L8.99991 16.6698Z" fill="#60626E" />
                        </g>
                        <defs>
                            <clipPath id="clip0_597_7803">
                                <rect width="24" height="24" fill="white" transform="translate(0 0.5)" />
                            </clipPath>
                        </defs>
                    </svg>
                    Offre sur-mesure
                </p>
            </div>
        </div>
        <div class="heroIllustration">
            <?php echo wp_get_attachment_image(16331, 'full', false, ['alt' => 'Illustration catégorie', 'class' => 'heroImg2 active']); ?>
            <?php echo wp_get_attachment_image(16332, 'full', false, ['alt' => 'Illustration catégorie', 'class' => 'heroImg2']); ?>
            <?php echo wp_get_attachment_image(16333, 'full', false, ['alt' => 'Illustration catégorie', 'class' => 'heroImg2']); ?>
        </div>
    </div>


    <div class="popularSection">
        <div class="popularHead">
            <div class="popularHeadLeft">
                <p class="subHeading">Des évènements uniques</p>
                <p class="titleMedium">Salles Populaires</p>
                <p class="heroP">
                    9 salles de réception de 35 à 350m2 pour accueillir vos événements privés et professionnels de 10 à 500 personnes.
                </p>
            </div>
            <?php
            $categorySalles_id = 197; 
            $categorySalles_link = get_category_link($categorySalles_id);
            ?>
            <div class="popularHeadRight">
                <a href="<?php echo esc_url($categorySalles_link); ?>" class="moreLink" style="color: #8c12c5!important;">Voir tout</a>
            </div>


        </div>
        <!---------------------------------------------- caroussel salle ----------------------------------------->

        <div class="popularMainWrapper">
            <div class="popularMain">
                <?php

                $args = array(
                    'post_type' => 'eventsTeamSquare',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'slug',
                            'terms'    => 'salles',
                        ),
                    ),
                );


                $query = new WP_Query($args);

                // La boucle
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="popularCard">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('post-thumbnail', ['class' => 'popularCardImg']); ?>
                            <?php endif; ?>
                            <div class="popularCardBtm">
                                <p class="cardTitle"><?php the_title(); ?></p>
                          
                                <p class="cardSpec">
                                    <?php
                                    $informations = get_post_meta(get_the_ID(), 'ts24_informations', true);
                                    if ($informations) {
                                        echo esc_html($informations);
                                    }
                                    ?>
                                </p>
                                <p class="cardSpec">
                                    <?php
                                    $informations2 = get_post_meta(get_the_ID(), 'ts24_informations2', true);
                                    if ($informations2) {
                                        echo esc_html($informations2);
                                    }
                                    ?>
                                </p>

                                <div class="cardPromo">
                                    <?php
                                    $priceReduction = get_post_meta(get_the_ID(), 'ts24_prixReduction', true);



                                    ?>
                                    <p class="cardPrice">
                                        <span class="cardPriceBold"><?php echo esc_html($priceReduction); ?>€</span> /Jour
                                    </p>






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






<div class="adventages" >
    <?php echo wp_get_attachment_image(16350, 'full', false, ['alt' => 'Illustration', 'class' => 'adventagesImg']); ?>

    <div class="adventages__container">
        <div class="adventages__heading">
            <div class="adventages__title">
                <p class="subHeading">Avantages</p>
                <p class="titleMedium">Des salles polyvalentes pour tous vos évènements</p>
            </div>
            <p class="heroP">
                Découvrez les avantages uniques de Team Square Events pour faire de votre événement
                un succès à Hénin-Beaumont, près de Lille, dans le Nord Pas-de-Calais. </p>
        </div>
        <div class="adventagesList">
            <div class="adventagesListItem">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M8.8 21.5H5C4.45 21.5 3.97917 21.3042 3.5875 20.9125C3.19583 20.5208 3 20.05 3 19.5V15.7C3.8 15.7 4.5 15.4458 5.1 14.9375C5.7 14.4292 6 13.7833 6 13C6 12.2167 5.7 11.5708 5.1 11.0625C4.5 10.5542 3.8 10.3 3 10.3V6.5C3 5.95 3.19583 5.47917 3.5875 5.0875C3.97917 4.69583 4.45 4.5 5 4.5H9C9 3.8 9.24167 3.20833 9.725 2.725C10.2083 2.24167 10.8 2 11.5 2C12.2 2 12.7917 2.24167 13.275 2.725C13.7583 3.20833 14 3.8 14 4.5H18C18.55 4.5 19.0208 4.69583 19.4125 5.0875C19.8042 5.47917 20 5.95 20 6.5V10.5C20.7 10.5 21.2917 10.7417 21.775 11.225C22.2583 11.7083 22.5 12.3 22.5 13C22.5 13.7 22.2583 14.2917 21.775 14.775C21.2917 15.2583 20.7 15.5 20 15.5V19.5C20 20.05 19.8042 20.5208 19.4125 20.9125C19.0208 21.3042 18.55 21.5 18 21.5H14.2C14.2 20.6667 13.9375 19.9583 13.4125 19.375C12.8875 18.7917 12.25 18.5 11.5 18.5C10.75 18.5 10.1125 18.7917 9.5875 19.375C9.0625 19.9583 8.8 20.6667 8.8 21.5ZM5 19.5H7.125C7.525 18.4 8.16667 17.625 9.05 17.175C9.93333 16.725 10.75 16.5 11.5 16.5C12.25 16.5 13.0667 16.725 13.95 17.175C14.8333 17.625 15.475 18.4 15.875 19.5H18V13.5H20C20.1333 13.5 20.25 13.45 20.35 13.35C20.45 13.25 20.5 13.1333 20.5 13C20.5 12.8667 20.45 12.75 20.35 12.65C20.25 12.55 20.1333 12.5 20 12.5H18V6.5H12V4.5C12 4.36667 11.95 4.25 11.85 4.15C11.75 4.05 11.6333 4 11.5 4C11.3667 4 11.25 4.05 11.15 4.15C11.05 4.25 11 4.36667 11 4.5V6.5H5V8.7C5.9 9.03333 6.625 9.59167 7.175 10.375C7.725 11.1583 8 12.0333 8 13C8 13.95 7.725 14.8167 7.175 15.6C6.625 16.3833 5.9 16.95 5 17.3V19.5Z" fill="#60626E" />
                </svg>
                <p>Capacités Flexibles : 9 salles de 10 à 500 personnes.</p>
            </div>
            <div class="adventagesListItem">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="13" viewBox="0 0 24 13" fill="none">
                    <path d="M4 7.5C5.1 7.5 6 6.6 6 5.5C6 4.4 5.1 3.5 4 3.5C2.9 3.5 2 4.4 2 5.5C2 6.6 2.9 7.5 4 7.5ZM5.13 8.6C4.76 8.54 4.39 8.5 4 8.5C3.01 8.5 2.07 8.71 1.22 9.08C0.48 9.4 0 10.12 0 10.93V12.5H4.5V10.89C4.5 10.06 4.73 9.28 5.13 8.6ZM20 7.5C21.1 7.5 22 6.6 22 5.5C22 4.4 21.1 3.5 20 3.5C18.9 3.5 18 4.4 18 5.5C18 6.6 18.9 7.5 20 7.5ZM24 10.93C24 10.12 23.52 9.4 22.78 9.08C21.93 8.71 20.99 8.5 20 8.5C19.61 8.5 19.24 8.54 18.87 8.6C19.27 9.28 19.5 10.06 19.5 10.89V12.5H24V10.93ZM16.24 8.15C15.07 7.63 13.63 7.25 12 7.25C10.37 7.25 8.93 7.64 7.76 8.15C6.68 8.63 6 9.71 6 10.89V12.5H18V10.89C18 9.71 17.32 8.63 16.24 8.15ZM8.07 10.5C8.16 10.27 8.2 10.11 8.98 9.81C9.95 9.43 10.97 9.25 12 9.25C13.03 9.25 14.05 9.43 15.02 9.81C15.79 10.11 15.83 10.27 15.93 10.5H8.07ZM12 2.5C12.55 2.5 13 2.95 13 3.5C13 4.05 12.55 4.5 12 4.5C11.45 4.5 11 4.05 11 3.5C11 2.95 11.45 2.5 12 2.5ZM12 0.5C10.34 0.5 9 1.84 9 3.5C9 5.16 10.34 6.5 12 6.5C13.66 6.5 15 5.16 15 3.5C15 1.84 13.66 0.5 12 0.5Z" fill="#60626E" />
                </svg>
                <p>Équipements Modernes : Parking surveillé, accès privatif.</p>
            </div>
            <div class="adventagesListItem">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M8 19.5H9.5V12.75C9.93333 12.6167 10.2917 12.3792 10.575 12.0375C10.8583 11.6958 11 11.2833 11 10.8V7C11 6.86667 10.95 6.75 10.85 6.65C10.75 6.55 10.6333 6.5 10.5 6.5C10.3667 6.5 10.25 6.55 10.15 6.65C10.05 6.75 10 6.86667 10 7V9.5H9.25V7C9.25 6.86667 9.2 6.75 9.1 6.65C9 6.55 8.88333 6.5 8.75 6.5C8.61667 6.5 8.5 6.55 8.4 6.65C8.3 6.75 8.25 6.86667 8.25 7V9.5H7.5V7C7.5 6.86667 7.45 6.75 7.35 6.65C7.25 6.55 7.13333 6.5 7 6.5C6.86667 6.5 6.75 6.55 6.65 6.65C6.55 6.75 6.5 6.86667 6.5 7V10.8C6.5 11.2833 6.64167 11.6958 6.925 12.0375C7.20833 12.3792 7.56667 12.6167 8 12.75V19.5ZM14 19.5H15.5V13.15C16.05 12.8833 16.4792 12.4583 16.7875 11.875C17.0958 11.2917 17.25 10.6083 17.25 9.825C17.25 8.875 17.0125 8.08333 16.5375 7.45C16.0625 6.81667 15.4667 6.5 14.75 6.5C14.0333 6.5 13.4375 6.81667 12.9625 7.45C12.4875 8.08333 12.25 8.875 12.25 9.825C12.25 10.6083 12.4042 11.2917 12.7125 11.875C13.0208 12.4583 13.45 12.8833 14 13.15V19.5ZM4 22.5C3.45 22.5 2.97917 22.3042 2.5875 21.9125C2.19583 21.5208 2 21.05 2 20.5V4.5C2 3.95 2.19583 3.47917 2.5875 3.0875C2.97917 2.69583 3.45 2.5 4 2.5H20C20.55 2.5 21.0208 2.69583 21.4125 3.0875C21.8042 3.47917 22 3.95 22 4.5V20.5C22 21.05 21.8042 21.5208 21.4125 21.9125C21.0208 22.3042 20.55 22.5 20 22.5H4ZM4 20.5H20V4.5H4V20.5Z" fill="#60626E" />
                </svg>
                <p>Services : Traiteur, décorateur, photographe...</p>
            </div>
        </div>
        <div class="adventagesCTAs">

        <?php
            $sallesCategory_id = 197; 
            $sallesCategory_link = get_category_link($sallesCategory_id);
            ?>
            <a href="<?php echo esc_url($sallesCategory_link); ?>" class="CTA-WhiteGradient">
                <div class="CTA-violet">
                    <p>Découvrir les salles</p>
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
            <a class="CTA-WhiteGradient">
                <?php
                $pageContact_id = 136;
                $pageContact_url = get_permalink($pageContact_id);
                echo '<a class="CTA-white" href="' . esc_url($pageContact_url) . '">Demander un devis gratuit</a>';
                ?>
            </a>
        </div>
    </div>
</div>



<div class="popularSection">
    <div class="popularHead">
        <div class="popularHeadLeft">
            <p class="subHeading">Des Évènements uniques</p>
            <p class="titleMedium">Célébrez Chaque Instant avec Nos Offres Sur-Mesure</p>
            <p class="heroP">
                Des services d’événementiel exceptionnels, pour transformer vos célébrations en
                souvenirs inoubliables. Nous vous proposons des offres personnalisées qui s’adaptent
                parfaitement à votre type d’événement.
            </p>
        </div>

        <?php
        $categoryEvenements_id = 196;
        $categoryEvenements_link = get_category_link($categoryEvenements_id);
        ?>
        <div class="popularHeadRight">
            <a href="<?php echo esc_url($categoryEvenements_link); ?>" class="moreLink" style="color: #8c12c5!important;">Voir tout</a>
        </div>
    </div>
    <!---------------------------------------------- caroussel salle ----------------------------------------->

    <div class="popularMainWrapper">
        <div class="popularMain" id="popularMain2">
            <?php

            $args = array(
                'post_type' => 'eventsTeamSquare',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => 'evenements',
                    ),
                ),
            );


            $query = new WP_Query($args);

            // La boucle
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
                            <p class="cardSpec">
                                <?php
                                $informations2 = get_post_meta(get_the_ID(), 'ts24_informations2', true);
                                if ($informations2) {
                                    echo esc_html($informations2);
                                }
                                ?>
                            </p>

                            <div class="cardPromo">
                                <?php
                                $priceReduction = get_post_meta(get_the_ID(), 'ts24_prixReduction', true);



                                ?>
                                <p class="cardPrice">
                                    <span class="cardPriceBold"><?php echo esc_html($priceReduction); ?>€</span> /Jour
                                </p>






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




<div class="psGrey" id="targetAdvantages">
    <div class="popularSection">
        <div class="popularHead">
            <div class="popularHeadLeft">
                <p class="subHeading" >Partenaires locaux</p>
                <p class="titleMedium">Excellence et Diversité à Votre Service</p>
                <p class="heroP">
                    Découvrez l’excellence et la diversité de nos services pour des événements marquants.
                    Location de salles, activités variées, et prestations sur-mesure vous attendent.
                </p>
            </div>
        </div>
        <div class="popularMainWrapper">
            <div class="popularMain" id="cardBtnSlider">
                <div class="buttonCard">
                    <?php echo wp_get_attachment_image(18196, 'medium', false, ['alt' => 'Image remplacement']); ?>
                    <div class="buttonCardContent">
                        <div class="buttonCardTitle toggleTextButton">
                            <p>Traiteur</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="5" y="11" width="14" height="2" fill="white" />
                                <rect x="13" y="5" width="14" height="2" transform="rotate(90 13 5)" fill="white" class="toSuppr" />
                            </svg>
                        </div>
                        <div class="hiddenText">
                            <p>
                            Avec Team Square Events, bénéficiez d'un service traiteur haut de gamme qui propose une cuisine variée et raffinée. Quel que soit l'événement, nos chefs expérimentés élaborent des menus personnalisés. Bénéficiez 50% de remise sur le prix de la location de salle en commandant ce service.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="buttonCard">
                    <?php echo wp_get_attachment_image(18143, 'medium', false, ['alt' => 'Assiette de traiteur']); ?>
                    <div class="buttonCardContent">
                        <div class="buttonCardTitle toggleTextButton">
                            <p>Traiteur Oriental</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="5" y="11" width="14" height="2" fill="white" />
                                <rect x="13" y="5" width="14" height="2" transform="rotate(90 13 5)" fill="white" class="toSuppr" />
                            </svg>
                        </div>
                        <div class="hiddenText">
                            <p>
                            Apportez une touche d'exotisme à votre événement avec notre traiteur oriental. Team Square Events vous propose des plats traditionnels et savoureux qui raviront les palais de tous vos convives. Bénéficiez 50% de remise sur le prix de la location de salle en commandant ce service.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="buttonCard">
                    <?php echo wp_get_attachment_image(18195, 'medium', false, ['alt' => 'Une pièce montée pour un mariage']); ?>
                    <div class="buttonCardContent">
                        <div class="buttonCardTitle toggleTextButton">

                            <p>Pâtissier</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="5" y="11" width="14" height="2" fill="white" />
                                <rect x="13" y="5" width="14" height="2" transform="rotate(90 13 5)" fill="white" class="toSuppr" />
                            </svg>
                        </div>
                        <div class="hiddenText">
                            <p>
                              Faites de votre dessert un véritable spectacle grâce aux talents de notre pâtissier. Team Square Events vous propose une large gamme de pâtisseries élégantes et délicieuses, allant des gâteaux traditionnels aux créations modernes, pour émerveiller vos invités.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="buttonCard">
                    <?php echo wp_get_attachment_image(18141, 'medium', false, ['alt' => 'Un bouquet de fleur']); ?>
                    <div class="buttonCardContent">
                        <div class="buttonCardTitle toggleTextButton">

                            <p>Fleuriste</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="5" y="11" width="14" height="2" fill="white" />
                                <rect x="13" y="5" width="14" height="2" transform="rotate(90 13 5)" fill="white" class="toSuppr" />
                            </svg>
                        </div>
                        <div class="hiddenText">
                            <p>
                            Embellissez votre lieu de réception avec les magnifiques compositions florales de notre fleuriste. Team Square Events crée des arrangements personnalisés, en accord avec le thème de votre événement, pour apporter fraîcheur et élégance à votre décoration.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="buttonCard">
                    <?php echo wp_get_attachment_image(18139, 'medium', false, ['alt' => 'Une salle décoré  pour un mariage']); ?>
                    <div class="buttonCardContent">
                        <div class="buttonCardTitle toggleTextButton">

                            <p>Décoration</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="5" y="11" width="14" height="2" fill="white" />
                                <rect x="13" y="5" width="14" height="2" transform="rotate(90 13 5)" fill="white" class="toSuppr" />
                            </svg>
                        </div>
                        <div class="hiddenText">
                            <p>
                            Transformez votre salle en un lieu magique avec notre service de décoration. Team Square Events s'occupe de tout, des éléments de décoration aux éclairages, pour créer une ambiance unique et sur mesure qui correspond parfaitement à votre vision et à votre thème.
                            </p>
                        </div>
                    </div>
                </div>


                <div class="buttonCard">
                    <?php echo wp_get_attachment_image(18144, 'medium', false, ['alt' => 'Un photographe qui prend en photo deux mariés']); ?>
                    <div class="buttonCardContent">
                        <div class="buttonCardTitle toggleTextButton">

                            <p>Photographe</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="5" y="11" width="14" height="2" fill="white" />
                                <rect x="13" y="5" width="14" height="2" transform="rotate(90 13 5)" fill="white" class="toSuppr" />
                            </svg>
                        </div>
                        <div class="hiddenText">
                            <p>
                            Capturez chaque instant magique de votre événement avec notre photographe professionnel. Team Square Events garantit des clichés de haute qualité, que ce soit pour des photos posées ou des moments spontanés, afin de créer des souvenirs impérissables.
                            </p>
                        </div>
                    </div>
                </div>




            </div>
        </div>
        <div class="popularBtm">

            <div class="popularBtmRight">
                <button class="popularPagine" id="cardBtnPagineBack">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M15.41 7.41L14 6L8 12L14 18L15.41 16.59L10.83 12L15.41 7.41Z" fill="#60626E" />
                    </svg>
                </button>
                <button class="popularPagine" id="cardBtnPagineNext">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M8.59 16.59L10 18L16 12L10 6L8.59 7.41L13.17 12L8.59 16.59Z" fill="#60626E" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>






<!----------------------- 3 articles du blog -------------->

<div class="news">
    <div class="newsHeading">
        <div class="newsHeadingMain">
            <p class="subHeading">Blog</p>
            <p class="titleMedium">Dernières actualités</p>
        </div>
        <p class="heroP">Découvrez notre blog</p>
    </div>
    <div class="newsCardContainer">
        <?php
        // Arguments pour la requête WP_Query
        $args = array(
            'post_type' => 'post',        // Assurez-vous de cibler les articles de base
            'category_name' => 'blog-events',    // Nom de la catégorie à cibler
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
                'category_name' => 'events',
                'posts_per_page' => -1
            );

            $query = new WP_Query($args);

            // La boucle
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="review">
                        <?php echo wp_get_attachment_image(15968, 'medium', false, ['alt' => 'Étoiles']); ?>
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



<?php get_template_part('parts/faqSectionEvents'); ?>

<?php get_template_part('parts/ctaSectionOrange'); ?>






<?php get_footer('events'); ?>