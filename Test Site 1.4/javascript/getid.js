var cards = [];
for (var i = 0; i < 7; i++) {
  cards[i];
  console.log(cards[i])
  var ids = document.getElementById([i]);
  ids.addEventListener('click', function () {
   
    var SelectedNews = this.id;
    fds = document.getElementById("fake") //  fazer variavel de sessão para armazenar o valor da noticia selecionada / 
    fds.setAttribute("value", SelectedNews)
    sdf = document.getElementById("cardForm");
    sdf.submit();
  });
}