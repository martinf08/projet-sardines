const mail = document.querySelector('#email');
const pass = document.querySelector('#password');
const confirm = document.querySelector('#confirmPassword');
const submit = document.querySelector('input[type="submit"]');
const tooltip = document.querySelectorAll('.tooltip')[0];

const mailReg = /^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$/i;

let okMail = okPass = okConfirm = false;

submit.setAttribute("disabled", "");

// is email
mail.addEventListener('input', function(e) {
    let mailValue = this.value;
    if (mailReg.test(mailValue)) {
        mail.style.background = '#7f5'; // à remplacer par le nécessaire pour appliquer les bons styles
        okMail = true;
        enable();
    } else {
        mail.style.background = '#f77'; // à remplacer par le nécessaire pour appliquer les bons styles
        okMail = false;
        enable();
    }
});

// is 6 characters
if (pass != null) {
    pass.addEventListener('input', function(e) {
        let passValue = this.value;
    
        if (passValue.length >= 6) {
            pass.style.background = '#7f5'; // à remplacer par le nécessaire pour appliquer les bons styles
            // cacher le tooltip
            tooltip.classList.remove('show');
            okPass = true;
            enable();
        } else {
            pass.style.background = '#f77'; // à remplacer par le nécessaire pour appliquer les bons styles
            // lancer un tooltip puisqu'on a pas utilisé le placeholder pour énoncer la règle de 6 minimum (si ça change, on peut le supprimer)
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
            confirm.style.background = '#7f5'; // à remplacer par le nécessaire pour appliquer les bons styles
            okConfirm = true;
            enable();
        } else {
            confirm.style.background = '#f77'; // à remplacer par le nécessaire pour appliquer les bons styles
            okConfirm = false;
            enable();
        }
    });
}

// is all ok
function enable() {
    if (pass == null) {
        // si on se trouve sur la page de connexion, on confirme seulement deux champs
        if (okMail === true) {
            submit.removeAttribute("disabled");
            return true;
        } else {
            submit.setAttribute("disabled", "");
            return false;
        }
    } else if (confirm == null) {
        // si on se trouve sur la page d'oubli de mot de passe
        if (okMail === true && okPass === true) {
            submit.removeAttribute("disabled");
            return true;
        } else {
            submit.setAttribute("disabled", "");
            return false;
        }
    } else {
        if (okMail === true && okPass === true && okConfirm === true) {
            submit.removeAttribute("disabled");
            return true;
        } else {
            submit.setAttribute("disabled", "");
            return false;
        }
    }
}
