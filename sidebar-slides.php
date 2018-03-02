<?php
/**
 * The sidebar containing the widget areas for the presentation slides
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPresent
 */

if ( ! is_active_sidebar( 'slides' ) ) {
	return;
}
?>

<section id="slides" class="widget-area slides">
	<?php dynamic_sidebar( 'slides' ); ?>
</section><!-- #slides -->
