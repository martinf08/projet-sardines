(function () {
    let textUser = document.getElementById('iduser');
    let views = document.querySelectorAll('.view');
    let nav = document.getElementById('basket-bar');
    let types = document.querySelectorAll('input[name="idtype"]');
    let qualities = document.querySelectorAll('input[name="idquality"]');
    let details = document.getElementById('details');

    let errorDiv = document.getElementById('error-id');
    let divEmail = document.createElement('div');
    let divType = document.createElement('div');
    let divQuality = document.createElement('div');

    nav.appendChild(divEmail);
    nav.appendChild(divType);
    nav.appendChild(divQuality);

    textUser.addEventListener('input', function () {
        //Reset
        errorDiv.innerHTML = "";
        divEmail.innerHTML = "";
        divType.innerHTML = "";
        divQuality.innerHTML = "";

        for (let i = 0; i < types.length; i++) {
            types[i].checked = false;
        }
        for (let i = 0; i < qualities.length; i++) {
            qualities[i].checked = false;
        }

        details.value = "";


        //Identifier
        let response = document.getElementById('error-id');
        textUser.setAttribute('maxlength', 4);
        if (textUser.value != null && textUser.value.length == 4) {
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    response.innerHTML = xhttp.responseText;
                    if (xhttp.responseText != '<p>Cet utilisateur n\'existe pas</p>') {
                        setTimeout(function () {
                            smoothScroll(views[1], 100);
                            divEmail.innerHTML = '<p>' + errorDiv.textContent + '</p>';
                        }, 2000);
                        //Types
                        for (let i = 0; i < types.length; i++) {
                            types[i].addEventListener('click', function (e) {
                                setTimeout(function () {
                                    smoothScroll(views[2], 100);
                                    divType.innerHTML = '<p>Type : ' + e.target.nextElementSibling.textContent + '</p>';
                                }, 2000);
                            });
                        }
                        //Qualities
                        for (let i = 0; i < qualities.length; i++) {
                            qualities[i].addEventListener('click', function (e) {
                                divQuality.innerHTML = '<p>Qualité : ' + e.target.nextElementSibling.textContent + '</p>';
                            });
                        }
                    }
                }
            };
            xhttp.open("POST", "./traitements/checkuserid.php", true); //True = async
            //encodage du formulaire
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("userid=" + textUser.value);
        }
        else if (textUser.value.length <= 4 || textUser.value.length >= 4) {
            response.innerText = 'Cet utilisateur n\'existe pas';
        }
    });
    //Basket-bar
    let navTopPosition = nav.offsetTop;
    document.addEventListener('scroll', function () {
        let scrollPage = window.pageYOffset;

        if (scrollPage > navTopPosition) {
            nav.classList.add('fixed');
            nav.classList.remove('not-fixed');
        }
        else if (scrollPage <= navTopPosition) {
            nav.classList.add('not-fixed');
            nav.classList.remove('fixed');
        }
    });
    //Smooth scroll
    function smoothScroll(target, speed_millisecond) {
        let scrollPage = window.pageYOffset;
        let range = target.offsetTop - nav.clientHeight * 2;
        let speed = range / speed_millisecond;
        let i = 0 + scrollPage;
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
