window.addEventListener('DOMContentLoaded', () => {
    const accordionItems = document.querySelectorAll(".accordion__item");

    accordionItems.forEach(item =>
        item.addEventListener("click", () => {
            const isItemOpen = item.classList.contains("open");
            accordionItems.forEach(item => item.classList.remove("open"));
            if (!isItemOpen) {
                item.classList.toggle("open");
            }
        })
    );
});