function showModal() {
    document.getElementById("modal").style.display = "block";
}

function closeModal() {
    document.getElementById("modal").style.display = "none";
}
let currentSlideIndex = 0;

// Abre el carrusel y muestra la imagen correspondiente
function openCarousel(index) {
    currentSlideIndex = index;
    showCarouselSlide();
    document.getElementById("carouselModal").style.display = "block";
}

// Cierra el carrusel
function closeCarousel() {
    document.getElementById("carouselModal").style.display = "none";
}

// Cambiar entre las imágenes del carrusel
function changeSlide(step) {
    currentSlideIndex += step;
    if (currentSlideIndex >= document.querySelectorAll('.carousel-slide').length) {
        currentSlideIndex = 0;
    } else if (currentSlideIndex < 0) {
        currentSlideIndex = document.querySelectorAll('.carousel-slide').length - 1;
    }
    showCarouselSlide();
}

// Muestra la imagen activa en el carrusel
function showCarouselSlide() {
    let slides = document.querySelectorAll('.carousel-slide');
    slides.forEach((slide, index) => {
        slide.style.display = (index === currentSlideIndex) ? 'block' : 'none';
    });
}

