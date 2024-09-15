$(".popup-overlay").hide();
$(".contact-btn").click(function(){
    $(".popup-overlay").show();
});
$('.popup-close').click(function(){
	$(".popup-overlay").hide();
})
/* Bouton btn page Single photo - Fonction pour la référence de la photo dans le formulaire de contact */
const single_contact_btns = document.querySelectorAll (".bandeau-cta__btn");

single_contact_btns.forEach((single_contact_btn) => {
    single_contact_btn.addEventListener("click", () => {
        $(".popup-overlay").show();
        const reference = document.querySelector(".reference_value").innerHTML;
        const modal_ref_input = document.getElementById("ref-photo");
        modal_ref_input.value = reference;
    });
});

/* Affichage menu mobile à partir du format tablette */
document.addEventListener('DOMContentLoaded', function () {
    let burgerMenu = document.getElementById('burger-menu');
    let overlay = document.getElementById('menu-mobile');
    
    burgerMenu.addEventListener('click', function () {
        this.classList.toggle("close");
        overlay.classList.toggle("overlay");
        console.log("burgerMenu classes: ", this.classList);
        console.log("overlay classes: ", overlay.classList);
    });
});