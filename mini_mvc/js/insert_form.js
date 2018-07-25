(function () {
    let inputBenef = document.body.querySelector('input#withBeneficiary');
    let inputWithoutBenef = document.body.querySelector('input#withoutBeneficiary');
    let inputIdUser = document.getElementById('iduser');

    if (inputBenef.checked == true) {
        inputIdUser.disabled = false;
    }
    if (inputWithoutBenef.checked == true) {
        inputIdUser.disabled = true;
    }
    inputBenef.addEventListener('click', function () {
        inputIdUser.disabled = false;
    });
    inputWithoutBenef.addEventListener('click', function () {

        inputIdUser.disabled = true;
        inputIdUser.value = "";
    });
})();