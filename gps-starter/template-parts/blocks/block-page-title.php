<?php
/**
 * Page Title Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @author Patrick Jackson <pjackson@goldenpathsolutions.com>
 * @link https://www.advancedcustomfields.com/resources/blocks/
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'pdf-infoblock-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block block--page-title';
if ( ! empty( $block['className'] ) ) {
	$className .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$title            = get_field( 'page_title' );
$introduction     = get_field( 'introduction' );
$image            = get_field( 'hero_image' );
$is_add_to_header = get_field( 'include_with_header' );

?>
<div id="<?= esc_attr( $id ); ?>" class="<?= esc_attr( $className ); ?> <?= $image ? 'has-image' : '' ?>"
     style="background-image: url('<?= $image['sizes']['bg-width-2x'] ?>');">
    <h1 class="block--page-title__title"><?= $title ?></h1>
    <div class="block--page-title__introduction"><?= $introduction ?></div>
</div>