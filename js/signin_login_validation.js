const mail = document.querySelector('#email');
const pass = document.querySelector('#password');
const confirm = document.querySelector('#confirmPassword');
const disc = document.querySelector('#terms');
const proxy = document.querySelector('#proxy');
const submit = document.querySelector('input[type="submit"]');
const tooltip = document.querySelectorAll('.tooltip')[0];

const mailReg = /^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$/i;

let okMail = okPass = okConfirm = false;

submit.setAttribute("disabled", "");

// is email
if (mail != null) {
    mail.addEventListener('input', function(e) {
        let mailValue = this.value;
        if (mailReg.test(mailValue)) {
            mail.style.color = '#009688';
            okMail = true;
            enable();
        } else {
            mail.style.color = '#A30004';
            okMail = false;
            enable();
        }
    });
}

// is 6 characters
if (pass != null) {
    pass.addEventListener('input', function(e) {
        let passValue = this.value;
    
        if (passValue.length >= 6) {
            pass.style.color = '#009688';
            // cacher le tooltip
            tooltip.classList.remove('show');
            okPass = true;
            enable();
        } else {
            pass.style.color = '#A30004';
            // lancer un tooltip pour énoncer la règle de 6 minimum
            tooltip.classList.add('show');
            okPass = false;
            enable();
        }
    });
}

if (pass != null) {
    pass.addEventListener('blur', function(e) {
        tooltip.classList.remove('show');
    });
}

// is pass == confirm (uniquement pour la page inscription)
if (confirm != null) {
    confirm.addEventListener('input', function(e) {
        let confirmValue = this.value;
        if (confirmValue == pass.value) {
            confirm.style.color = '#009688';
            okConfirm = true;
            enable();
        } else {
            confirm.style.color = '#A30004';
            okConfirm = false;
            enable();
        }
    });
}

// is conditions générales acceptées
if (disc != null) {
    disc.addEventListener('click', function(e) {
        enable();
    });
}

if (proxy != null) {
    proxy.addEventListener('click', function(e) {
        if (submit.hasAttribute('disabled')) {
            submit.classList.add('wizz');
            window.setTimeout(function() {
                submit.classList.remove('wizz');
            }, 300);
        } else {
            submit.click();
        }
    })
}

// is all ok
function enable() {
    if (pass == null) {
        // pour la page oubli de mot de passe
        if (okMail) {
            submit.removeAttribute("disabled");
            return true;
        } else {
            submit.setAttribute("disabled", "");
            return false;
        }
    } else if (mail == null) {
        // si on se trouve sur la page nouveau mot de passe
        if (okConfirm && okPass) {
            submit.removeAttribute("disabled");
            return true;
        } else {
            submit.setAttribute("disabled", "");
            return false;
        }
    } else if (confirm == null) {
        // si on se trouve sur la page de connexion
        if (okMail && okPass) {
            submit.removeAttribute("disabled");
            return true;
        } else {
            submit.setAttribute("disabled", "");
            return false;
        }
    } else {
        // sinon on est sur la page d'inscription
        if (okMail && okPass && okConfirm && disc.checked) {
            submit.removeAttribute("disabled");
            return true;
        } else {
            submit.setAttribute("disabled", "");
            return false;
        }
    }
}
