let types = document.querySelectorAll("input[name='idtype']");
let qualities = document.querySelectorAll("input[name='idquality']");
let sardinesDisplay = document.querySelector("#recompense");
let sardinesVal = document.querySelector("#sardines");
let typeId;
let qualityId;

// on parcourt tous les radios avec name=quality
for(quality of qualities) {
    // on leur donne tous un évènement clic qui sera l'évènement ayant pour rôle
    // de mémoriser les id de type et quality pour les passer à la requête ajax
    quality.addEventListener("click", function() {
        // l'id de quality est facile, il suffit de prendre celui du radio qui
        // est déclenché avec this
        qualityId = this.value;
        // pour type on doit parcourir chaque radio et voir lequel est checked
        for(type of types) {
            if(type.checked) typeId = type.value;
        }
        
        // maintenant qu'on a les id, on les envoie à la requête ajax
        if(typeId) getValue(typeId, qualityId);
    });
}

// la requête doit s'effectuer également quand on revient changer le type après avoir coché une qualité
for(type of types) {
    type.addEventListener("click", function() {
        typeId = this.value;

        for(quality of qualities) {
            if(quality.checked) qualityId = quality.value;
        }
        
        if(qualityId) getValue(typeId, qualityId);
    });
}

function getValue(type, quality) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // ici on applique la valeur rendue par this.responseText au bon input
            sardinesDisplay.innerHTML = this.responseText;
            sardinesVal.value = this.responseText;
        }
    };
    xhttp.open("POST", "./traitements/valueqt.php", true); //True = async
    //encodage du formulaire
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("type=" + type + "&quality=" + quality);
}