(function () {

    let textUser = document.getElementById('iduser');
    let views = document.querySelectorAll('.view');
    let types = document.querySelectorAll('input[name="idtype"]');
    let qualities = document.querySelectorAll('input[name="idquality"]');
    let details = document.getElementById('details');
    let header = document.querySelector('.header');
    let steps = document.querySelectorAll('.step');
    let pictoUser = document.getElementById('logoResponse');

    let errorDiv = document.getElementById('error-id');
    let divEmail = document.createElement('div');
    let divType = document.createElement('div');
    let divQuality = document.createElement('div');

    let typeButtons = views[1].querySelectorAll('button.btn-white');
    let qualityButtons = views[2].querySelectorAll('button.btn-white2');

    let sardinesDisplay = document.querySelector("#recompense");
    let type;
    let quality;

    //Cancel default button
    for (let i = 0; i < typeButtons.length; i++) {
        typeButtons[i].addEventListener('click', function (event) {
            event.preventDefault();
        })
    }
    for (let i = 0; i < qualityButtons.length; i++) {
        qualityButtons[i].addEventListener('click', function (event) {
            event.preventDefault();
        })
    }
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
        pictoUser.style.display = 'none';

        if (textUser.value != null && textUser.value.length == 4) {
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    pictoUser.src = "images/pictos/valid.svg";
                    response.innerHTML = xhttp.responseText;
                    if (xhttp.responseText != '<p>Cet utilisateur n\'existe pas</p>') {
                        if (xhttp.response.search('validé') == -1) {
                            pictoUser.src = "images/pictos/valid.svg";
                            pictoUser.style.display = 'block';
                            setTimeout(function () {
                                smoothScroll(1, 60);
                                divEmail.innerHTML = '<p>' + errorDiv.textContent + '</p>';
                            }, 2000);
                            //Types
                            for (let i = 0; i < typeButtons.length; i++) {
                                typeButtons[i].addEventListener('click', function (event) {
                                    removePushedTypeClass();
                                    typeButtons[i].classList.add('btn-white-clicked');
                                    typeButtons[i].classList.remove('btn-white');
                                    let nameId = typeButtons[i].name;
                                    let radioTarget = document.getElementById(nameId);
                                    radioTarget.checked = true;
                                    type = i + 1;
                                    getValue();
                                    setTimeout(function () {
                                        smoothScroll(2, 60);
                                        divType.innerHTML = '<p>Type : ' + event.target.name + '</p>';
                                    }, 2000);
                                });
                            }
                            //Qualities
                            for (let i = 0; i < qualityButtons.length; i++) {
                                qualityButtons[i].addEventListener('click', function (event) {
                                    removePushedQualityClass();
                                    qualityButtons[i].classList.add('btn-white-clicked');
                                    qualityButtons[i].classList.remove('btn-white');
                                    let nameId = qualityButtons[i].name;
                                    let radioTarget = document.getElementById(nameId);
                                    radioTarget.checked = true;
                                    quality = i + 1;
                                    getValue();
                                    divQuality.innerHTML = '<p>Qualité : ' + event.target.name + '</p>';
                                });

                            }

                        }
                        else {
                            pictoUser.src = "images/pictos/warning.svg";
                            pictoUser.style.display = 'block';
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
            pictoUser.src = "images/pictos/invalid.svg";
            pictoUser.style.display = 'block';
            response.innerText = 'Cet utilisateur n\'existe pas';
        }
    });
    //Basket-bar
    let navTopPosition = header.offsetTop;
    let currentMarginTop = parseInt(window.getComputedStyle(steps[0]).marginTop, 10);
    let imgLogo = document.querySelector('.logo img');
    let imgcurrentMarginTop = parseInt(window.getComputedStyle(imgLogo).marginTop, 10);
    let firstSelect = document.getElementById('first-new-asset');
    let firstSelectcurrentMarginTop = parseInt(window.getComputedStyle(firstSelect).marginTop, 10);
    document.addEventListener('scroll', function () {
        let scrollPage = window.pageYOffset;

        if (scrollPage > navTopPosition) {
            header.classList.add('fixed');
            header.classList.remove('not-fixed');
            header.style.paddingTop = '5.54vh';
            let imgLogo2 = document.querySelector('.logo img');
            for (let i = 0; i < steps.length; i++) {
                if (i == 0) {
                    let headerHeight = header.offsetHeight;
                    steps[i].style.marginTop = currentMarginTop + headerHeight +'px';
                    if (imgLogo2 != null) {
                        document.querySelector('.logo').replaceChild(firstSelect, imgLogo);
                        firstSelect.style.marginTop = imgcurrentMarginTop + 'px';
                    }

                }
            }
        }
        else if (scrollPage <= navTopPosition) {
            //Reset
            header.classList.add('not-fixed');
            header.classList.remove('fixed');
            steps[0].style.marginTop = currentMarginTop +'px';
            document.querySelector('.logo').replaceChild(imgLogo, firstSelect);
            imgLogo.style.marginTop = imgcurrentMarginTop + 'px';
            firstSelect.style.marginTop = firstSelectcurrentMarginTop + 'px';
            document.querySelector('.header').appendChild(firstSelect);

        }
    });

    //Unselect buttons
    function removePushedTypeClass() {
        for (let i = 0; i < typeButtons.length; i++) {
            typeButtons[i].classList.remove('btn-white-clicked');
            typeButtons[i].classList.add('btn-white');
            let nameId = typeButtons[i].name;
            let radioTarget = document.getElementById(nameId);
            radioTarget.checked = false;
        }
    }

    function removePushedQualityClass() {
        for (let i = 0; i < qualityButtons.length; i++) {
            qualityButtons[i].classList.remove('btn-white-clicked');
            qualityButtons[i].classList.add('btn-white');
            let nameId = qualityButtons[i].name;
            let radioTarget = document.getElementById(nameId);
            radioTarget.checked = false;
        }
    }

    //Smooth scroll
    function smoothScroll(nb_viewport, speed_millisecond) {
        let scrollPage = window.pageYOffset;
        let target = window.innerHeight;
        let range = target * nb_viewport;
        let speed = range / speed_millisecond;
        let i = scrollPage;
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

    function getValue() {
        if (type > 0 && quality > 0) {
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    sardinesDisplay.innerHTML = this.responseText;
                }
            };
            xhttp.open("POST", "./traitements/valueqt.php", true); //True = async
            //encodage du formulaire
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("type=" + type + "&quality=" + quality);
        }
    }

})();