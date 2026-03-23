(() => {
    
    const popup = document.querySelector(".popup");
    const closeBtn = document.querySelector(".popup-close");

    document.addEventListener("DOMContentLoaded",() => {
        handleClick();
    })

    function handleClick(event) {
        popup.style.display = "block";
        
        closeBtn.addEventListener("click", () => {
            popup.style.display = "none";
        })
    }

})();