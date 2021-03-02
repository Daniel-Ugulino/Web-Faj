var local = document.getElementById("navbar");

var sidebar = document.createElement("div");
sidebar.setAttribute("id", "sidebar");
var links = [];

for (var i = 0; i < 12; i++) {
    links[i] = document.createElement("a");
    sidebar.appendChild(links[i])
}
links[0].href = "http://10.2.14.89/contracheque"; links[0].text = "ContraCheque";
links[1].href = "https://10.2.14.171/glpi/"; links[1].text = "Sistema de Gestão";
links[2].href = "https://emgepron1.intranet.mb/egpron/aplica/sigdem20/egpron.nsf/Entrada?OpenView"; links[2].text = "Sidgem";
links[3].href = "http://10.2.14.41/ramais/"; links[3].text = "Ramais";
links[4].href = "https://10.210.102.2/owncloud/"; links[4].text = "Engedrive";
links[5].href = "http://10.6.64.10:8080/suporteonline/"; links[5].text = "Suporte Online";
links[6].href = "https://webmail.marinha.mil.br/"; links[6].text = "WebMail";
links[7].href = "Publico.lnk"; links[7].text = "Pasta Publica";
links[8].href = ""; links[8].text = "Plano do dia";
links[9].href = ""; links[9].text = "Sobre a FAJ";
for (var i = 0; i < 8; i++) {
    local.after(sidebar);
}

var bar = document.getElementById("sidebar");
var count = 1;

function ActiveSidebar() {
    if (count == 1) {
        bar.style.width = "175px";
        count = 0;
    }
    else if (count == 0) {
        bar.style.width = "0";
        count = 1;
    }
}