(function () {
    let inputFile = document.getElementById('user-img');
    let userIcon = document.getElementById('user-icon');


    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                userIcon.innerHTML ="";
                let img = document.createElement("img");
               img.setAttribute('src', e.target.result);
               img.classList.add('img-inscription');
               userIcon.appendChild(img);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    inputFile.addEventListener('change',function() {
        readURL(this);
    });
})();