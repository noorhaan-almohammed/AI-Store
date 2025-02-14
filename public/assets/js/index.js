

const sidbarItems = document.querySelectorAll('.sidbar-item');
const sections = document.querySelectorAll('.sidbar-section');

sidbarItems.forEach((item) => {
    item.addEventListener('click', () => {
        sections.forEach((sec) => {
            sec.classList.remove('active');
            if (item.dataset.id === sec.classList[1]) {
                sec.classList.add('active');
            }
        });
    });

})


