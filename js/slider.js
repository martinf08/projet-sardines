(function () {
    let dots = document.querySelectorAll('.slider-navigation-item');
    let leftArrow = document.getElementById('left-arrow');
    let rightArrow = document.getElementById('right-arrow');
    let slider = document.querySelector('.slider');

    let range = 0;
    colorDot();
    rightArrow.addEventListener('click', function () {
        if (range - 100 >= -500) {
            range = range - 100;
            slider.style.transform = 'translateX(' + range + 'vw)';
            defaultDots();
            colorDot()
        }
    });
    leftArrow.addEventListener('click', function () {
        if (range + 100 <= 0) {
            range = range + 100;
            slider.style.transform = 'translateX(' + range + 'vw)';
            defaultDots();
            colorDot()
        }
    });
    for (let i = 0; i < dots.length; i++) {
        dots[i].addEventListener('click', function (event) {
            defaultDots();
            let target = i + 1;
            switch (target) {
                case 1:
                    range = 0;
                    break;
                case 2:
                    range = -100;
                    break;
                case 3:
                    range = -200;
                    break;
                case 4:
                    range = -300;
                    break;
                case 5:
                    range = -400;
                    break;
                case 6:
                    range = -500;
                    break;
                default:
                    return false;
            }
            event.target.style.backgroundColor = 'white';
            slider.style.transform = 'translateX(' + range + 'vw)';

        });
    }

    function colorDot() {
        let dot = 0;
        switch (range) {
            case 0:
                dot = 0;
                break;
            case -100:
                dot = 1;
                break;
            case -200:
                dot = 2;
                break;
            case -300:
                dot = 3;
                break;
            case -400:
                dot = 4;
                break;
            case -500:
                dot = 5;
                break;
            default:
                return false;
        }
        dots[dot].style.backgroundColor = 'white';
    }

    function defaultDots() {
        for (let y = 0; y < dots.length; y++) {
            dots[y].style.backgroundColor = '#0cd18f';
        }
    }
})();