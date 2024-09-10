class Lightbox {
    static init() {
        const links = Array.from(document.querySelectorAll('.single__overlay-fullscreen'));
        const gallery = links.map(link => link.closest('.galerie-photos__single').querySelector('a.lightbox-trigger').getAttribute('href'));
        links.forEach(link => link.addEventListener('click', e => {
            console.log("Click fullscreen");
            e.preventDefault();
            const imageLink = link.closest('.galerie-photos__single').querySelector('a.lightbox-trigger').getAttribute('href');
            new Lightbox(imageLink, gallery);
        }));
    }

    constructor(url, images) {
        this.element = this.buildDOM();
        this.images = images;
        this.loadImage(url);
        this.onKeyUp = this.onKeyUp.bind(this);
        document.body.appendChild(this.element);
        disableBodyScroll(this.element);
        document.addEventListener('keyup', this.onKeyUp);
    }

    loadImage(url) {
        this.url = url;
        const image = new Image();
        const container = this.element.querySelector('.lightbox__container');
        const loader = document.createElement('div');
        loader.classList.add('lightbox__loader');
        container.innerHTML = '';
        container.appendChild(loader);
        image.onload = () => {
            container.removeChild(loader);
            container.appendChild(image);
            this.url = url;
        };
        image.src = url;
    }

    onKeyUp(e) {
        if (e.key === 'Escape') {
            this.close(e);
        } else if (e.key === 'ArrowLeft') {
            this.prev(e);
        } else if (e.key === 'ArrowRight') {
            this.next(e);
        }
    }

    close(e) {
        e.preventDefault();
        this.element.classList.add('fadeOut');
        location.reload();
        enableBodyScroll(this.element);
        window.setTimeout(() => {
            this.element.parentElement.removeChild(this.element);
        }, 500);
        document.removeEventListener('keyup', this.onKeyUp);
    }

    next(e) {
        e.preventDefault();
        let i = this.images.findIndex(image => image === this.url);
        if (i === this.images.length - 1) {
            i = -1;
        }
        this.loadImage(this.images[i + 1]);
    }

    prev(e) {
        e.preventDefault();
        let i = this.images.findIndex(image => image === this.url);
        if (i === 0) {
            i = this.images.length;
        }
        this.loadImage(this.images[i - 1]);
    }

    buildDOM() {
        const dom = document.createElement('div');
        dom.classList.add('lightbox');
        dom.innerHTML = `
            <button class="lightbox__close"></button>
            <button class="lightbox__next">Suivant</button>
            <button class="lightbox__prev">Précédent</button>
            <div class="lightbox__container"></div>
            <div class="lightbox__overlay"></div>
        `;
        dom.querySelector('.lightbox__close').addEventListener('click', this.close.bind(this));
        dom.querySelector('.lightbox__next').addEventListener('click', this.next.bind(this));
        dom.querySelector('.lightbox__prev').addEventListener('click', this.prev.bind(this));
        return dom;
    }
}
console.log("lightbox")
document.addEventListener('DOMContentLoaded', () => Lightbox.init());