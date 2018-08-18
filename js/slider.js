(function () {
    let slider = document.querySelector('.slider');
    let sliderInfoT = document.querySelectorAll('.slider-info-top');
    let sliderInfoB = document.querySelectorAll('.slider-txt');
    let pageInfo = document.querySelectorAll('.page-info');
    let arrowNext = document.querySelector('.arrow-next');
    let arrowBack = document.querySelector('.arrow-back');
    let cookieBtn = document.getElementById('accept-cookie');
    let btnStart = document.getElementById('start');
    let range = 0;
    if (range == 0) {
        arrowBack.style.height = '0';
    }
    let touchXStart;
    let touchXEnd;
    let arrowNxt;
    let arrowBrb;
    let btnS;

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
            else if (e.target.id == 'start') {
                btnS = e.target.id;
                e.target.style.backgroundColor = '#0cd18f';
                e.target.style.color = "#fefefe";
            }

        });

        slider.addEventListener('touchmove', function touchMove(e) {
            touchXEnd = e.touches[0].clientX;
        });

        slider.addEventListener('touchend', function touchEnd() {
            if (arrowNxt == 'arrow-next') {
                nextSlider();
                arrowNxt = '';

            }
            else if (arrowBrb == 'arrow-back') {
                prevSlider();
                arrowBrb = '';
            }
            else if (btnS == 'start') {
                btnStart.style.backgroundColor = '#fefefe';
                btnStart.style.color = "#0cd18f";
                window.location = 'welcome';
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
            nextSlider();
        });
        arrowBack.addEventListener('click', function () {
            prevSlider();
        });
    }

    btnStart.addEventListener('click', function () {
        window.location = 'welcome';
    });


    function nextSlider() {
        if (range - 100 >= -200) {
            range = range - 100;
            if (range < 0) {
                arrowBack.style.height = '15px';
            }
            if (range <= -200) {
                arrowNext.style.height = '0';
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
            if (range => -200) {
                arrowNext.style.height = '15px';
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
        window.location = 'welcome';
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