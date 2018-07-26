(function() {
    let link = document.querySelectorAll('a');
    let second = document.getElementById('2');
    console.log(link);
    console.log(window.innerHeight);
    function smoothScroll(target) {
console.log(target.top);
scrollTo(0, target.top)
    }
    smoothScroll(second);
})();