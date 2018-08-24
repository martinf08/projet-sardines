(function() {
    let inputPseudo = document.getElementById("pseudo-account");
    if (inputPseudo != null) {
       inputPseudo.addEventListener('focus', function (e) {
           this.placeholder = "";

           this.style.borderBottom = '1px solid #2489B4';
       });
       inputPseudo.addEventListener('blur', function (e) {
           this.placeholder = "modifier le pseudo";
           this.style.borderBottom = "none";
       })
    }
})();