$("#cadastrar").submit(function (e) {
	var newsData = new FormData(document.getElementById("cadastrar"));
	newsData.append('op','news-create');

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
	function listar_noticia() {
		$.ajax({
			type: "POST",
			url: "php/functions.php",
			data: { op: "news-menu" },
			datatype: "html",
			success: function (data) {
				$("#noticia").load(data);
			}
		});
	}
	listar_noticia();
});
