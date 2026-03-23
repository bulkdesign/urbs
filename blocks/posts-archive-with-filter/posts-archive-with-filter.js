(() => {
    const breakpoint = 768;

    if(!document.querySelectorAll('.posts-archive-with-filter').length) return;

    const initial_url = window.location.href.replaceAll('%5B', '[').replaceAll('%5D', ']').replace(/ *\[[^\]]*]=/g, '[]=');
    const initial_form_data = new FormData(document.querySelector('.posts-archive-with-filter').querySelector('form'));
    const initial_form_params = new URLSearchParams(initial_form_data);

	let lastURLToFetch = null;
    const load_content = (url, scroll = true) => {
        document.querySelector('.posts-archive-with-filter-content-inner').style.display = 'none';
        document.querySelector('.posts-archive-with-filter-content-loading').style.display = 'block';
        
		lastURLToFetch = url;
        fetch(url)
            .then(function(response) {
                return response.text();
            })
            .then(function(response) {
				if (lastURLToFetch !== url) return;

                const parser = new DOMParser();
                const response_document = parser.parseFromString(response, 'text/html');
                document.querySelector('.posts-archive-with-filter-content-inner').innerHTML = response_document.querySelector('.posts-archive-with-filter-content-inner').innerHTML;
                document.querySelector('.posts-archive-with-filter-content-inner').style.display = 'block';
                document.querySelector('.posts-archive-with-filter-content-loading').style.display = 'none';

                if(scroll){
                    let distance_from_top = window.scrollY + document.querySelector('.posts-archive-with-filter').getBoundingClientRect().top - 100;
                    if(document.querySelector('#wpadminbar')){
                        distance_from_top -= document.querySelector('#wpadminbar').offsetHeight;
                    }

                    window.scrollTo({
                        top: distance_from_top,
                        behavior: 'smooth',
                    });
                }
            });
    }

    const input_reset = (form) => {
        form.querySelectorAll(':is(input:not([type="radio"], [type="checkbox"]))').forEach((input) => {
            input.value = '';
        });
        form.querySelectorAll('input:is([type="radio"], [type="checkbox"])').forEach((input) => {
            input.checked = false;
        });
        form.querySelectorAll('select option').forEach((option) => {
            option.selected = false;
        });
    }

    const display_or_hide_clear_all = (form) => {
        form.querySelectorAll('.posts-archive-with-filter-filters-group').forEach((group) => {
            const element = group.querySelector('.posts-archive-with-filter-filters-group-clear');
            element.classList.remove('visible');
            element.setAttribute('disabled', '');
            element.setAttribute('tabindex', '-1');
            element.setAttribute('aria-hidden', 'true');
        });

        const form_data = new FormData(form);
        
        for(const [key, value] of form_data.entries()){
            if(form.querySelector('[name="' + key + '"]').closest('.posts-archive-with-filter-filters-group')){
                const element = form.querySelector('[name="' + key + '"]').closest('.posts-archive-with-filter-filters-group').querySelector('.posts-archive-with-filter-filters-group-clear');
                element.classList.add('visible');
                element.removeAttribute('disabled');
                element.setAttribute('tabindex', '0');
                element.setAttribute('aria-hidden', 'false');
            }
        }
    }

    const process_form = (event) => {
        event.preventDefault();

        const form = event.target.closest('form');
        const form_data = new FormData(form);
        const cleaned_url = window.location.href.replaceAll('%5B', '[').replaceAll('%5D', ']').replace(/ *\[[^\]]*]=/g, '[]=');
		let url = new URL(cleaned_url);

        form.querySelectorAll('[name]').forEach((element) => {
            const name = element.attributes.name.value;
            url.searchParams.delete(name);
        });

        for(const entry of form_data.entries()){
            if(entry[0].includes('[]')){
                url.searchParams.append(entry[0], entry[1]);
            }else{
                let arg_value = url.searchParams.get(entry[0]);
                if(arg_value){
                    arg_value += ',' + entry[1];
                    url.searchParams.set(entry[0], arg_value);
                }else{
                    url.searchParams.set(entry[0], entry[1]);
                }
            }
        }

        const final_url = url.toString();

		history.pushState(null, null, final_url);
        display_or_hide_clear_all(form);
        load_content(final_url);
    }

    const set_filters = () => {
        const cleaned_url = window.location.href.replaceAll('%5B', '[').replaceAll('%5D', ']').replace(/ *\[[^\]]*]=/g, '[]=');
		const url = new URL(cleaned_url);
        const form = document.querySelector('.posts-archive-with-filter').querySelector('form');
        const form_data = new FormData(form);
        let search_params = url.searchParams;

        if(cleaned_url == initial_url){
            search_params = initial_form_params;
        }

        for(const [key, value] of form_data.entries()){
            if(key === 'paged') continue;

            form.querySelectorAll(':is(input:not([type="radio"], [type="checkbox"]))[name="' + key + '"]').forEach((input) => {
                input.value = '';
            });
            form.querySelectorAll('input:is([type="radio"], [type="checkbox"])[name="' + key + '"][value="' + value + '"]').forEach((input) => {
                input.checked = false;
            });
            form.querySelectorAll('select[name="' + key + '"] option[value="' + value + '"]').forEach((option) => {
                option.selected = false;
            });
        }
        
		for (const [key, value] of search_params.entries()) {
            form.querySelectorAll(':is(input:not([type="radio"], [type="checkbox"]))[name="' + key + '"]').forEach((input) => {
                input.value = value;
            });
            for(const splitted_value of value.split(',')){
                form.querySelectorAll('input:is([type="radio"], [type="checkbox"])[name="' + key + '"][value="' + splitted_value + '"]').forEach((input) => {
                    input.checked = true;
                });
            }
            form.querySelectorAll('select[name="' + key + '"] option[value="' + value + '"]').forEach((option) => {
                option.selected = true;
            });
        }

        display_or_hide_clear_all(form);
    }

    document.addEventListener('click', function(event) {
        if (event.target.matches('.nav-links a, .nav-links a *')) {
            event.preventDefault();

			const url = event.target.closest('.nav-links a').attributes.href.value;

			history.pushState(null, null, url);

            if(scroll){
                let distance_from_top = window.scrollY + document.querySelector('.posts-archive-with-filter').getBoundingClientRect().top - 100;
                if(document.querySelector('#wpadminbar')){
                    distance_from_top -= document.querySelector('#wpadminbar').offsetHeight;
                }

                window.scrollTo({
                    top: distance_from_top,
                    behavior: 'smooth',
                });
            }

            load_content(url, false);
        }
    }, false);

    const block = document.querySelector('.posts-archive-with-filter');

    block.querySelectorAll('.posts-archive-with-filter-filters-group').forEach((group) => {
        group.querySelectorAll('.posts-archive-with-filter-filters-group-title').forEach((button) => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                const group = event.target.closest('.posts-archive-with-filter-filters-group');
                if(window.innerWidth < breakpoint){
                    group.classList.toggle('open');
                }else{
                    group.classList.remove('open');
                }

                if(group.classList.contains('open') || window.innerWidth >= breakpoint){
                    event.target.closest('.posts-archive-with-filter-filters-group-title').setAttribute('aria-expanded', 'true');
                    group.querySelector('.posts-archive-with-filter-filters-group-options').setAttribute('aria-hidden', 'false');
                }else{
                    event.target.closest('.posts-archive-with-filter-filters-group-title').setAttribute('aria-expanded', 'false');
                    group.querySelector('.posts-archive-with-filter-filters-group-options').setAttribute('aria-hidden', 'true');
                }
            });
        });

        group.querySelectorAll('.posts-archive-with-filter-filters-group-options-item input').forEach((input) => {
            input.setAttribute('tabindex', '-1');
        });
    });

    const reset_filters = () => {
        block.querySelectorAll('.posts-archive-with-filter-filters-group').forEach((group) => {
            if(window.innerWidth >= breakpoint){
                group.classList.remove('open');
                group.querySelector('.posts-archive-with-filter-filters-group-title').setAttribute('aria-expanded', 'true');
                group.querySelector('.posts-archive-with-filter-filters-group-options').setAttribute('aria-hidden', 'false');
            }else{
                if(group.classList.contains('open')){
                    group.querySelector('.posts-archive-with-filter-filters-group-title').setAttribute('aria-expanded', 'true');
                    group.querySelector('.posts-archive-with-filter-filters-group-options').setAttribute('aria-hidden', 'false');
                }else{
                    group.querySelector('.posts-archive-with-filter-filters-group-title').setAttribute('aria-expanded', 'false');
                    group.querySelector('.posts-archive-with-filter-filters-group-options').setAttribute('aria-hidden', 'true');
                }                
            }
        });
    }
    
    window.addEventListener('resize', reset_filters);
    reset_filters();

    block.querySelectorAll('form').forEach((form) => {
        form.addEventListener('submit', process_form);
        form.addEventListener('change', process_form);
    });

    block.querySelectorAll('.posts-archive-with-filter-filters-group').forEach((group) => {
        group.querySelectorAll('.posts-archive-with-filter-filters-group-clear').forEach((button) => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                input_reset(button.closest('.posts-archive-with-filter-filters-group')); 
                process_form(event);
            });
        });
    });

	window.onpopstate = history.onpushstate = () => {
		load_content(window.location.href);
		set_filters();
	};

    block.querySelector('.skip-filters').addEventListener('click', function(event){
        event.preventDefault();
        const href = event.target.closest('.skip-filters').getAttribute('href');
        document.querySelector(href).focus();
    });

    block.querySelector('.posts-archive-with-filter-filters').addEventListener('keydown', (event) => {
        if(event.key === 'ArrowDown'){
            if(event.target.closest('button') && event.target.closest('button').classList.contains('posts-archive-with-filter-filters-group-title')){
                event.preventDefault();
                if(!event.target.closest('.posts-archive-with-filter-filters-group').classList.contains('open')){
                    event.target.closest('button').click();
                }
                event.target.closest('.posts-archive-with-filter-filters-group').querySelector('.posts-archive-with-filter-filters-group-options-item input').setAttribute('tabindex', '0');
                event.target.closest('.posts-archive-with-filter-filters-group').querySelector('.posts-archive-with-filter-filters-group-options-item input').focus();
            }else if(event.target.closest('input') && event.target.closest('input').parentNode.nextElementSibling){
                event.preventDefault();
                event.target.setAttribute('tabindex', '-1');
                event.target.parentNode.nextElementSibling.querySelector('input').setAttribute('tabindex', '0');
                event.target.parentNode.nextElementSibling.querySelector('input').focus();
            }else if(event.target.closest('input') && !event.target.closest('input').parentNode.nextElementSibling){
                event.preventDefault();
                event.target.setAttribute('tabindex', '-1');
                event.target.closest('.posts-archive-with-filter-filters-group').querySelector('.posts-archive-with-filter-filters-group-options-item input').setAttribute('tabindex', '0');
                event.target.closest('.posts-archive-with-filter-filters-group').querySelector('.posts-archive-with-filter-filters-group-options-item input').focus();
            }
        }else if(event.key === 'ArrowUp'){
            event.preventDefault();
            if(event.target.closest('button') && event.target.closest('button').classList.contains('posts-archive-with-filter-filters-group-title')){
                if(!event.target.closest('.posts-archive-with-filter-filters-group').classList.contains('open')){
                    event.target.closest('button').click();
                }
                const inputs = event.target.closest('.posts-archive-with-filter-filters-group').querySelectorAll('.posts-archive-with-filter-filters-group-options-item input');
                inputs[inputs.length - 1].setAttribute('tabindex', '0');
                inputs[inputs.length - 1].focus();
            }else if(event.target.closest('input') && event.target.closest('input').parentNode.previousElementSibling){
                event.target.setAttribute('tabindex', '-1');
                event.target.parentNode.previousElementSibling.querySelector('input').setAttribute('tabindex', '0');
                event.target.parentNode.previousElementSibling.querySelector('input').focus();
            }else if(event.target.closest('input') && !event.target.closest('input').parentNode.previousElementSibling){
                event.target.setAttribute('tabindex', '-1');
                const inputs = event.target.closest('.posts-archive-with-filter-filters-group').querySelectorAll('.posts-archive-with-filter-filters-group-options-item input');
                inputs[inputs.length - 1].setAttribute('tabindex', '0');
                inputs[inputs.length - 1].focus();
            }
        }else if(event.key === 'ArrowRight'){
            event.preventDefault();
            if(event.target.closest('.posts-archive-with-filter-filters-group') && event.target.closest('.posts-archive-with-filter-filters-group').nextElementSibling && event.target.closest('.posts-archive-with-filter-filters-group').nextElementSibling.classList.contains('posts-archive-with-filter-filters-group')){
                if(event.target.closest('input')){
                    event.target.setAttribute('tabindex', '-1');
                }
                event.target.closest('.posts-archive-with-filter-filters-group').nextElementSibling.querySelector('.posts-archive-with-filter-filters-group-title').focus();
            }else if(event.target.closest('.posts-archive-with-filter-filters-group') && !(event.target.closest('.posts-archive-with-filter-filters-group').nextElementSibling && event.target.closest('.posts-archive-with-filter-filters-group').nextElementSibling.classList.contains('posts-archive-with-filter-filters-group'))){
                if(event.target.closest('input')){
                    event.target.setAttribute('tabindex', '-1');
                }
                event.target.closest('.posts-archive-with-filter-filters').querySelector('.posts-archive-with-filter-filters-group-title').focus();
            }
        }else if(event.key === 'ArrowLeft'){
            event.preventDefault();
            if(event.target.closest('.posts-archive-with-filter-filters-group') && event.target.closest('.posts-archive-with-filter-filters-group').previousElementSibling && event.target.closest('.posts-archive-with-filter-filters-group').previousElementSibling.classList.contains('posts-archive-with-filter-filters-group')){
                if(event.target.closest('input')){
                    event.target.setAttribute('tabindex', '-1');
                }
                event.target.closest('.posts-archive-with-filter-filters-group').previousElementSibling.querySelector('.posts-archive-with-filter-filters-group-title').focus();
            }else if(event.target.closest('.posts-archive-with-filter-filters-group') && !(event.target.closest('.posts-archive-with-filter-filters-group').previousElementSibling && event.target.closest('.posts-archive-with-filter-filters-group').previousElementSibling.classList.contains('posts-archive-with-filter-filters-group'))){
                if(event.target.closest('input')){
                    event.target.setAttribute('tabindex', '-1');
                }
                const groups = event.target.closest('.posts-archive-with-filter-filters').querySelectorAll('.posts-archive-with-filter-filters-group-title');
                groups[groups.length - 1].focus();
            }
        }else if(event.key === 'Enter'){
            if(event.target.closest('input')){
                event.target.closest('input').click();
            }else if(event.target.closest('button') && event.target.closest('button').classList.contains('posts-archive-with-filter-filters-group-title')){
                event.preventDefault();
                if(!event.target.closest('.posts-archive-with-filter-filters-group').classList.contains('open')){
                    event.target.closest('button').click();
                }
                event.target.closest('.posts-archive-with-filter-filters-group').querySelector('.posts-archive-with-filter-filters-group-options-item input').setAttribute('tabindex', '0');
                event.target.closest('.posts-archive-with-filter-filters-group').querySelector('.posts-archive-with-filter-filters-group-options-item input').focus();
            }
        }else if(event.key === 'Tab'){
            if(event.target.closest('input')){
                event.target.setAttribute('tabindex', '-1');
            }
        }else if(event.key === 'Escape'){
            if(event.target.closest('.posts-archive-with-filter-filters-group.open')){
                event.preventDefault();
                if(event.target.closest('input')){
                    event.target.setAttribute('tabindex', '-1');
                }
                event.target.closest('.posts-archive-with-filter-filters-group.open').querySelector('.posts-archive-with-filter-filters-group-title').focus();
                event.target.closest('.posts-archive-with-filter-filters-group.open').querySelector('.posts-archive-with-filter-filters-group-title').click();
            }
        }
    });

    block.querySelector('.posts-archive-with-filter-filters-submit').style.display = 'none';
    set_filters();
})();