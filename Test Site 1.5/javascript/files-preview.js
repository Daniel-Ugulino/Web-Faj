var space = document.getElementById("img-preview");
var input = document.getElementById("news-image");
var preImg = document.getElementById("previews");
var label = document.getElementById("Nimg");
var sla = document.getElementById("sla");

function preview() {
    var reader = new FileReader;
    reader.readAsDataURL(input.files[0])
    reader.onloadend = function (event) {
        preImg.setAttribute("src", event.target.result);
        label.style.display = "none";
        preImg.style.display = "initial";
        console.log(preImg);
    }
}
function deletes() {
    if (preImg.getAttribute("src") != "") {
            var r = window.confirm("Deseja deletar a imagem?");
            if (r == true) {
                preImg.setAttribute("src", "");
                preImg.style.display = "none";
                label.style.display = "initial"
                console.log(preImg);
            }
    }
}

function File_Name() {
    var filename = document.getElementById("news-file");
    var filelabel = document.getElementById("filelabel");
    var sla = filename.files[0].name;
    filelabel.innerHTML = sla
}