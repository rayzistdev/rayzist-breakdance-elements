<?php

global $wp_query;

$placeholder_img_url = wc_placeholder_img_src();

$categories = [];
$excluded_categories = apply_filters('rayz_excluded_categories', array()) ?? [];

if (is_shop()) {
    $excluded_cat = get_term_by('slug', 'uncat', 'product_cat');
    $uncategorized_term_id = get_option( 'default_product_cat' );

    $categories = get_terms([
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'parent' => 0,
        'exclude' => [$uncategorized_term_id, ...$excluded_categories],
    ]);
} else {
    $parent_cat = $wp_query->get_queried_object();
    $categories = get_terms([
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'parent' => $parent_cat->term_id,
        'exclude' => $excluded_categories,
    ]);
}

ob_start();
?>
<?php foreach ($categories as $category) : ?>
    <?php
    // Get the thumbnail ID
    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
    // Get the image URL
    $image_url = wp_get_attachment_url($thumbnail_id) ? wp_get_attachment_url($thumbnail_id) : $placeholder_img_url;
    $category_link = get_term_link($category);
    ?>
    <a class="rayz_cat_block" href="<?php echo esc_url($category_link); ?>">
        <h2><?php echo $category->name; ?></h2>
        <div class="rayz_img-container">
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo $category->name; ?> thumbnail">
        </div>
    </a>

<?php endforeach; ?>
<?php

echo ob_get_clean();
