<div class="filter-area swiper-container">
    <form class="form-select flexrow swiper-wrapper" method="post">
        <input type="hidden" name="nonce" id='nonce' value="<?php echo wp_create_nonce('nathalie_mota_nonce'); ?>">
        <input type="hidden" name="ajaxurl" id='ajaxurl' value="<?php echo admin_url('admin-ajax.php'); ?>">
        <!--  -->
        <!-- $terms->term_id :  -->
        <!-- $terms->taxonomy : nom de la taxonomie -->
        <!-- $terms->name : nom de l'élément de la taxonomie -->
        <!-- $terms->term_taxonomy_id : n° de l'élément de la taxonomie -->
        <div class="filterleft swiper-slide flexrow">
            <div id="filtre-categorie" class="select-filter flexcolumn">
                <span class="categorie_id-down dashicons dashicons-arrow-down select-close"></span>
                <label for="categorie_id">
                    <p>catégories</p>
                </label>
                <select class="option-filter" name="categorie_id" id="categorie_id">
                    <!-- Génération automatique de la liste des catégories en fonction de ce qu'il y a dans WP -->
                    <option id="categorie_0" value=""></option>
                    <?php
                    $categorie_acf = get_terms('categorie', array('hide_empty' => false));
                    foreach ($categorie_acf as $terms) :
                    ?>
                        <?php if ($terms->term_taxonomy_id == $categorie_id): ?>
                            <option id="categorie_<?php echo $terms->term_taxonomy_id; ?>" value="<?php echo $terms->term_taxonomy_id; ?>" selected><?php echo $terms->name; ?></option>
                        <?php else : ?>
                            <option id="categorie_<?php echo $terms->term_taxonomy_id; ?>" value="<?php echo $terms->term_taxonomy_id; ?>"><?php echo $terms->name; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div id="filtre-format" class="select-filter flexcolumn">
                <span class="format_id-down dashicons dashicons-arrow-down select-close"></span>
                <label for="format_id">
                    <p>formats</p>
                </label>
                <select class="option-filter" name="format_id" id="format_id">
                    <!-- Génération automatique de la liste des formats en fonction de ce qu'il y a dans WP -->
                    <option id="format_0" value=""></option>
                    <?php
                    $format_acf = get_terms('formats', array('hide_empty' => false));
                    foreach ($format_acf as $terms) :
                    ?>
                        <?php if ($terms->term_taxonomy_id == $format_id): ?>
                            <option id="format_<?php echo $terms->term_taxonomy_id; ?>" value="<?php echo $terms->term_taxonomy_id; ?>" selected><?php echo $terms->name; ?></option>
                        <?php else : ?>
                            <option id="format_<?php echo $terms->term_taxonomy_id; ?>" value="<?php echo $terms->term_taxonomy_id; ?>"><?php echo $terms->name; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="filterright swiper-slide flexrow">
            <div id="filtre-date" class="select-filter flexcolumn">
                <span class="date-down dashicons dashicons-arrow-down select-close"></span>
                <label for="date">
                    <p>trier par</p>
                </label>
                <select class="option-filter" name="date" id="date">
                    <option value=""></option>
                    <option value="desc" <?php if ($order === "desc"): ?>selected<?php endif; ?>>nouveauté</option>
                    <option value="asc" <?php if ($order === "asc"): ?>selected<?php endif; ?>>Les plus anciens</option>
                </select>
            </div>
        </div>
    </form>
</div>