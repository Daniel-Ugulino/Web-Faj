
$("#cadastrar").submit(function (e) {
	var newsform = new FormData();
	e.preventDefault();
	$.ajax({
		type: "POST",
		url: "php/functions.php",
		data: {
			op: "news-create",
			Titulo: $("#titulo").val(),
			Stitulo: $("#Stitulo").val(),
			file: $("#news-file").val(),
			images: $("#news-image").val(),
			p1noticia: $("#p1-noticia").val(),
			p2noticia: $("#p2-noticia").val(),
		},
		success: function (data) {
			alert("Noticia criada com sucesso");
		}, error: function (xhr, ajaxOptions, thrownError) {
			alert("ERROR:" + xhr.responseText + " - " + thrownError);
		}
	});
});


$("#login").submit(function (e) {
	var newsform = new FormData();
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
			success: function (data) {
				$("#noticia").load(data);
			}
		});
	}
	listar_noticia();
});
	// $(document).ready(function(){
// 	function listar_noticia() {
// 		$.ajax({
// 			type: "POST",
// 			url: "php/insertnews.php",
// 			data:
// 			{
// 				op: "listar_viaturas"
// 			},
// 			success: function (data) {
// 				$('#lista_viaturas').html(data);
// 			}
// 		})
// 	}
// });
