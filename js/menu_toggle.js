const open = document.querySelector('#open');
const close = document.querySelector('#close');
const menu = document.querySelector('#menu');
const open2 = document.querySelector('#open2');
const closewarning = document.getElementById('warnnigHide'); 






if (open != null) {
    open.addEventListener('click', function(event) {
        menu.classList.add('show');
        // stop propagation sinon le clic sur body sera déclenché !
        event.stopPropagation();
    });
}

if (open2 != null) {
    open2.addEventListener('click', function(event) {
        menu.classList.add('show');
        // stop propagation sinon le clic sur body sera déclenché !
        event.stopPropagation();
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



closewarning.onclick = function() {
    var div = document.getElementById('accounrwarning');
    if (div.style.display !== 'none') {
        div.style.display = 'none';
    }
};