<?php

/**
 * Nathalie Mota functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nathalie_Mota
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nathalie_mota_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Nathalie Mota, use a find and replace
		* to change 'nathalie-mota' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('nathalie-mota', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Principal', 'nathalie-mota'),
			'menu-2' => esc_html__('Pied de Page', 'nathalie-mota'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'nathalie_mota_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'nathalie_mota_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nathalie_mota_content_width()
{
	$GLOBALS['content_width'] = apply_filters('nathalie_mota_content_width', 640);
}
add_action('after_setup_theme', 'nathalie_mota_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nathalie_mota_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'nathalie-mota'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'nathalie-mota'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'nathalie_mota_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function nathalie_mota_scripts()
{
	wp_enqueue_style('nathalie-mota-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('nathalie-mota-style', 'rtl', 'replace');

	wp_enqueue_script('nathalie-mota-main', get_template_directory_uri() . '/js/main.js', array("jquery"), _S_VERSION, true);
	wp_enqueue_script('nathalie-mota-filters', get_template_directory_uri() . '/js/filters.js', array("jquery"), _S_VERSION, true);
	wp_enqueue_script('nathalie-mota-navigation', get_template_directory_uri() . '/js/navigation.js', array("jquery"), _S_VERSION, true);
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'nathalie_mota_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

function filter_photos()
{
	// Récupérer les paramètres de filtrage et de tri
	$categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';
	$format = isset($_POST['format']) ? $_POST['format'] : '';
	$order = isset($_POST['order']) ? $_POST['order'] : 'date';

	// Construire les arguments pour WP_Query en fonction des paramètres de filtrage et de tri
	$args = array(
		'post_type' => 'photos',
		'posts_per_page' => 8,
		'orderby' => 'date',
		'order' => 'DESC'
	);
	// Ajouter les conditions de filtrage si une catégorie est sélectionnée
	if (!empty($categorie)) {
		if ($args['tax_query']) {
			array_push(
				$args['tax_query'],
				array(
					'taxonomy' => 'categorie',
					'field' => 'id',
					'terms' => $categorie

				)
			);
		} else {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'categorie',
					'field' => 'id',
					'terms' => $categorie
				)
			);
		}
	}

	// Ajouter les conditions de filtrage si un format est sélectionné 
	if (!empty($format)) {
		if ($args['tax_query']) {
			array_push(
				$args['tax_query'],
				array(
					'taxonomy' => 'formats',
					'field' => 'id',
					'terms' => $format

				)
			);
		} else {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'formats',
					'field' => 'id',
					'terms' => $format
				)
			);
		}
	}
	// Modifier les arguments de tri si nécessaire
	if ($order == 'asc') {
		$args['order'] = 'ASC';
	}

	// Exécuter la requête WP_Query
	$query = new WP_Query($args);

	// Construire le HTML des résultats
	$resultats_html = '';
	if ($query->have_posts()) {
		$resultats_html .= '<div class="galerie-photos__column">';

		while ($query->have_posts()) {
			$query->the_post();
			// Ajouter le code HTML pour afficher chaque photo
			$resultats_html .= '<div class="galerie-photos__single">';
			$resultats_html .= '<a href="' . esc_url(wp_get_attachment_url(get_post_thumbnail_id())) . '" class="lightbox-trigger photo-link">';
			$resultats_html .= get_the_post_thumbnail(get_the_ID(), 'single');
			$resultats_html .= '</a>';
			$resultats_html .= '<div class="single__overlay">';
			$resultats_html .= '<span>';
			$resultats_html .= '<img class="single__overlay-fullscreen" src="' . get_template_directory_uri() . '/assets/images/icon_fullscreen.png" alt="Icône plein écran" />';
			$resultats_html .= '</span>';
			$resultats_html .= '<span class="single__overlay-eye">';
			$resultats_html .= '<a href="' . get_post_permalink() . '">';
			$resultats_html .= '<img src="' . get_template_directory_uri() . '/assets/images/icon_eye.png" alt="Icône oeil ouvert" />';
			$resultats_html .= '</a>';
			$resultats_html .= '</span>';
			$resultats_html .= '<div class="single__caption">';
			$resultats_html .= '<span class="single__overlay-title">' . get_the_title() . '</span>';
			$resultats_html .= '<span class="single__overlay-categorie">' . strip_tags(get_the_term_list(get_the_ID(), 'categorie')) . '</span>';
			$resultats_html .= '</div>';

			$resultats_html .= '</div>';
			$resultats_html .= '</div>';
			$resultats_html .= '<script>Lightbox.init()</script>';
		}
		$resultats_html .= '</div>';
	} else {
		$resultats_html = '<p>Aucune photo trouvée.</p>';
	}

	// Réinitialiser la requête WP_Query
	wp_reset_postdata();

	// Renvoyer les résultats au format JSON
	wp_send_json($resultats_html);
}
add_action("wp_ajax_filter_photos", "filter_photos");
add_action("wp_ajax_nopriv_filter_photos", "filter_photos");


function load_photos()
{
	// Vérification de sécurité
	if (!isset($_REQUEST['nonce']) or !wp_verify_nonce($_REQUEST['nonce'], 'load_photos')) {
		wp_send_json_error("Vous n’avez pas l’autorisation d’effectuer cette action.", 403);
	}

	// On vérifie que le numéro de page a bien été envoyé
	if (!isset($_POST['paged'])) {
		wp_send_json_error("Le paramètre 'paged' est manquant.", 400);
	}

	$paged = intval($_POST['paged']);
	// Requête pour récupérer les photos
	$args = array(
		'post_type' => 'photos',
		'posts_per_page' => 8,
		'paged' => $paged,
		'order' => 'DESC',
		'orderby' => 'date'
	);

	$query = new WP_Query($args);
	
	// Construire le HTML des résultats
	$resultats_html = '';
	if ($query->have_posts()) {
		$resultats_html .= '<div class="galerie-photos__column">';

		while ($query->have_posts()) {
			$query->the_post();
			// Ajouter le code HTML pour afficher chaque photo
			$resultats_html .= '<div class="galerie-photos__single">';
			$resultats_html .= '<a href="' . esc_url(wp_get_attachment_url(get_post_thumbnail_id())) . '" class="lightbox-trigger photo-link">';
			$resultats_html .= get_the_post_thumbnail(get_the_ID(), 'single');
			$resultats_html .= '</a>';
			$resultats_html .= '<div class="single__overlay">';
			$resultats_html .= '<span>';
			$resultats_html .= '<img class="single__overlay-fullscreen" src="' . get_template_directory_uri() . '/assets/images/icon_fullscreen.png" alt="Icône plein écran" />';
			$resultats_html .= '</span>';
			$resultats_html .= '<span class="single__overlay-eye">';
			$resultats_html .= '<a href="' . get_post_permalink() . '">';
			$resultats_html .= '<img src="' . get_template_directory_uri() . '/assets/images/icon_eye.png" alt="Icône oeil ouvert" />';
			$resultats_html .= '</a>';
			$resultats_html .= '</span>';
			$resultats_html .= '<div class="single__caption">';
			$resultats_html .= '<span class="single__overlay-title">' . get_the_title() . '</span>';
			$resultats_html .= '<span class="single__overlay-categorie">' . strip_tags(get_the_term_list(get_the_ID(), 'categorie')) . '</span>';
			$resultats_html .= '</div>';

			$resultats_html .= '</div>';
			$resultats_html .= '</div>';
			$resultats_html .= '<script>Lightbox.init()</script>';
		}
		$resultats_html .= '</div>';
	} else {
		$resultats_html = '<p>Aucune photo trouvée.</p>';
	}
	// Réinitialiser la requête WP_Query
	wp_reset_postdata();

	// Renvoyer les résultats au format JSON
	wp_send_json_success($resultats_html);
}

add_action("wp_ajax_load_photos", "load_photos");
add_action("wp_ajax_nopriv_load_photos", "load_photos");
