(function () {
    let button = document.querySelector('button');
    let sliderInfoT = document.querySelectorAll('.slider-info-top');
    let sliderInfoB = document.querySelectorAll('.slider-info-bottom');
    let arrowBack = document.querySelector('.arrow-back');

    let range = 0;
    if (range == 0) {
        arrowBack.style.height = '0';
    }

    button.addEventListener('click', function () {
        if (range - 100 >= -500) {
            range = range - 100;
            if (range < 0) {
                arrowBack.style.height = '15px';
            }
            sliderInfoT[indexSlider()].style.transform = 'translateX(' + range + 'vw)';
            sliderInfoB[indexSlider()].style.transform = 'translateX(' + range + 'vw)';

            sliderInfoT[indexSlider() - 1].style.transform = 'translateX(' + range + 'vw)';
            sliderInfoB[indexSlider() - 1].style.transform = 'translateX(' + range + 'vw)';

            if (range == -500) {
                button.textContent = "Commencer";
                //Redirection Page Accueil
            }
        }
    });

    arrowBack.addEventListener('click', function () {

        if (range + 100 <= 0) {
            console.log(range);
            if (range == -100) {
                arrowBack.style.height = '0';
            }
            range = range + 100;
            sliderInfoT[indexSlider()].style.transform = 'translateX(' + range + 'vw)';
            sliderInfoB[indexSlider()].style.transform = 'translateX(' + range + 'vw)';

            sliderInfoT[indexSlider() + 1].style.transform = 'translateX(' + range + 'vw)';
            sliderInfoB[indexSlider() + 1].style.transform = 'translateX(' + range + 'vw)';
        }
    });

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