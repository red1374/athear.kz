window.addEventListener('DOMContentLoaded', () => {
    const btns = document.querySelectorAll('.chips__item');
    const contents = document.querySelectorAll('.accordion');

    btns[0].classList.add('active');
    contents[0].style.display = 'block';

    btns.forEach(btn => {
        btn.addEventListener('click', () => {
            contents.forEach(content => {
                if (content.dataset.section == btn.dataset.section) {
                    contents.forEach(item => {
                        item.style.display = 'none';
                    });

                    content.style.display = 'block';
                }
            });
        });
    });
});