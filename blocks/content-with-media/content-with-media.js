(() => {
    const playVideo = (data, target) => {
        let video = '';

        if (typeof data.youtube !== 'undefined') {
			video = '<iframe src="https://www.youtube.com/embed/';
			video += data.youtube + '?autoplay=1';
			if(data.loop) video += '&loop=1';
			video += '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		}else if (typeof data.vimeo !== 'undefined') {
			video = '<iframe src="https://player.vimeo.com/video/';
			video += data.vimeo + '?autoplay=1&byline=0&portrait=0&badge=0';
			if(data.loop) video += '&loop=1';
			if(data.disableInteraction) video += '&background=1';
			video += '"allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>';
		} else if (typeof data.file !== 'undefined') {
			video += '<video autoplay playsinline';
			if(data.loop) video += ' loop';
			if(!data.disableInteraction) video += ' controls';
			video += '>';
			video += '<source src="' + data.file + '" type="' + data.filemime + '">';
			video += '</video>';
		}

        target.innerHTML = video;
    }

    document.querySelectorAll('.content-with-media-video-player-button').forEach((button) => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            playVideo(event.currentTarget.dataset, event.target.closest('.content-with-media-video-player'));
        });
    });

	const autoplayVideos = () => {
		document.querySelectorAll('.content-with-media-video-player-button[data-autoplay="1"]').forEach((button) => {
			const rect = button.getBoundingClientRect();
			const windowHeight = window.innerHeight;
			if (rect.bottom >= 0 && rect.top <= windowHeight) {
				button.click();
			}
		});
	}

	if(document.querySelectorAll('.content-with-media-video-player-button[data-autoplay="1"]').length){
		addEventListener("scroll", () => {
			requestAnimationFrame(autoplayVideos);
		});
		autoplayVideos();
	}

	const autoplayLottie = () => {
		document.querySelectorAll('.content-with-media-lottie:not(.started)').forEach((animation) => {
			const rect = animation.getBoundingClientRect();
			const windowHeight = window.innerHeight;
			if (rect.bottom >= 0 && rect.top <= windowHeight) {
				if(typeof animation.querySelector('lottie-player').play == 'function'){
					animation.querySelector('lottie-player').play();
					animation.classList.add('started');
				}else{
					setTimeout(autoplayLottie, 100);
				}
			}
		});
	}

	if(document.querySelectorAll('.content-with-media-lottie').length){
		var lottieScript = document.createElement('script');
		lottieScript.type = 'text/javascript';
		lottieScript.src = 'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js';
		document.body.appendChild(lottieScript);

		addEventListener("scroll", () => {
			requestAnimationFrame(autoplayLottie);
		});
		autoplayLottie();
	}
})();