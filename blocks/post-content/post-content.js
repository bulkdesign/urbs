(() => {
    if(!document.querySelectorAll('.post-content .share-link').length) return;

    document.querySelectorAll('.post-content .share-link:not(.share-to-clipboard, [href^="mailto:"])').forEach(function(element){
        element.addEventListener('click', function(event){
            event.preventDefault();
            const url = this.href;
            window.open(url, 'Share', 'width=600,height=400');
        });
    });

    document.querySelectorAll('.post-content .share-link.share-to-clipboard').forEach(function(element){
        element.addEventListener('click', async function(event){
            event.preventDefault();
            const url = this.href;
            await navigator.clipboard.writeText(url);

            const iconLink = this.querySelectorAll('svg')[0];
            const iconCheck = this.querySelectorAll('svg')[1];

            iconLink.style.display = 'none';
            iconCheck.style.display = 'block';

            setTimeout(function(){
                iconCheck.style.display = 'none';
                iconLink.style.display = 'block';
            }, 5000);        
        });
    });
})();