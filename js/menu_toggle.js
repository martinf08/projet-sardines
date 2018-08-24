const open = document.querySelector('#open');
const close = document.querySelector('#close');
const menu = document.querySelector('#menu');
const open2 = document.querySelector('#open2');

if (open != null) {
    open.addEventListener('click', function (event) {
        menu.classList.add('show');
        // stop propagation sinon le clic sur body sera déclenché !
        event.stopPropagation();
    });
}

if (open2 != null) {
    open2.addEventListener('click', function (event) {
        menu.classList.add('show');
        // stop propagation sinon le clic sur body sera déclenché !
        event.stopPropagation();
    });
}

close.addEventListener('click', function () {
    menu.classList.remove('show');
});

document.querySelector('#container').addEventListener('click', function (e) {
    let isClickInside = menu.contains(e.target);
    if (!isClickInside) {
        menu.classList.remove('show');
    }

});
let is_touch_device = function () {
    try {
        document.createEvent("TouchEvent");
        return true;
    } catch (e) {
        return false;
    }
};

if (is_touch_device() == true) {
    menu.addEventListener('touchstart', function touchStart(e) {
        if (e.target.id == "open" || e.target.id == "open2") {
            open.addEventListener('click', function (event) {
                menu.classList.add('show');
                // stop propagation sinon le clic sur body sera déclenché !
                event.stopPropagation();
            });
        }
    })
}