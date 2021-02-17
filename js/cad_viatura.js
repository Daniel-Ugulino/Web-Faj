/**
 * 
 */
$(document).ready(function(){
	$("#placa").mask('AAA-0000');
	$("#placa").focusout(function(){
		if ($(this).val()==""){
			$(this).focus();
		}else{
			$.ajax({
				type:"POST",
				url:"PHP/cadastro_viatura.php",
				data:{op:"verificarplaca",placa:$(this).val()},
				success: function(data){
					if (data=="Existe"){
						$(".placa-caixa").addClass("has-error");
						$(".placa-gliphi").addClass("glyphicon-remove");
						$(".placa-caixa").removeClass("has-success");
						$(".placa-gliphi").removeClass("glyphicon-ok");
						$(this).focus();
					}else{
						$(".placa-caixa").removeClass("has-error");
						$(".placa-gliphi").removeClass("glyphicon-remove");
						$(".placa-caixa").addClass("has-success");
						$(".placa-gliphi").addClass("glyphicon-ok");
					}
				}
			});
		}
	});
	$("#reset").click(function(){
		$(".placa-caixa").removeClass("has-success");
		$(".placa-gliphi").removeClass("glyphicon-ok");
		$(".placa-caixa").removeClass("has-error");
		$(".placa-gliphi").removeClass("glyphicon-remove");
	});
	
	$("#form-cad-viatura").submit(function(){
		var cpf_texto=$("#placa").val();
		if (cpf_texto.length<8){
			alert("Campo placa incorreto");
			$(".placa-caixa").addClass("has-error");
			$(".placa-gliphi").addClass("glyphicon-remove");
			$(".placa-caixa").removeClass("has-success");
			$(".placa-gliphi").removeClass("glyphicon-ok");
			$("#placa").focus();
		}else{
			$.ajax({
				type:"POST",
				url:"PHP/cadastro_viatura.php",
				data:{op:"cadastrar",descricao:$("#descricao").val(),placa:$("#placa").val()},
				success: function(data){
					$("#reset").click();
					alert(data);
				}
			});
		}
		return false;
	});
});