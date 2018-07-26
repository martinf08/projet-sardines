(function () {
    let links = document.querySelectorAll('a');
    let first = document.getElementById('1');
    let nav = document.getElementsByTagName('nav')[0];

    function smoothScroll(target, speed_millisecond) {
        let range = target.offsetTop - nav.clientHeight;
        let speed = range / speed_millisecond;
        let i = 0;
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

    //smoothScroll(first, 50);
    for (link of links) {
        let attr = link.getAttribute('href').split('#')[1];
        let target = document.getElementById(attr);
        link.addEventListener('click', function () {
            smoothScroll(target, 50)
        })
    }
})();