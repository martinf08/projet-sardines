function verif_form() {
    let form = document.getElementsByTagName('form');
    let nbForm = form.length;
    let regexEmail = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
    let regexName = /^[a-zA-Z ]+$/;
    let regexTel = /^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$/;

    //Check div error exist
    let errors = document.querySelectorAll('.error');
    if (errors > 0) {
        errors.for(e => e.parentNode.removeChild(e));
    }

    if (nbForm > 0) {
        for (let i = 0; i < nbForm; i++) {

            let targetForm = form[i];

            //Email
            let emails = targetForm.querySelectorAll('input[type="email"]');
            let nb_emails = emails.length;

            //input emails
            for (let y = 0; y < nb_emails; y++) {
                if (emails[y].value != "") {
                    if (!regexEmail.test(emails[y].value)) {
                        emails[y].insertAdjacentHTML('afterend', '<div class="error">L\'adresse email est incorrect</div>');
                    }
                }
                else {
                    emails[y].insertAdjacentHTML('afterend', '<div class="error">L\'adresse email est incorrect</div>');
                }
            }

            //inputs texts
            let texts = targetForm.querySelectorAll('input[type="text"]');
            let nb_texts = texts.length;

            for (let y = 0; y < nb_texts; y++) {
                if (texts[y].value != "") {
                    if (!regexName.test(texts[y].value)) {
                        texts[y].insertAdjacentHTML('afterend', '<div class="error">Le texte est incorrect</div>');
                    }
                }
                else {
                    texts[y].insertAdjacentHTML('afterend', '<div class="error">Le text est vide</div>');
                }

            }

            //input tel
            let tels = targetForm.querySelectorAll['input[type="tel"]'];
            let nb_tels = tels.length;

            for (let y = 0; y < nb_tels; y++) {
                if (tels[y].value != "") {
                    if (!regexTel.test(tels[y])) {
                        tels[y].insertAdjacentHTML('afterend', '<div class="error">Le numéro de téléphone est incorrect</div>');
                    }
                }
                else {
                    tels[y].insertAdjacentHTML('afterend', '<div class="error">Le numéro de téléphone est vide</div>');
                }
            }

            let inputs = targetForm.querySelectorAll['input[type="radio"]'];
            let nb_inputs = inputs.length;
            if (inputs != null) {

            }
        }
    }
}

verif_form();