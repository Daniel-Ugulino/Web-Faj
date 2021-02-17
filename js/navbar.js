/**
 * 
 */
function retornar_imagem($cpf_visitante){
	$.ajax({
		type:"POST",
		url:"PHP/registro_visitante.php",
		cache:false,
		data:{op:"retornar_imagem",cpf:$cpf_visitante},
		success: function(data){
			$("#foto-visitante").html(data);
		}
	});
}
function listarcracha(){
	$.ajax({
		type:"POST",
		url:"PHP/cadastro_visitante.php",
		cache:false,
		data:{op:"listarcracha"},
		success: function(data){
			$("#cracha").html(data);
		}
	});
}


$(document).ready(function(){	
	$.ajax({
		type:"POST",
		url:"PHP/cadastro_visitante.php",
		cache:false,
		data:{op:"listarsetor"},
		success: function(data){
			$("#setor").html(data);
		}
	});
	$.ajax({
		type:"POST",
		url:"PHP/registro_viatura.php",
		cache:false,
		data:{op:"listar_viaturas"},
		success: function(data){
			$("#modal_viatura_descricao").html(data);
		}
	});
	$.ajax({
		type:"POST",
		url:"PHP/registro_viatura.php",
		cache:false,
		data:{op:"listar_motoristas"},
		success: function(data){
			$("#modal_viatura_motorista").html(data);
		}
	});
	
	listarcracha();
	
	$('[data-toggle="popover"]').popover();
	
	/*
	$(".dropdown").on("show.bs.dropdown" ,function(){
		$("#icone-sistema").css("width","30px");
	});
	$(".dropdown").on("hide.bs.dropdown",function(){
		$("#icone-sistema").css("width","65px");
	});
	*/
	$(".data_modal").mask("00/00/0000",{reverse:true});
	$(".time_modal").mask("00:00");
	
	$("#resetar_modal_visitante").click(function(){
		$("#cpf-caixa-modal").removeClass("has-error");
		$("#cpf-caixa-modal").removeClass("has-success");
		$("#foto-visitante").html("");
		$("#modal_visitante").modal("toggle");
	});
	$("#fechar_modal_visitante").click(function(){
		$("#resetar_modal").click();
	});
	
	
	$("#entrada_visitante").click(function(){
		$("#modal_visitante").modal();
	});
	$("#saida_viaturas").click(function(){
		$("#modal_viaturas").modal();
	});
	
	$(".cpf").mask("000.000.000-00",{reverse:true});
	$("#modal_placa").mask("AAA-0000");
	$("#modal_placa").focusout(function(){
		if ($(this).val()==""){
			$("#cpf-caixa-modal").removeClass("has-success");
			$("#cpf-caixa-modal").addClass("has-error");
			$(this).focus();
		}else{
			$.ajax({
				type:"POST",
				url:"PHP/cadastro_viatura.php",
				data:{op:"verificarplaca",placa:$(this).val()},
				success: function(data){
					if (data=="Existe"){
						$("#placa-caixa-modal").removeClass("has-error");
						$("#placa-caixa-modal").addClass("has-success");
					}else{
						$("#placa-caixa-modal").removeClass("has-success");
						$("#placa-caixa-modal").addClass("has-error");
					}
				}
			});
			
		}
	});
	$("#modal_cpf").focusout(function(){
		if ($(this).val()==""){
			$("#cpf-caixa-modal").removeClass("has-success");
			$("#cpf-caixa-modal").addClass("has-error");
			$(this).focus();
		}else{
			$.ajax({
				type:"POST",
				url:"PHP/cadastro_visitante.php",
				data:{op:"verificarCPF",cpf:$(this).val()},
				success: function(data){
					if (data=="Existe"){
						$("#cpf-caixa-modal").removeClass("has-error");
						$("#cpf-caixa-modal").addClass("has-success");
						retornar_imagem($("#modal_cpf").val());
					}else{
						$("#cpf-caixa-modal").removeClass("has-success");
						$("#cpf-caixa-modal").addClass("has-error");
						$("#caixa_confirmacao").dialog("open");
					}
				}
			});
			
		}
	});
	
	$("#barra").on("show.bs.collapse",function(){
		$("#icone-sistema").css("width","45%");
	})
	$("#barra").on("hidden.bs.collapse",function(){
		$("#icone-sistema").css("width","70%");
	})
	
	$("#sair").click(function(){
		$.ajax({
			type:"POST",
			url:"PHP/login.php",
			data:{ op:"logout"},
			success: function(data){
				if (data=true){
					window.location.href="index.php"
				}
			}
		});
		return false;
	});	
});