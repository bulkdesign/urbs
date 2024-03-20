(() => {
    const toggleMainMenu = (e) => {
        e.preventDefault();

        if(e.currentTarget.closest('.header-divided').classList.contains('menu-open')){
            e.currentTarget.closest('.header-divided').classList.remove('menu-open');
        }else{
            e.currentTarget.closest('.header-divided').classList.add('menu-open');
        }
    }

    document.querySelectorAll('.header-divided-menu-toggle').forEach((element) => {
        element.addEventListener('click', toggleMainMenu);
    });

    document.querySelectorAll('.header-divided').forEach((header) => {
        let lastScrollPosition = 0;

        const fixHeader = (header) => {
            if(!header.dataset.fixed) return;

            const bodyOffset = document.body.getBoundingClientRect().top + Math.round(window.scrollY);
            const headerPlaceholder = header.previousElementSibling;
            const basePosition = headerPlaceholder.getBoundingClientRect().top + Math.round(window.scrollY) - bodyOffset;
            const currentScrollPosition = Math.round(window.scrollY);

            if(currentScrollPosition > basePosition && currentScrollPosition > 0){
                header.classList.add('scrolled');
                headerPlaceholder.style.height = header.offsetHeight + 'px';
                header.style.top = bodyOffset + 'px';
            }else{
                header.classList.remove('scrolled');
                headerPlaceholder.style.height = '';
                header.style.top = '';
            }

            if(currentScrollPosition < lastScrollPosition && currentScrollPosition > 0){
                header.classList.add('scrolling-up');
            }else{
                header.classList.remove('scrolling-up');
            }

            lastScrollPosition = currentScrollPosition;
        }

        const headerHeight = (header) => {
            let reopen = false;

            if(header.classList.contains('menu-open')){
                header.classList.remove('menu-open');
                reopen = true;
            }
            
            document.documentElement.style.setProperty('--header-height', header.offsetHeight + 'px');
            document.documentElement.style.setProperty('--fixed-header-height', header.offsetHeight + 'px');

            if(reopen){
                header.classList.add('menu-open');
            }
        }
        
        const resetHeaderSearch = (e) => {
            e.preventDefault();

            e.currentTarget.closest('.header').querySelector('.header-divided-search-form input').value = '';
        }

        const toggleHeaderSearch = (e) => {
            e.preventDefault();

            if(e.currentTarget.closest('.header-divided').classList.contains('search-open')){
                e.currentTarget.closest('.header-divided').classList.remove('search-open');
            }else{
                e.currentTarget.closest('.header-divided').classList.add('search-open');
                e.currentTarget.closest('.header-divided').querySelector('.header-divided-search-form input').focus();
            }
        }

        document.querySelectorAll('.header-divided-search-toggle').forEach((element) => {
            element.addEventListener('click', toggleHeaderSearch);
        });

        document.querySelectorAll('.header-divided-search-form-close').forEach((element) => {
            element.addEventListener('click', resetHeaderSearch);
            element.addEventListener('click', toggleHeaderSearch);
        });

        headerHeight(header);
        fixHeader(header);

        document.addEventListener('scroll', () => {
            fixHeader(header);
        });

        window.addEventListener('resize', () => {
            headerHeight(header);
            fixHeader(header);
        });
    });

    document.querySelectorAll('.header-divided .main-menu a[href="#"]').forEach((link) => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            if(event.currentTarget.parentNode.classList.contains('menu-item-has-children')){
                event.currentTarget.parentNode.querySelector('.sub-menu-toggle').click();
            }
        });
    });

    document.querySelectorAll('.sub-menu-toggle').forEach((button) => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            event.currentTarget.parentNode.classList.toggle('sub-menu-open');
        });
    });
})();