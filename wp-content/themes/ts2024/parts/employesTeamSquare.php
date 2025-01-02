<div class="employesContainer">
    <div class="flexEmployes">
        <div class="textEmployes">
            <div class="titleEmployes">
                <div class="labelEmployes">
                    <div class="" style="width: 4px; height: 4px; background-color: #ee5d2b;"></div>
                    <p>Notre Équipe</p>
                </div>
                <h2>L'équipe qui vous fait vivre l'extraordinaire</h2>
            </div>
        </div>
    </div>
    <?php
    $args = array(
        'post_type' => 'employesTeamSquare',
        'posts_per_page' => -1,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
            <div class="cardEmployes">
                <?php echo get_the_post_thumbnail(get_the_ID(), 'post-thumbnail', ['class' => 'employeImg', 'alt' => 'Photo de profil']); ?>
                <h4><?php the_title(); ?></h4>
                <p class="pavis"><?php the_tags('', ', ', ''); ?></p>
                <p class="pavis"><?php the_excerpt(); ?></p>
            </div>
        <?php endwhile;
        wp_reset_postdata();
    else : ?>
        <p>Aucun employé trouvé.</p>
    <?php endif; ?>
</div>
