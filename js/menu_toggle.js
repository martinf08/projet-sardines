const open = document.querySelector('#open');
const close = document.querySelector('#close');
const menu = document.querySelector('#menu');
const open2 = document.querySelector('#open2');

if (open != null) {
    open.addEventListener('click', function(event) {
        menu.classList.add('show');
        // stop propagation sinon le clic sur body sera déclenché !
        event.stopPropagation();
    });
}

if (open2 != null) { // apparemment devenu inutile, tout est en id="open" si j'ai rien raté
    open2.addEventListener('click', function() {
        menu.classList.add('show');
    });
}

close.addEventListener('click', function() {
    menu.classList.remove('show');
});

document.querySelector('#container').addEventListener('click', function(e) {
    let isClickInside = menu.contains(e.target);
    if (!isClickInside) {
        menu.classList.remove('show');
    }
});
