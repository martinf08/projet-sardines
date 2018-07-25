(function () {
    let inputsBenef = document.querySelectorAll('input[name="beneficiaire"');
    let inputIdUser = document.getElementById('iduser');
    if (inputsBenef) {
        if (document.body.querySelector('input#sansBeneficiaire').checked == true) {
            inputIdUser.disabled = true;
            inputIdUser.value = "";
        }
        for (input of inputsBenef) {

            if (input.querySelector('input[id="sansBeneficiaire:checked"') == true) {
                inputIdUser.disabled = true;
                inputIdUser.value = "";
            }
            input.addEventListener('click', function (e) {
                if (e.target.id === 'sansBeneficiaire') {
                    inputIdUser.disabled = true;
                    inputIdUser.value = "";
                }
                else if (e.target.id === 'avecBeneficiaire') {
                    inputIdUser.disabled = false;
                }
            });
        }
    }
})();