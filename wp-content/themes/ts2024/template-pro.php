<!-- La "homepage" de Ts pro -->

<?php
// Template Name: Pro
get_header();
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
                        Notre Savoir-Faire au Service des Professionnels
                    </h1>
                    <p class="heroP">
                        Chez Team Square, nous comprenons l'importance de créer des équipes soudées
                        et performantes. En associant des formations professionnelles et des activités
                        de loisir innovantes, nous proposons des solutions de Team Building qui boostent
                        la performance collective et le bien-être au travail.
                    </p>
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
                    Résultats mesurables
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
                    Formations sur-mesure
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
                    Expertise reconnue
                </p>
            </div>
        </div>
        <div class="heroIllustration">
            <?php echo wp_get_attachment_image(16405, 'full', false, ['alt' => 'Illustration catégorie', 'class' => 'heroImg2 active']); ?>
        </div>
    </div>

<?php get_template_part('parts/brandCaroussel'); ?>


    <div class="popularSection">
        <div class="popularHead">
            <div class="popularHeadLeft">
                <p class="subHeading">Pour une équipe au top</p>
                <p class="titleMedium">Des Formations Professionnelles Uniques</p>
                <p class="heroP">
                    Boostez les compétences et la cohésion de votre équipe avec nos formations sur mesure
                    adaptées à vos besoins professionnels.
                </p>
            </div>
            <div class="popularHeadRight">
            <?php
                    $formations_category_id = 199;
                    $formations_category_link = get_category_link($formations_category_id);
                    ?>
            <a href="<?php echo esc_url($formations_category_link); ?>" class="moreLink">Voir tout</a>
    
            </div>
        </div>

        <!---------------------------------------------- caroussel pro formation ----------------------------------------->

        <div class="popularMainWrapper">
            <div class="popularMain">
                <?php

                $args = array(
                    'post_type' => 'proTeamSquare',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'slug',
                            'terms'    => 'formations',
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


    <!---------------------------------------------- end caroussel ----------------------------------------->


</div>

<div class="evg">
    <div class="evgImgContainer">
        <!-- <img class="evgImg1" src="img/evg.png" alt=""> -->
        <?php echo wp_get_attachment_image(16213, 'full', false, ['alt' => 'Illustration catégorie', 'class' => 'evgImg1']); ?>
        <?php echo wp_get_attachment_image(16214, 'full', false, ['alt' => 'Illustration catégorie', 'class' => 'evgImg2']); ?>
    </div>
    <div class="evgContainer">
        <div class="evgHeading">
            <div class="evgTitle">
                <p class="subHeading">Avantages</p>
                <p class="titleMedium">Le Team Building un investissement gagnant</p>
            </div>
            <p class="heroP">Découvrez comment le Team Building peut transformer votre entreprise en une équipe plus unie et plus performante.</p>
        </div>
        <div class="evgList">
            <div class="evgListItem">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                    <path d="M0 20.7793V2.7793C0 2.2293 0.196 1.7583 0.588 1.3663C0.979333 0.974963 1.45 0.779297 2 0.779297H18C18.55 0.779297 19.021 0.974963 19.413 1.3663C19.8043 1.7583 20 2.2293 20 2.7793V14.7793C20 15.3293 19.8043 15.8003 19.413 16.1923C19.021 16.5836 18.55 16.7793 18 16.7793H4L0 20.7793ZM2 15.9543L3.175 14.7793H18V2.7793H2V15.9543Z" fill="#60626E" />
                </svg>
                <p>Communication : Favorise une communication ouverte et honnête.</p>
            </div>
            <div class="evgListItem">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="13" viewBox="0 0 24 13" fill="none">
                    <path d="M4 7.7793C5.1 7.7793 6 6.8793 6 5.7793C6 4.6793 5.1 3.7793 4 3.7793C2.9 3.7793 2 4.6793 2 5.7793C2 6.8793 2.9 7.7793 4 7.7793ZM5.13 8.8793C4.76 8.8193 4.39 8.7793 4 8.7793C3.01 8.7793 2.07 8.9893 1.22 9.3593C0.48 9.6793 0 10.3993 0 11.2093V12.7793H4.5V11.1693C4.5 10.3393 4.73 9.5593 5.13 8.8793ZM20 7.7793C21.1 7.7793 22 6.8793 22 5.7793C22 4.6793 21.1 3.7793 20 3.7793C18.9 3.7793 18 4.6793 18 5.7793C18 6.8793 18.9 7.7793 20 7.7793ZM24 11.2093C24 10.3993 23.52 9.6793 22.78 9.3593C21.93 8.9893 20.99 8.7793 20 8.7793C19.61 8.7793 19.24 8.8193 18.87 8.8793C19.27 9.5593 19.5 10.3393 19.5 11.1693V12.7793H24V11.2093ZM16.24 8.4293C15.07 7.9093 13.63 7.5293 12 7.5293C10.37 7.5293 8.93 7.9193 7.76 8.4293C6.68 8.9093 6 9.9893 6 11.1693V12.7793H18V11.1693C18 9.9893 17.32 8.9093 16.24 8.4293ZM8.07 10.7793C8.16 10.5493 8.2 10.3893 8.98 10.0893C9.95 9.7093 10.97 9.5293 12 9.5293C13.03 9.5293 14.05 9.7093 15.02 10.0893C15.79 10.3893 15.83 10.5493 15.93 10.7793H8.07ZM12 2.7793C12.55 2.7793 13 3.2293 13 3.7793C13 4.3293 12.55 4.7793 12 4.7793C11.45 4.7793 11 4.3293 11 3.7793C11 3.2293 11.45 2.7793 12 2.7793ZM12 0.779297C10.34 0.779297 9 2.1193 9 3.7793C9 5.4393 10.34 6.7793 12 6.7793C13.66 6.7793 15 5.4393 15 3.7793C15 2.1193 13.66 0.779297 12 0.779297Z" fill="#60626E" />
                </svg>
                <p>Cohésion : Crée des liens et renforce le sentiment d’appartenance.</p>
            </div>
            <div class="evgListItem">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M8.8 21.7793H5C4.45 21.7793 3.97917 21.5835 3.5875 21.1918C3.19583 20.8001 3 20.3293 3 19.7793V15.9793C3.8 15.9793 4.5 15.7251 5.1 15.2168C5.7 14.7085 6 14.0626 6 13.2793C6 12.496 5.7 11.8501 5.1 11.3418C4.5 10.8335 3.8 10.5793 3 10.5793V6.7793C3 6.2293 3.19583 5.75846 3.5875 5.3668C3.97917 4.97513 4.45 4.7793 5 4.7793H9C9 4.0793 9.24167 3.48763 9.725 3.0043C10.2083 2.52096 10.8 2.2793 11.5 2.2793C12.2 2.2793 12.7917 2.52096 13.275 3.0043C13.7583 3.48763 14 4.0793 14 4.7793H18C18.55 4.7793 19.0208 4.97513 19.4125 5.3668C19.8042 5.75846 20 6.2293 20 6.7793V10.7793C20.7 10.7793 21.2917 11.021 21.775 11.5043C22.2583 11.9876 22.5 12.5793 22.5 13.2793C22.5 13.9793 22.2583 14.571 21.775 15.0543C21.2917 15.5376 20.7 15.7793 20 15.7793V19.7793C20 20.3293 19.8042 20.8001 19.4125 21.1918C19.0208 21.5835 18.55 21.7793 18 21.7793H14.2C14.2 20.946 13.9375 20.2376 13.4125 19.6543C12.8875 19.071 12.25 18.7793 11.5 18.7793C10.75 18.7793 10.1125 19.071 9.5875 19.6543C9.0625 20.2376 8.8 20.946 8.8 21.7793ZM5 19.7793H7.125C7.525 18.6793 8.16667 17.9043 9.05 17.4543C9.93333 17.0043 10.75 16.7793 11.5 16.7793C12.25 16.7793 13.0667 17.0043 13.95 17.4543C14.8333 17.9043 15.475 18.6793 15.875 19.7793H18V13.7793H20C20.1333 13.7793 20.25 13.7293 20.35 13.6293C20.45 13.5293 20.5 13.4126 20.5 13.2793C20.5 13.146 20.45 13.0293 20.35 12.9293C20.25 12.8293 20.1333 12.7793 20 12.7793H18V6.7793H12V4.7793C12 4.64596 11.95 4.5293 11.85 4.4293C11.75 4.3293 11.6333 4.2793 11.5 4.2793C11.3667 4.2793 11.25 4.3293 11.15 4.4293C11.05 4.5293 11 4.64596 11 4.7793V6.7793H5V8.9793C5.9 9.31263 6.625 9.87096 7.175 10.6543C7.725 11.4376 8 12.3126 8 13.2793C8 14.2293 7.725 15.096 7.175 15.8793C6.625 16.6626 5.9 17.2293 5 17.5793V19.7793Z" fill="#60626E" />
                </svg>
                <p>Résolution des Conflits : Offre un cadre neutre pour résoudre les conflits.</p>
            </div>
        </div>
        <div class="evgCTAs">
            <a class="CTA-WhiteGradient" href="<?php echo esc_url(get_permalink(16420)); ?>">
                <div class="CTA-orange">
                    <p>Voir l'offre</p>
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
            <a class="CTA-WhiteGradient" href="<?php echo esc_url($pageProContact_url); ?>">
                <div class="CTA-white">Nous Contacter</div>
            </a>
        </div>
    </div>
</div>

<div class="popularSection">
    <div class="popularHead">
        <div class="popularHeadLeft">
            <p class="subHeading">Des solutions adaptées</p>
            <p class="titleMedium">Solutions Personnalisées pour Toutes les Collectivités</p>
            <p class="heroP">
                Quel que soit votre secteur d'activité ou la taille de votre entreprise, nous avons
                des solutions adaptées à vos besoins spécifiques. Explorez nos offres dédiées pour chaque
                type d'organisation.
            </p>
        </div>
        <div class="popularHeadRight">
        <?php
                    $solutions_category_id = 198;
                    $solutions_category_link = get_category_link($solutions_category_id);
                    ?>
            <a href="<?php echo esc_url($solutions_category_link); ?>" class="moreLink">Voir tout</a>
        </div>
    </div>




    <!---------------------------------------------- caroussel pro formation ----------------------------------------->

    <div class="popularMainWrapper">
        <div class="popularMain">
            <?php

            $args = array(
                'post_type' => 'proTeamSquare',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'slug',
                        'terms'    => 'solutions',
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


<!---------------------------------------------- end caroussel ----------------------------------------->


</div>


<div class="imageCta">
    <div class="imageCtaContent">
        <p class="titleMedium">
            Besoin d'une salle pour votre prochain événement professionnel ? Découvrez nos espaces équipés !
        </p>
        <div class="heroCTAs">
            <?php
            $categorySalles_id = 197; 
            $categorySalles_link = get_category_link($categorySalles_id);
            ?>
            <a href="<?php echo esc_url($categorySalles_link); ?>" class="CTA-orange">Decouvrir les salles</a>
            <a href="<?php echo esc_url($pageProContact_url); ?>" class="CTA-white">Obtenir un devis</a>
        </div>
    </div>
</div>





<?php get_template_part('parts/faqSectionPro'); ?>



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
                'category_name' => 'pro',
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


<?php get_template_part('parts/ctaSectionOrange'); ?>




<?php get_footer(); ?>