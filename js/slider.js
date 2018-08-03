(function () {
    let button = document.querySelector('button');
    let sliderInfoT = document.querySelectorAll('.slider-info-top');
    let sliderInfoB = document.querySelectorAll('.slider-info-bottom');

    let range = 0;

    button.addEventListener('click', function () {
        if (range - 100 >= -500) {
            range = range - 100;
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

    /*leftArrow.addEventListener('click', function () {
        if (range + 100 <= 0) {
            range = range + 100;
            slider.style.transform = 'translateX(' + range + 'vw)';
        }
    });*/
})();