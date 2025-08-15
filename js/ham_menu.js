const hamMenu = document.querySelector('.ham-menu');
const offScreenMenu = document.querySelector('.off-screen-menu');

hamMenu.addEventListener('click', () => {
    hamMenu.classList.toggle("active");
    offScreenMenu.classList.toggle('active');
});

function closeOffScreenMenu() {
    hamMenu.classList.remove("active");
    offScreenMenu.classList.remove('active');
}

// Закрытие бургер-меню при клике вне меню
document.addEventListener('click', function (event) {
    if (!event.target.matches('.ham-menu') && !event.target.matches('.off-screen-menu')) {
        closeOffScreenMenu();
    }
});