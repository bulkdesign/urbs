(() => {
    if(document.querySelectorAll('.cookies-disclaimer').length){
        if (!localStorage.getItem('cookie_disclaimer')) {
            document.querySelector('.cookies-disclaimer').style.display = "block";
        }

        document.querySelector('.cookies-disclaimer-close').addEventListener('click', function(event){
            event.preventDefault();
            document.querySelector('.cookies-disclaimer').style.display = "none";
            localStorage.setItem('cookie_disclaimer', true);
        });
    }    
})();