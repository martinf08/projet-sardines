(function () {
    let leftArrow = document.getElementById('left-arrow');
    let rightArrow = document.getElementById('right-arrow');
    let slider = document.querySelector('.slider');

    let range = 0;
    colorDot();
    rightArrow.addEventListener('click', function () {
        if (range - 100 >= -500) {
            range = range - 100;
            slider.style.transform = 'translateX(' + range + 'vw)';
        }
    });
    leftArrow.addEventListener('click', function () {
        if (range + 100 <= 0) {
            range = range + 100;
            slider.style.transform = 'translateX(' + range + 'vw)';
        }
    });
})();