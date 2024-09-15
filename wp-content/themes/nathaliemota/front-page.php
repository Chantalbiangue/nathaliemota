<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nathalie_Mota
 */

get_header();
?>
<section class="banner">
	<h1 class="banner__title">Photographe Event</h1>

	<?php

	$args = array(
		'post_type' => 'photos',
		'posts_per_page' => 1,
		'orderby' => 'rand',
	);
	$query = new WP_Query($args);
	$attachments = $query->get_posts();

	foreach ($attachments as $attachment) {
		if ($attachment) {

			// URL de la première image avec les dimensions spécifiées
			$first_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($attachment->ID), array(1400, 966));

			// Vérifie si l'URL de l'image est disponible
			if ($first_image_url) {

				echo '<img src="' . $first_image_url[0] . '" width="' . $first_image_url[1] . '" height="' . $first_image_url[2] . '" alt="Hero Image">';
			}
		}
	?>
	<?php }

	?>
</section>
<main id="primary" class="site-main">
	<div id="content-wrap" class="container">
		<!-- Chargement des filtres -->
		<?php get_template_part('template-parts/photo-filter'); ?>

		<section class="galerie-photos photo">
			<!-- Afficher la galerie -->
			<?php
			$args = array(
				'post_type' => 'photos',
				'posts_per_page' => 8,
				'order' => 'DESC',
				'orderby' => 'date',
				'paged' => 1
			);
			$the_query = new WP_Query($args);

			if ($the_query->have_posts()) {
				echo '<div class="galerie-photos__column">';
				while ($the_query->have_posts()) {
					$the_query->the_post();
			?>
					<!-- Chargement d'une photo à répéter autant de fois que la requete aura fournit un résultat -->
					<?php get_template_part('template-parts/onephoto'); ?>
			<?php
				}
				echo '</div>';
			} else {
				echo "Désolée. Nous n'avons pas d'autres photos dans cette catégorie.";
			}
			wp_reset_postdata();
			?>
		</section>
		<div class="row-btn">
			<button class="js-load-photos photos-load-button" data-url="<?php echo admin_url('admin-ajax.php'); ?>" data-nonce="<?php echo wp_create_nonce('load_photos'); ?>">
				Charger plus
			</button>
			<!-- Message qui apparaît lorsqu'il n'y a plus de photos -->
			<div class="photos-message" style="display:none;"></div>

		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
