(() => {
    // Chosen Select Attribute
    const add_chosen_attribute = (select) => {
        if(select.value){
            select.setAttribute('data-chosen', '');
        }else{
            select.removeAttribute('data-chosen');
        }
    }

    document.addEventListener('change', function(event){
        const selector = 'select';
        if(!event.target.matches( selector + ', ' + selector + ' *' )) return false;

        add_chosen_attribute(event.target);
    });

    document.querySelectorAll('select').forEach((select) => {
        add_chosen_attribute(select);
    });

    // Elements Animation Scroll
    const should_animate = (element) => {
        const topOffset = window.innerHeight / 8;

        const viewport = {
            top: window.scrollY - topOffset,
        };

        viewport.bottom = viewport.top + window.innerHeight;

        const bounds = {};
        bounds.top = window.scrollY + element.getBoundingClientRect().top;
        bounds.bottom = bounds.top + element.offsetHeight;

        return !(viewport.bottom < bounds.top);
    }

    const run_animations = () => {
        document.querySelectorAll('.page-animation *:not(.no-page-animation) [data-animation]:not(.animate__animated), .page-animation *:not(.no-page-animation) .animate:not(.animate__animated)').forEach(function(item){
            if(should_animate(item)){
                item.classList.add('animate__animated');
                if(item.dataset.animation){
                    item.classList.add('animate__' + item.dataset.animation);
                }
            }
        });
    }

    window.addEventListener('load', () => {
        if(document.body.classList.contains('page-animation')){
            run_animations();
            window.addEventListener('scroll', function(){
                window.requestAnimationFrame(run_animations);
            });
        }
    });
})();