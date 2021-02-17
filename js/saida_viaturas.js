/**
 * 
 
 */

function gerar_tabela(){
	$.ajax({
		type:"POST",
		url:"PHP/registro_viatura.php",
		data:{op:"registro"},
		success: function(data){
			$("#tabela_viaturas").html(data);
		}
	});
}

$(document).ready(function(){
	$.ajax({
		type:"POST",
		url:"PHP/registro_viatura.php",
		data:{op:"listar_motorista"},
		success: function(data){
			$("#motorista").html(data);
		}
	});
	$.ajax({
		type:"POST",
		url:"PHP/registro_viatura.php",
		data:{op:"listar_viaturas"},
		success: function(data){
			$('#viatura').html(data);
		}
	});
	$('.calendario').datepicker({
		monthNames: [ "Janeiro", "Feveiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro" ],
		dayNamesMin:[ "Do", "Se", "Te", "Qu", "Qu", "Se", "Sa" ],
		dateFormat: "dd/mm/yy"
	});
	gerar_tabela();
	$("#tabela_viaturas").on('click', 'tr', function () {
		$("tr").removeClass("selecionado");
		$(this).toggleClass("selecionado");
		selecionadoviatura=$(this).attr("id");
	});	
	$("#filtrar").click(function(){
		if (($("#motorista").val()=="") && ($("#viatura").val()=="") && ($("#destino").val()=="") && ($("#data_inicio").val()=="") &&($("#data_fim").val()=="")){
			alert("Por favor preencha ou escolha umas das opções para a pesquisa");
			$("#motorista").focus();
		}else{
			
			if (($("#data_inicio").val()=="") && ($("#data_fim").val()!="")){
				$("#data_inicio").focus();
			}else if (($("#data_inicio").val()!="") && ($("#data_fim").val()=="")){
				$("#data_fim").focus();
			}else{
				$.ajax({
					type:"POST",
					url:"PHP/registro_viatura.php",
					data:{op:"filtrar",motorista:$("#motorista").val(),destino:$("#destino").val().toUpperCase(),viatura:$("#viatura").val(),data_inicio:$("#data_inicio").val(),data_fim:$("#data_fim").val()},
					success: function(data){
						$("#tabela_viaturas").html(data);
					}
				});	
			}			
		}
	});
	$("#cancelar").click(function(){
		$("#motorista").val("");
		$("#destino").val("");
		$("#viatura").val("");
		$("#data_inicio").val("");
		$("#data_fim").val("");
		gerar_tabela();
	});
	$("#relatorio").click(function(){
		location.href="rel-viaturas.php";
	});
	
});