let types = document.querySelectorAll("input[name = 'type']");
let qualities = document.querySelectorAll("input[name='quality']");
let typeId;
let qualityId;

for(quality of qualities) {
    quality.addEventListener("click", function() {
        qualityId = this.value;
        for(type of types) {
            if(type.checked) typeId = type.value;
        }
        
        getValue(typeId, qualityId);
    });
}

function getValue(type, quality) {

}