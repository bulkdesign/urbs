document.addEventListener("DOMContentLoaded", function(event) {
    // Hide ACF fields that will be ovewritten
    const duplicateFieldObserver = new MutationObserver((mutations) => {
        document.querySelectorAll('.acf-block-fields').forEach((block) => {
            let namesList = [];

            Array.from(block.children).reverse().forEach((field) => {
                let fieldName = field.dataset['name'];
                if(namesList.includes(fieldName)){
                    field.style.display = 'none';
                }else{
                    namesList.push(fieldName);
                }
            });
        });
    });

    duplicateFieldObserver.observe(document.querySelector('#editor'), {
        subtree: true,
        childList: true,
    });
    
    // Hide options for template parts
    function theme_hide_options_for_template_parts(){
        const postTypes = ['header', 'footer', 'template'];
        const currentPostType = wp.data.select('core/editor').getCurrentPostType();
        if((typeof theme === 'undefined' || typeof theme.bulk_is_developing === 'undefined' || !theme.bulk_is_developing) && postTypes.includes(currentPostType)){
            document.body.classList.add('bulk-is-not-developing');
        }else if(typeof theme !== 'undefined' && typeof theme.bulk_is_developing !== 'undefined' && theme.bulk_is_developing && postTypes.includes(currentPostType)){
            document.body.classList.add('bulk-is-developing');
        }
    }
    setTimeout(theme_hide_options_for_template_parts, 500);
});