<section class="bloc-recommandation">
        <h2>Vous aimerez aussi</h2>

        <?php
        $post_terms = wp_get_object_terms($post->ID, 'categorie', array('fields' => 'ids'));
        $args = array(
            'post_type' => 'photos',
            'post__not_in' => array($post->ID),
            'posts_per_page' => 2,
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'id',
                    'terms' => $post_terms,
                )
            )
        );
        $the_query = new WP_Query($args);

        if ($the_query->have_posts()) {
            echo '<div class="bloc-recommandations__photos">';
            while ($the_query->have_posts()) {
                $the_query->the_post();
        ?>
                <div class="recommandations_photo">
                    <?php the_post_thumbnail(array(564, 495)); ?>
                </div>
        <?php
            }
            echo '</div>';
        } else {
            echo ("Désolée. Nous n'avons pas d'autres photos dans cette catégorie.");
        }
        wp_reset_postdata();
        ?>
    </section>