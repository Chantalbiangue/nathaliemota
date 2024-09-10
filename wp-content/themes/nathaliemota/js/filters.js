console.log("script de filtre demarrer");
document.addEventListener("DOMContentLoaded", function () {
  /* Activation des filtres photos de la page d'acceuil */
  (function ($) {
    $(document).ready(function () {
      // Gestion des changements dans les sélecteurs
      $(".form-select").change(function () {
        var categorie = $("#categorie_id").val();
        var format = $("#format_id").val();
        var order = $("#date").val();
        // Envoyer une requête AJAX pour récupérer les photos filtrées et triées
        const nonce = $("#nonce").val();
        const ajaxurl = $("#ajaxurl").val();

        // Données à envoyer via AJAX
        var ajaxData = {
          action: "filter_photos",
          nonce: nonce,
          categorie: categorie,
          format: format,
          order: order,
        };
        $.ajax({
          url: ajaxurl,
          type: "post",
          datatype: "html",
          data: ajaxData,
          success: function (response) {
            // Mettre à jour le contenu de la galerie avec les nouveaux résultats
            $(".galerie-photos").html(response);
          },
          error: function (xhr, status, error) {},
        });
      });


      // debut du button load more
      let paged = 2;

      // Chargement des photos en Ajax
      $(".js-load-photos").on("click", function (e) {
        e.preventDefault();

        const ajaxurl = $(this).data("url");
        const nonce = $(this).data("nonce");

        const data = {
          action: "load_photos",
          nonce: nonce,
          paged: paged,
        };
        console.log("Envoi de la requête AJAX avec les données :", data);

        // Cacher le message au début de chaque requête
        $(".photos-message").hide();

        $.post(ajaxurl, data, function (response) {
          if (response.success) {
            console.log("on a bien un resultat")
            $(".galerie-photos__column").append(response.data);
            paged++;
          } else {
            $(".photos-message").text(response.data).show();
            // Délai pour cacher le message après 10 secondes
            setTimeout(function () {
              $(".photos-message").fadeOut("slow");
            }, 10000);

            if (response.data === "Il n'y a plus de photos à charger.") {
              $(".js-load-photos").hide();
            }
          }
        });
      });
    });
  })(jQuery);
});
