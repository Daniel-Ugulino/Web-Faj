var url = window.location.pathname;
var filename = url.substring(url.lastIndexOf('/') + 1);


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
			$("#cadastrar")[0].reset()

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
			senha: $("#key").val(),
		},
		success: function (data) {
			if(data == 1)
			{
				window.location.href = "create-news.php";
			}
			else if (data != 1){
				alert('conta ou senha errada')
			}
		}, error: function (xhr, ajaxOptions, thrownError) {
			alert("ERROR:" + xhr.responseText + " - " + thrownError);
		}
	});
});

if (filename == "main.php") {
	function getids() {
		var elements = document.getElementsByClassName("news");

		for (var i = 0; i < elements.length; i++) {
			elements[i].addEventListener('click', function () {
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
			})
		}
	}
	$(document).ready(function () {
		setInterval(function () {
			listar_noticia();
		}, 90000);

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
				data: {
					op: "news_menu_card",
				},
				datatype: "html",
				success: function (data) {
					$("#Card_News").html(data);
					getids();

				}
			});
		}
		listar_noticia()
	});

	function pagintation() {
		var links = document.getElementsByClassName("page-link");

		for (var i = 0; i < links.length; i++) {
			links[i].addEventListener('click', function () {
				var page = this.getAttribute("id");

				$.ajax({
					type: "POST",
					url: "php/functions.php",
					data: {
						op: "news_menu_card",
						page_index: page,
					},
					datatype: "html",
					success: function (data) {
						$("#Card_News").html(data);
						getids();
					}
				});
			}
			)
		};
	}
	pagintation();
}

if (filename == "news.php") {
	$(document).ready(function () {
		function mostrar_noticia() {
			$.ajax({
				type: "POST",
				url: "php/functions.php",
				data: {
					op: "news-select",
				},
				datatype: "html",
				success: function (data) {
					$("#News_content").html(data);

				}
			});
		}
		mostrar_noticia();
	})
}

