class Lightbox {
    // Méthode statique qui initialise la lightbox
    static init() {
        // Sélectionne tous les éléments ayant la classe 'single__overlay-fullscreen'
        const links = Array.from(document.querySelectorAll('.single__overlay-fullscreen'));
        // Récupère les URL des images dans la galerie
        const gallery = links.map(link => link.closest('.galerie-photos__single').querySelector('a.lightbox-trigger').getAttribute('href'));
        // Ajoute un écouteur d'événement pour chaque lien (ouverture en plein écran)
        links.forEach(link => link.addEventListener('click', e => {
            console.log("Click fullscreen");
            e.preventDefault();  // Empêche le comportement par défaut du lien
            const imageLink = link.closest('.galerie-photos__single').querySelector('a.lightbox-trigger').getAttribute('href');
            // Crée une nouvelle instance de la lightbox avec l'image cliquée et la galerie
            new Lightbox(imageLink, gallery);
        }));
    }

    // Constructeur de la lightbox qui prend une URL et une liste d'images
    constructor(url, images) {
        // Construit le DOM pour la lightbox
        this.element = this.buildDOM();
        this.images = images; // Stocke la liste d'images
        this.loadImage(url); // Charge l'image sélectionnée
        this.onKeyUp = this.onKeyUp.bind(this); // Liaison du contexte pour la gestion des touches
        document.body.appendChild(this.element); // Ajoute la lightbox au DOM
        disableBodyScroll(this.element); // Désactive le scroll de la page quand la lightbox est ouverte
        document.addEventListener('keyup', this.onKeyUp); // Écoute des événements clavier
    }

    // Charge l'image dans la lightbox
    loadImage(url) {
        this.url = url;  // Stocke l'URL actuelle
        const image = new Image();  // Crée un nouvel élément image
        const container = this.element.querySelector('.lightbox__container');
        const loader = document.createElement('div'); // Crée un élément de chargement (loader)
        loader.classList.add('lightbox__loader');  // Ajoute une classe au loader
        container.innerHTML = '';  // Vide le conteneur
        container.appendChild(loader);  // Affiche le loader
        image.onload = () => {
            container.removeChild(loader);  // Enlève le loader une fois l'image chargée
            container.appendChild(image);  // Ajoute l'image dans la lightbox
            this.url = url;  // Met à jour l'URL actuelle
        };
        image.src = url;  // Définit l'URL de l'image à charger
    }

    // Gestion des événements clavier
    onKeyUp(e) {
        if (e.key === 'Escape') {  // Fermer la lightbox avec la touche 'Escape'
            this.close(e);
        } else if (e.key === 'ArrowLeft') {  // Image précédente avec la flèche gauche
            this.prev(e);
        } else if (e.key === 'ArrowRight') {  // Image suivante avec la flèche droite
            this.next(e);
        }
    }

    // Ferme la lightbox
    close(e) {
        e.preventDefault();  // Empêche l'action par défaut
        this.element.classList.add('fadeOut');  // Ajoute une classe pour l'effet de sortie
        location.reload();  // Recharge la page (pas toujours recommandé mais utilisé ici)
        enableBodyScroll(this.element);  // Réactive le scroll de la page
        window.setTimeout(() => {
            this.element.parentElement.removeChild(this.element);  // Supprime la lightbox du DOM
        }, 500);  // Attente de 500 ms avant de supprimer la lightbox
        document.removeEventListener('keyup', this.onKeyUp);  // Supprime l'écoute des touches
    }

    // Passe à l'image suivante dans la galerie
    next(e) {
        e.preventDefault();  // Empêche l'action par défaut
        let i = this.images.findIndex(image => image === this.url);  // Trouve l'index de l'image actuelle
        if (i === this.images.length - 1) {  // Si c'est la dernière image, revenir au début
            i = -1;
        }
        this.loadImage(this.images[i + 1]);  // Charge l'image suivante
    }

    // Passe à l'image précédente dans la galerie
    prev(e) {
        e.preventDefault();  // Empêche l'action par défaut
        let i = this.images.findIndex(image => image === this.url);  // Trouve l'index de l'image actuelle
        if (i === 0) {  // Si c'est la première image, aller à la dernière
            i = this.images.length;
        }
        this.loadImage(this.images[i - 1]);  // Charge l'image précédente
    }

    // Construit le DOM de la lightbox
    buildDOM() {
        const dom = document.createElement('div');  // Crée un élément div pour la lightbox
        dom.classList.add('lightbox');  // Ajoute la classe 'lightbox'
        dom.innerHTML = `
            <button class="lightbox__close"></button>  <!-- Bouton de fermeture -->
            <button class="lightbox__next">Suivant</button>  <!-- Bouton suivant -->
            <button class="lightbox__prev">Précédent</button>  <!-- Bouton précédent -->
            <div class="lightbox__container"></div>  <!-- Conteneur pour l'image -->
            <div class="lightbox__overlay"></div>  <!-- Overlay derrière la lightbox -->
        `;
        // Ajoute les écouteurs d'événements pour les boutons
        dom.querySelector('.lightbox__close').addEventListener('click', this.close.bind(this));
        dom.querySelector('.lightbox__next').addEventListener('click', this.next.bind(this));
        dom.querySelector('.lightbox__prev').addEventListener('click', this.prev.bind(this));
        return dom;  // Retourne l'élément construit
    }
}

// Initialisation de la lightbox une fois le DOM chargé
console.log("lightbox");
document.addEventListener('DOMContentLoaded', () => Lightbox.init());
