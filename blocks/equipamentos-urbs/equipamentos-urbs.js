(() => {
	if (typeof Swiper === "undefined") return false;
	if (!document.querySelectorAll(".equipamentos-item").length) return false;

	document.querySelectorAll(".equipamentos-item").forEach((carousel) => {
		const default_equipamentos_settings = {
			slidesPerView: 1,
			simulateTouch: true,
			navigation: {
				nextEl: carousel.querySelector(".equipamentos-urbs-navigation-next"),
				prevEl: carousel.querySelector(".equipamentos-urbs-navigation-prev"),
			},
			pagination: {
				el: carousel.querySelector(".equipamentos-urbs-pagination"),
				type: "bullets",
				clickable: true,
			},
			breakpoints: {
				768: {
					slidesPerView: "auto",
					spaceBetween: 20,
				},
			},
		};

		if (carousel.dataset.autoplay) {
			default_equipamentos_settings.autoplay = {
				delay: carousel.dataset.autoplayTimeout
					? carousel.dataset.autoplayTimeout * 1000
					: 3000,
			};
		}

		if (carousel.dataset.loop) {
			default_equipamentos_settings.loop = true;
		}

		const custom_carousel_settings = carousel.dataset.settings
			? JSON.parse(carousel.dataset.settings)
			: {};
		const settings = Object.assign(
			default_equipamentos_settings,
			custom_carousel_settings
		);

		new Swiper(carousel, settings);
	});
})();
