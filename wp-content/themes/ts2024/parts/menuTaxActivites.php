<div class="bgGrey">




<?php

$parent_category_id = 176; 


$child_categories = get_terms(array(
    'taxonomy' => 'category',
    'parent' => $parent_category_id,
    'hide_empty' => false
));

$image_ids = [
    17346, 
    17347,
    17348,
    15886,
    17350,
    17351,
];
?>

<div class="activitiesCat">
    <div class="activitiesCatCards">
        <?php
        $i = 0;
        foreach ($child_categories as $child_category) : ?>
            <a href="<?= get_category_link($child_category->term_id); ?>" class="linkTax <?= is_category($child_category->term_id) ? 'activeTax' : ''; ?>">
                <div class="activityCatCard">
                    <?php
                    echo wp_get_attachment_image($image_ids[$i % count($image_ids)], 'full', false, ['alt' => 'Image de remplacement']);
                    ?>
                    <p class="activityCatCardTitle"><?= $child_category->name; ?></p>
                </div>
            </a>
            <?php $i++; ?>
        <?php endforeach; ?>
    </div>
</div>



</div>