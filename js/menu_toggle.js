const open = document.querySelector('#open');
const close = document.querySelector('#close');
const menu = document.querySelector('#menu');
const open2 = document.querySelector('#open2');

if (open != null) {
    open.addEventListener('click', function() {
        menu.classList.add('show');
    });
}


if (open2 != null) {
    open2.addEventListener('click', function() {
        menu.classList.add('show');
    });
}

close.addEventListener('click', function() {
    menu.classList.remove('show');
});