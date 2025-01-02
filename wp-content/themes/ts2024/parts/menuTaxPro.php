<div class="bgGrey">




<?php
// Remplacer par l'ID de la catégorie "particulier"
$parent_category_id = 179; // Remplacez 123 par l'ID de la catégorie "particulier"

// Récupérer les sous-catégories de la catégorie "particulier"
$child_categories = get_terms(array(
    'taxonomy' => 'category',
    'parent' => $parent_category_id,
    'hide_empty' => false
));

$image_ids = [
    17356, 
    17355
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