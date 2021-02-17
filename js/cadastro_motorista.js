var matricula;
var valido=false;
$(document).ready(function(){
	$("#matricula").focusout(function(){
		//SE O VALOR DO CAMPO CPF FOR VAZIO 
		if ($(this).val()==""){
			//ADICIONANDO AS CLASSES "has-error" E "glyphicon-remove" PARA ALTERAR A COR DO INPUT PARA VERMELHO
			$(".matricula-caixa").removeClass("has-success");
			$(".glyphicon-status").removeClass("glyphicon-ok");
			$(".matricula-caixa").addClass("has-error");
			$(".glyphicon-status").addClass("glyphicon-remove");
			$(this).focus();
		}else{
				//AJAX PARA VERIFICAR A EXISTENCIA DE OUTRO NUMERO CPF IGUAL 
				$.ajax({
					type:"POST",
					url:"PHP/cad_motorista.php",
					data:{op:"verificar",mat:$(this).val()},
					success: function(data){
						if (data=="false"){
							//ADICIONANDO AS CLASSES "has-error" E "glyphicon-remove" PARA ALTERAR A COR DO INPUT PARA VERMELHO
							$(".matricula-caixa").addClass("has-error");
							$(".glyphicon-status").addClass("glyphicon-remove");
							$(".matricula-caixa").removeClass("has-success");
							$(".glyphicon-status").removeClass("glyphicon-ok");
							$(".matricula-caixa").popover('show');
							$(this).focus();
							valido=false;
						}else{
							//ADICIONANDO AS CLASSES "has-success" E "glyphicon-ok" PARA ALTERAR A COR DO INPUT PARA VERDE
							$(".matricula-caixa").removeClass("has-error");
							$(".glyphicon-status").removeClass("glyphicon-remove");
							$(".matricula-caixa").addClass("has-success");
							$(".glyphicon-status").addClass("glyphicon-ok");
							$(".matricula-caixa").popover('hide');
							valido=true;
						}
					}
				});
				
			}
	});
	$("#btnreset").click(function(){
		$(".matricula-caixa").removeClass("has-success");
		$(".glyphicon-status").removeClass("glyphicon-ok");
		$(".matricula-caixa").removeClass("has-error");
		$(".glyphicon-status").removeClass("glyphicon-remove");
		
	});
	$("#modal_sim").click(function(){
		$("#btnreset").click();
		$("#modal_confirmacao").modal("hide");
	});
	$("#modal_nao").click(function(){
		location.href="principal.php";
	});
	$("#form_cad_motorista").submit(function(){
		if (valido){
			$.ajax({
				type:"POST",
				url:"PHP/cad_motorista.php",
				data:{op:"cadastrar",matricula:$("#matricula").val(),nome:$("#nome").val()},
				success: function(data){
					$("#modal_confirmacao").modal({backdrop: "static"});
				}
			});
		}else{
			$("#matricula").focus();
		}
		return false;
	});
});