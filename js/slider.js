(function () {
    let slider = document.querySelector('.slider');
    let button = document.querySelector('button');
    let sliderInfoT = document.querySelectorAll('.slider-info-top');
    let sliderInfoB = document.querySelectorAll('.slider-info-bottom > p');
    let pageInfo = document.querySelectorAll('.page-info');
    let arrowBack = document.querySelector('.arrow-back');
    let cookieBtn = document.getElementById('accept-cookie');
    let range = 0;
    if (range == 0) {
        arrowBack.style.height = '0';
    }
    let touchXStart;
    let touchXEnd;
    let btnNext;
    let arrowBrb;

    slider.addEventListener('touchstart', function touchStart(e) {
        touchXStart = e.touches[0].clientX;
        if (e.target.nodeName == "BUTTON") {
            btnNext = e.target.nodeName;
            e.target.classList.remove('btn-outlined-2');
            e.target.classList.add('active-btn');

        }
        else if (e.target.className == 'arrow-back') {
            arrowBrb = e.target.className;
        }

    });

    slider.addEventListener('touchmove', function touchMove(e) {
        touchXEnd = e.touches[0].clientX;
    });

    slider.addEventListener('touchend', function touchEnd(e) {
        if (btnNext == "BUTTON") {
            swipeLeftToRight();
            btnNext = '';
            e.target.classList.add('btn-outlined-2');
            e.target.classList.remove('active-btn');


        }
        else if (arrowBrb == 'arrow-back') {
            swipeRightToLeft();
            arrowBrb = '';
        }

        else if (touchXStart > touchXEnd) {
            swipeLeftToRight();
        }
        else if (touchXStart < touchXEnd) {
            swipeRightToLeft();
        }
    });


    function swipeLeftToRight() {
        if (range - 100 >= -500) {
            range = range - 100;
            if (range < 0) {
                arrowBack.style.height = '15px';
            }
            sliderInfoT[indexSlider()].style.transform = 'translateX(' + range + 'vw)';
            sliderInfoB[indexSlider()].style.transform = 'translateX(' + range + 'vw)';
            pageInfo[indexSlider()].style.transform = 'translateX(' + range + 'vw)';

            sliderInfoT[indexSlider() - 1].style.transform = 'translateX(' + range + 'vw)';
            sliderInfoB[indexSlider() - 1].style.transform = 'translateX(' + range + 'vw)';
            pageInfo[indexSlider() - 1].style.transform = 'translateX(' + range + 'vw)';


            if (range == -500) {
                button.textContent = "Commencer";
                //Redirection Page Accueil
            }
        }
    }

    function swipeRightToLeft() {
        if (range + 100 <= 0) {
            if (range == -100) {
                arrowBack.style.height = '0';
            }
            range = range + 100;
            sliderInfoT[indexSlider()].style.transform = 'translateX(' + range + 'vw)';
            sliderInfoB[indexSlider()].style.transform = 'translateX(' + range + 'vw)';
            pageInfo[indexSlider()].style.transform = 'translateX(' + range + 'vw)';

            sliderInfoT[indexSlider() + 1].style.transform = 'translateX(' + range + 'vw)';
            sliderInfoB[indexSlider() + 1].style.transform = 'translateX(' + range + 'vw)';
            pageInfo[indexSlider() + 1].style.transform = 'translateX(' + range + 'vw)';
            if (range == -400) {
                button.textContent = "Suivant";
            }
        }
    }

    if (cookieBtn != null) {
        cookieBtn.addEventListener('click', function () {
            setCookie();
            document.querySelector('.cookie').style.display = 'none';
        });
    }

    function setCookie() {
        let date = new Date();
        date.setTime(date.getTime() + (86400 * 30));
        let expires = "expires=" + date.toUTCString();
        document.cookie = 'cookie=1;' + expires + ';path=/';
    }

    function indexSlider() {
        if (range != null) {
            let index = 0;
            switch (range) {
                case 0:
                    index = 0;
                    break;
                case -100:
                    index = 1;
                    break;
                case -200:
                    index = 2;
                    break;
                case -300:
                    index = 3;
                    break;
                case -400:
                    index = 4;
                    break;
                case -500:
                    index = 5;
                    break;
                default:
                    return false;
            }
            return index;
        }
    }

})();