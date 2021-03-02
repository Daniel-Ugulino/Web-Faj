
function File_Name() {
    var filename = document.getElementById("news-file");
    var filelabel = document.getElementById("filelabel");
    var sla = filename.files[0].name;

    filelabel.innerHTML = sla
}