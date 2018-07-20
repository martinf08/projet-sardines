(function () {
    let textUser = document.getElementById('iduser');
    textUser.addEventListener('input', function () {
        let response = document.getElementById('error-id');
        if (textUser.value != null && textUser.value.length == 4) {
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    response.innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("POST", "./traitements/checkuserid.php", true); //True = async
            //encodage du formulaire
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("userid=" + textUser.value);
        }

    });

})();
