// Pentru a face caruselul să se deplaseze automat
let slideIndex = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;
const slidesToShow = 3;

function showSlides() {
    // Ascundem toate slide-urile
    slides.forEach(slide => {
        slide.style.display = 'none';
    });

    // Afișăm slide-urile în ordine, începând de la slideIndex
    for (let i = slideIndex; i < slideIndex + slidesToShow; i++) {
        let index = i % totalSlides;
        slides[index].style.display = 'block';
    }

    // Incrementăm slideIndex pentru a trece la următorul slide
    slideIndex = (slideIndex + 1) % totalSlides;
}

// Setăm un interval pentru a apela funcția showSlides la fiecare 3 secunde
setInterval(showSlides, 1000);

// Inițializăm caruselul
showSlides();
