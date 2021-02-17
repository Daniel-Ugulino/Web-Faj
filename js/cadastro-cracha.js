/**
 * 
 */
var valido = false;

$(document).ready(function() {
	$("#form-cad-cracha").submit(function() {
		$.ajax({
			type : "POST",
			url : "PHP/cad_cracha.php",
			data : {
				op : "verificar",
				cracha : $("#cracha").val()
			},
			success : function(data) {
				if (data == "true") {
					$(".input-cracha").removeClass("has-error has-success");
					
					valido = true;
				}else{
					$(".input-cracha").removeClass("has-error has-success");
					$(".input-cracha").addClass("has-error");
					$(".feedback-cracha").removeClass("glyphicon glyphicon-remove glyphicon-ok");
					$(".feedback-cracha").addClass("glyphicon glyphicon-remove");
					$('#popover-cracha').popover("show");
					$("#cracha").focus();
				}
			}
		});
		
		
		if (valido) {
			$.ajax({
				type : "POST",
				url : "PHP/cad_cracha.php",
				data : {
					op : "cadastro",
					cracha : $("#cracha").val()
				},
				success : function(data) {
					alert(data);
				}
			});
		}

		return false;
	});
});