(() => {
    if (typeof Swiper === 'undefined') return false;
    if (!document.querySelectorAll('.page-hero-carousel-urbs-urbs-swiper').length) return false;

    const get_last_slide = (carousel_id) => {
        let storage = localStorage.getItem('page_hero_carousel_first_slide');
        let slide = null;

        if(storage){
            storage = JSON.parse(storage);

            storage.forEach( (carousel) => {
                if(carousel.id == carousel_id){
                    slide = carousel.slide;
                }
            });
        }
        
        return slide;
    }

    const clean_last_slide = () => {
        let storage = localStorage.getItem('page_hero_carousel_first_slide');

        if(storage){
            storage = JSON.parse(storage);
            storage = storage.filter((carousel) => carousel.time > (Date.now() - 2592000000)); // 30 Days
            localStorage.setItem('page_hero_carousel_first_slide', JSON.stringify(storage));
        }
    }
    
    const update_last_slide = (carousel_id, slide_number) => {
        let storage = localStorage.getItem('page_hero_carousel_first_slide');
        let updated = false;

        if(storage === null){
            storage = [];
        }else{
            storage = JSON.parse(storage);
            storage.forEach( (carousel) => {
                if(carousel.id == carousel_id){
                    carousel.slide = slide_number;
                    carousel.time = Date.now();
                    updated = true;
                }
            });
        }

        if(!updated){
            storage.push({
                id: carousel_id,
                slide: slide_number,
                time: Date.now(),
            });
        }

        localStorage.setItem('page_hero_carousel_first_slide', JSON.stringify(storage));
    }

    const select_first_slide = (carousel) => {
        const carousel_id = carousel.closest('.page-hero-carousel-urbs').id;
        const last_slide = get_last_slide(carousel_id);
        const total_slides = carousel.querySelectorAll('.swiper-slide').length;
        let next_slide = 0;

        if(last_slide !== null){
            next_slide = last_slide + 1;
            if(next_slide >= total_slides){
                next_slide = 0;
            }
        }

        update_last_slide(carousel_id, next_slide);
        clean_last_slide();
        
        return next_slide;
    }

    document.querySelectorAll('.page-hero-carousel-urbs-swiper').forEach((carousel) => {
        const default_carousel_settings = {
            slidesPerView: 1,
            loop: true,
            simulateTouch: false,
            navigation: {
                nextEl: carousel.querySelector('.page-hero-carousel-urbs-navigation-next'),
                prevEl: carousel.querySelector('.page-hero-carousel-urbs-navigation-prev')
            },  
            pagination: {
                el: carousel.querySelector('.page-hero-carousel-urbs-pagination'),
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