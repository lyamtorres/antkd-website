const menu = document.querySelector('.menu');
const burgerButton = document.querySelector('.hamburger-button');
//const menuOptions = document.querySelector('.menu-selection'); 

var hide = () => {
    menu.classList.remove('is-active');
};

var hideShow = () => {
    if (menu.classList.contains('is-active')) {
        menu.classList.remove('is-active');
    } else {
        menu.classList.add('is-active');
    }
};


burgerButton.addEventListener('click', hideShow);
//menuOptions.addEventListener('click', hide);
