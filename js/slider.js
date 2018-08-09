(function () {
    let slider = document.querySelector('.slider');
    let button = document.getElementById('primary-btn-slider');
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

    let is_touch_device = function () {
        try {
            document.createEvent("TouchEvent");
            return true;
        } catch (e) {
            return false;
        }
    };

    if (is_touch_device() === true) {

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
                if (range == -500) {
                    window.location='welcome';
                }
                nextSlider();
                btnNext = '';
                e.target.classList.add('btn-outlined-2');
                e.target.classList.remove('active-btn');
            }
            else if (arrowBrb == 'arrow-back') {
                prevSlider();
                arrowBrb = '';
            }
                //Swipe 50px mini
            else if (touchXStart > touchXEnd) {
                if (touchXStart - touchXEnd >= 50) {
                    nextSlider();
                }
            }
            else if (touchXStart < touchXEnd) {
                if (touchXStart + touchXEnd >= 50) {
                    prevSlider();
                }
            }
        });

    }
    else {
        button.addEventListener('click', function () {

            if (range == -500) {
                window.location='welcome';
            }
            nextSlider();
        });
        arrowBack.addEventListener('click', function () {
            prevSlider();
        });
    }


    function nextSlider() {
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
            }
        }
    }

    function prevSlider() {
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

    if (getCookie('cookie') == 1) {
        window.location='welcome';
    }

    function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    }

    function setCookie() {
        let date = new Date();
        date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
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