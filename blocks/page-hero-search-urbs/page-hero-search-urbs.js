(() => {
  if (typeof Swiper === "undefined") return false;
  if (!document.querySelectorAll(".page-hero-search-urbs-swiper").length)
    return false;

  document
    .querySelectorAll(".page-hero-search-urbs-swiper")
    .forEach((carousel) => {
      const default_carousel_settings = {
        slidesPerView: 1,
        loop: true,
        effect: "fade",
        autoplay: {
          delay: 3500,
        },
        simulateTouch: false,
        navigation: {
          nextEl: carousel.querySelector(
            ".page-hero-search-urbs-navigation-next"
          ),
          prevEl: carousel.querySelector(
            ".page-hero-search-urbs-navigation-prev"
          ),
        },
      };

      const custom_carousel_settings = carousel.dataset.settings
        ? JSON.parse(carousel.dataset.settings)
        : {};
      const carousel_settings = Object.assign(
        default_carousel_settings,
        custom_carousel_settings
      );

      new Swiper(carousel, carousel_settings);
    });
})();
