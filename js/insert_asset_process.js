(function () {

    let textUser = document.getElementById('iduser');
    let views = document.querySelectorAll('.view');
    let types = document.querySelectorAll('input[name="idtype"]');
    let qualities = document.querySelectorAll('input[name="idquality"]');

    let details = document.getElementById('details');
    let header = document.querySelector('.header');
    let steps = document.querySelectorAll('.step');
    let pictoUser = document.getElementById('logoResponse');
    pictoUser.style.display = 'none';

    let errorDiv = document.getElementById('error-id');
    let divEmail = document.createElement('div');
    let divType = document.createElement('div');
    let divQuality = document.createElement('div');

    let typeButtons = views[1].querySelectorAll('button.btn-white');
    let qualityButtons = views[2].querySelectorAll('button.btn-white2');

    let divSubmit = document.querySelector('.btn-outlined');
    let btnSubmit = document.getElementById('submit-asset');

    let type;
    let quality;



    let asValidate = 0;

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
        removePushedTypeClass();
        removePushedQualityClass();

        details.value = "";

        //Identifier
        let response = document.getElementById('error-id');
        textUser.setAttribute('maxlength', 4);
        pictoUser.style.display = 'none';

        if (textUser.value != null && textUser.value.length == 4) {
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    textUser.blur();
                    pictoUser.src = "images/pictos/valid.svg";
                    response.innerHTML = xhttp.responseText;
                    if (xhttp.responseText != '<p>Cet utilisateur n\'existe pas</p>') {
                        if (xhttp.response.search('validé') == -1) {
                            asValidate += 1;
                            pictoUser.src = "images/pictos/valid.svg";
                            pictoUser.style.display = 'block';
                            textUser.blur();
                            firstSelect.innerText = seekEmailInString(xhttp.responseText);
                            firstSelect.style.fontSize = '11px';
                                divEmail.innerHTML = '<p>' + errorDiv.textContent + '</p>';
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
                                        createResponseHeaderType(event.target.name);
                                });
                            }
                            //Qualities
                            for (let i = 0; i < qualityButtons.length; i++) {
                                qualityButtons[i].addEventListener('click', function (event) {
                                    removePushedQualityClass();
                                    qualityButtons[i].classList.add('btn-white-clicked2');
                                    qualityButtons[i].classList.remove('btn-white2');
                                    let nameId = qualityButtons[i].name;
                                    let radioTarget = document.getElementById(nameId);
                                    radioTarget.checked = true;
                                    quality = i + 1;
                                    getValue();
                                    createResponseHeaderQualities(event.target.name);
                                });
                            }
                        }
                        else {
                            pictoUser.src = "images/pictos/warning.svg";
                            pictoUser.style.display = 'block';
                        }
                    }
                    else if (xhttp.responseText == '<p>Cet utilisateur n\'existe pas</p>') {
                        pictoUser.src = "images/pictos/invalid.svg";
                        pictoUser.style.display = 'block';
                        if (asValidate >= 1 && textUser.value.length == 4) {
                            //if the user has find a good result and second result is false;
                            window.location.reload(true);
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
            header.style.paddingTop = '4.49vh';
            let imgLogo2 = document.querySelector('.logo img');
            for (let i = 0; i < steps.length; i++) {
                if (i == 0) {
                    let headerHeight = header.offsetHeight;
                    steps[i].style.marginTop = currentMarginTop + headerHeight + 'px';
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
            steps[0].style.marginTop = currentMarginTop + 'px';
            firstSelect.innerText = 'Nouvelle saisie';
            firstSelect.style.fontSize = '14px';
            //Dodge the dom exception
            try {
                open2.insertAdjacentElement('afterend', imgLogo);
                let responseType = document.querySelector('.response-types');
                let responseQualities = document.querySelector('.response-qualities');
                if (responseType != null) {
                    responseType.insertAdjacentElement('beforebegin', firstSelect);
                }
                else if (responseQualities != null) {
                    responseQualities.querySelector('.logo').insertAdjacentElement('beforebegin', firstSelect);
                }
                else {
                    document.querySelector('.logo').insertAdjacentElement('afterend', firstSelect);
                }

            }
            catch (e) {
            }
            imgLogo.style.marginTop = imgcurrentMarginTop + 'px';
            firstSelect.style.marginTop = firstSelectcurrentMarginTop + 'px';


            let searchDiv = document.querySelector('.response-header');
            if (searchDiv != null) {
                document.querySelector('.header').appendChild(searchDiv);
            }
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
            qualityButtons[i].classList.remove('btn-white-clicked2');
            qualityButtons[i].classList.add('btn-white2');
            let nameId = qualityButtons[i].name;
            let radioTarget = document.getElementById(nameId);
            radioTarget.checked = false;
        }
    }

    function getValue() {
        if (type > 0 && quality > 0) {
            divSubmit.addEventListener('click', function () {
                btnSubmit.click();
            });
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {

                    let searchDiv = document.querySelector('.recompense-sardines');
                    let div;
                    let p;
                    if (searchDiv != null) {
                        header.removeChild(searchDiv);
                    }
                    div = document.createElement('div');
                    div.classList.add('recompense-sardines');

                    p = document.createElement('p');
                    p.innerHTML = 'Récompense de : ' + this.responseText + ' sardines';
                    div.appendChild(p);
                    header.appendChild(div);
                }
            };
            xhttp.open("POST", "./traitements/valueqt.php", true); //True = async
            //encodage du formulaire
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("type=" + type + "&quality=" + quality);

        }
    }

    function createResponseHeaderType(name) {

        let searchDiv = document.querySelector('.response-types');
        let img;
        let p;
        let div;
        let divResponseHeader;
        if (searchDiv == null) {
            divResponseHeader = document.createElement('div');
            divResponseHeader.classList.add('response-types');

            img = document.createElement('img');
            p = document.createElement('p');
            div = document.createElement('div');
        }
        else if (searchDiv) {
            img = searchDiv.querySelector('img');
            p = searchDiv.querySelector('p');
            div = searchDiv.querySelector('div');
        }


        if (name == 'tente') {
            img.src = "images/pictos/tent.svg";
            img.alt = name;
            p.innerHTML = 'Vous avez selectionné <br/>tente';
        }
        else if (name == 'sacDeCouchage') {
            img.src = "images/pictos/sleeping_bag.svg";
            img.alt = name;
            p.innerHTML = 'Vous avez selectionné <br/>sac de couchage';
        }
        else if (name == 'chaise') {
            img.src = "images/pictos/chair.svg";
            img.alt = name;
            p.innerHTML = 'Vous avez selectionné <br/>chaise';
        }
        else if (name == 'matelas') {
            img.src = "images/pictos/mattress.svg";
            img.alt = name;
            p.innerHTML = 'Vous avez selectionné <br/>matelas';
        }
        if (searchDiv == null) {
            divResponseHeader.appendChild(img);
            divResponseHeader.appendChild(p);
            divResponseHeader.appendChild(div);

            header.appendChild(divResponseHeader);
        }
    }

    function createResponseHeaderQualities(name) {
        let searchDiv = document.querySelector('.response-qualities');
        let img;
        let p;
        let div;
        let divResponseHeader;
        if (searchDiv == null) {
            divResponseHeader = document.createElement('div');
            divResponseHeader.classList.add('response-qualities');

            img = document.createElement('img');
            p = document.createElement('p');
            div = document.createElement('div');
        }
        else if (searchDiv) {
            img = searchDiv.querySelector('img');
            p = searchDiv.querySelector('p');
            div = searchDiv.querySelector('div');
        }

        if (name == 'mauvaise') {
            img.src = "images/pictos/mauvais.svg";
            img.alt = name;
            p.innerHTML = 'En mauvais état';
        }
        else if (name == 'bonne') {
            img.src = "images/pictos/bon.svg";
            img.alt = name;
            p.innerHTML = 'En bon état';
        }
        else if (name == 'excellente') {
            img.src = "images/pictos/excellent.svg";
            img.alt = name;
            p.innerHTML = 'En excellent état';
        }
        if (searchDiv == null) {
            divResponseHeader.appendChild(img);
            divResponseHeader.appendChild(p);
            divResponseHeader.appendChild(div);

            header.appendChild(divResponseHeader);
        }
    }
    function seekEmailInString(string) {
        return string.match(/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi);
    }
})();
