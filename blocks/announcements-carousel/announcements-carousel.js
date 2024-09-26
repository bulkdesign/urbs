(() => {
    if (typeof Swiper === 'undefined') return false;
    if (!document.querySelectorAll('.announcements-carousel-swiper').length) return false;

    document.querySelectorAll('.announcements-carousel-swiper').forEach((carousel) => {
        const default_carousel_settings = {
            slidesPerView: 1,
            loop: true,
            navigation: {
                nextEl: carousel.querySelector('.announcements-carousel-navigation-next'),
                prevEl: carousel.querySelector('.announcements-carousel-navigation-prev')
            },  
            pagination: {
                el: carousel.querySelector('.announcements-carousel-pagination'),
                type: 'bullets',
            },
        };

        if(carousel.dataset.autoplay){
            default_carousel_settings.autoplay = {
                delay: (carousel.dataset.autoplayTimeout) ? carousel.dataset.autoplayTimeout * 1000 : 3000,
            }
        }

        if(carousel.dataset.startOnNext){
            default_carousel_settings.initialSlide = select_first_slide(carousel);
        }

        const custom_carousel_settings = carousel.dataset.settings ? JSON.parse(carousel.dataset.settings) : {};
        const carousel_settings = Object.assign(default_carousel_settings, custom_carousel_settings);

        new Swiper(carousel, carousel_settings);
    });
})();