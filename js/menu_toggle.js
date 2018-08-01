const open = document.querySelector('#open');
const close = document.querySelector('#close');
const menu = document.querySelector('header');

open.addEventListener('click', function() {
    menu.classList.add('show');
});

close.addEventListener('click', function() {
    menu.classList.remove('show');
});