function slidesPlugin() {
    const slides = document.querySelectorAll('.myslide');

    for (const slide of slides) {
        slide.addEventListener('click', () => {
            if (slide.classList.contains('active')) {
                slide.classList.remove('active');
            } else {
                clearActiveClasses();
                slide.classList.add('active');
            }
        });
    }

    function clearActiveClasses() {
        slides.forEach((slide) => {
            slide.classList.remove('active');
        });
    }
}

function slidesComment() {
    const slides = document.querySelectorAll('.myslideComment');

    for (const slide of slides) {
        slide.addEventListener('click', () => {
            if (slide.classList.contains('active')) {
                slide.classList.remove('active');
            } else {
                clearActiveClasses();
                slide.classList.add('active');
            }
        });
    }

    function clearActiveClasses() {
        slides.forEach((slide) => {
            slide.classList.remove('active');
        });
    }
}

slidesPlugin();
slidesComment();
