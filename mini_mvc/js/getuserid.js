(function () {
    let textUser = document.getElementById('iduser');
    let views = document.querySelectorAll('.view');
    let nav = document.querySelector('nav');
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

            setTimeout(function () {
                smoothScroll(views[1], 50);
            }, 2000)
        }
        else if (textUser.value.length <= 4 || textUser.value.length >= 4) {
            response.innerText = 'Cet utilisateur n\'existe pas';
        }

    });
    function smoothScroll(target, speed_millisecond) {
        let range = target.offsetTop - nav.clientHeight;
        let speed = range / speed_millisecond;
        let i = 0;
        setInterval(function () {
            if (i <= range) {
                if (i >= range - (range / 2) && i <= range - (range / 4)) {
                    scrollTo(0, i);
                    i = i + speed / 2;
                }
                else if (i >= range - (range / 4) && i <= range - (range / 8)) {
                    scrollTo(0, i);
                    i = i + speed / 2.8;
                }
                else if (i >= range - (range / 8)) {
                    scrollTo(0, i);
                    i = i + speed / 3.6;
                }
                else {
                    scrollTo(0, i);
                    i = i + speed;
                }
            }
        }, 1)
    }
})();
