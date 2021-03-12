$("#cadastrar").submit(function (e) {
	var newsData = new FormData(document.getElementById("cadastrar"));
	newsData.append('op', 'news-create');

	e.preventDefault();
	$.ajax({
		type: "POST",
		url: "php/functions.php",
		data: newsData,
		processData: false,
		cache: false,
		contentType: false,
		success: function (data) {
			alert("Noticia criada com sucesso");
			
		}, error: function (xhr, ajaxOptions, thrownError) {
			alert("ERROR:" + xhr.responseText + " - " + thrownError);
		}
	});
});


$("#login").submit(function (e) {

	e.preventDefault();
	$.ajax({
		type: "POST",
		url: "php/functions.php",
		data: {
			op: "logar",
			usuario: $("#username").val(),
			senha: $("#Stitulo").val(),
		},
		success: function (data) {
			alert("Noticia criada com sucesso");
		}, error: function (xhr, ajaxOptions, thrownError) {
			alert("ERROR:" + xhr.responseText + " - " + thrownError);
		}
	});
});


$(document).ready(function () {
	setInterval( function () {
		listar_noticia();
	}, 15000 );
	function listar_noticia() {
		$.ajax({
			type: "POST",
			url: "php/functions.php",
			data: { op: "news_menu_carrousel" },
			datatype: "html",
			success: function (data) {
				$("#Carrousel_News").html(data);
			}
		});
		$.ajax({
			type: "POST",
			url: "php/functions.php",
			data: { op: "news_menu_card" },
			datatype: "html",
			success: function (data) {
				$("#Card_News").html(data);
			}
		});
	}
	listar_noticia();
});


var elements = document.getElementsByClassName("news");
console.log(elements);

var myFunction = function () {
	var attribute = this.getAttribute("id");

	$.ajax({
		type: "POST",
		url: "php/functions.php",
		data: {
			op: "news-select",
			id: attribute
		},
		datatype: "html",
		success: function (data) {
			window.location.href = "news.php";
		}
	});
};

for (var i = 0; i < elements.length; i++) {
	elements[i].addEventListener('click', myFunction, false);
}

