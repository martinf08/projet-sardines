(function () {
    let slider = document.querySelector('.slider');
    let sliderInfoT = document.querySelectorAll('.slider-info-top');
    let sliderInfoB = document.querySelectorAll('.slider-info-bottom > p');
    let pageInfo = document.querySelectorAll('.page-info');
    let arrowNext = document.querySelector('.arrow-next');
    let arrowBack = document.querySelector('.arrow-back');
    let cookieBtn = document.getElementById('accept-cookie');
    let range = 0;
    if (range == 0) {
        arrowBack.style.height = '0';
    }
    let touchXStart;
    let touchXEnd;
    let arrowNxt;
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
            if (e.target.className == "arrow-next") {
                arrowNxt = e.target.className;

            }
            else if (e.target.className == 'arrow-back') {
                arrowBrb = e.target.className;
            }

        });

        slider.addEventListener('touchmove', function touchMove(e) {
            touchXEnd = e.touches[0].clientX;
        });

        slider.addEventListener('touchend', function touchEnd(e) {
            if (arrowNxt == 'arrow-next') {
                if (range == -200) {
                    window.location='welcome';
                }
                nextSlider();
                arrowNxt = '';

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
        arrowNext.addEventListener('click', function () {

            if (range == -200) {
                window.location='welcome';
            }
            nextSlider();
        });
        arrowBack.addEventListener('click', function () {
            prevSlider();
        });
    }


    function nextSlider() {
        if (range - 100 >= -200) {
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
        let value = "; " + document.cookie;
        let parts = value.split("; " + name + "=");
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
                default:
                    return false;
            }
            return index;
        }
    }

})();