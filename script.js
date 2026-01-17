document.addEventListener('DOMContentLoaded', function() {
    // Menu Mobile Toggle
    const mobileBtn = document.querySelector('.mobile-menu-btn');
    const navMenu = document.querySelector('.nav-menu');
    const navLinks = document.querySelectorAll('.nav-menu a');

    if(mobileBtn) {
        mobileBtn.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            const icon = mobileBtn.querySelector('i');
            if(navMenu.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }

    // Fechar menu ao clicar em um link
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if(navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                const icon = mobileBtn.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    });

    // Header Scroll Effect (Opcional - sombra ao rolar)
    const header = document.getElementById('header');
    window.addEventListener('scroll', () => {
        if(window.scrollY > 50) {
            header.style.boxShadow = "0 2px 15px rgba(0,0,0,0.15)";
        } else {
            header.style.boxShadow = "0 2px 10px rgba(0,0,0,0.1)";
        }
    });

    // Form Mask (Telefone) - Simples
    const phoneInput = document.getElementById('telefone');
    if(phoneInput) {
        phoneInput.addEventListener('input', function (e) {
            let x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
            e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
        });
    }

    // Carrossel de Imagens
    const carouselSlide = document.querySelector('.carousel-slide');
    const carouselImages = document.querySelectorAll('.carousel-slide img');
    const prevBtn = document.querySelector('#prevBtn');
    const nextBtn = document.querySelector('#nextBtn');

    if (carouselSlide && carouselImages.length > 0) {
        let counter = 0;
        const size = 100; // Porcentagem de largura

        // Função para mover o carrossel
        function updateCarousel() {
            carouselSlide.style.transform = 'translateX(' + (-size * counter) + '%)';
        }

        // Next Button
        nextBtn.addEventListener('click', () => {
            if (counter >= carouselImages.length - 1) {
                counter = 0; // Volta para o primeiro
            } else {
                counter++;
            }
            updateCarousel();
            resetInterval();
        });

        // Prev Button
        prevBtn.addEventListener('click', () => {
            if (counter <= 0) {
                counter = carouselImages.length - 1; // Vai para o último
            } else {
                counter--;
            }
            updateCarousel();
            resetInterval();
        });

        // Auto Play
        let slideInterval = setInterval(() => {
            nextBtn.click();
        }, 4000);

        function resetInterval() {
            clearInterval(slideInterval);
            slideInterval = setInterval(() => {
                nextBtn.click();
            }, 4000);
        }
    }
});
