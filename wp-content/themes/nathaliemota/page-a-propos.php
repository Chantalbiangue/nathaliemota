<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * Template Name: Page A propos
 * 
 * @package Nathalie_Mota
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while (have_posts()) :
        the_post();
    ?>

        <div id="content-wrap" class="container a-propos">

            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>

        </div>

    <?php endwhile ?>
    </div> <!-- #content-wrap -->
</main><!-- #main -->

<?php

get_footer();
?>