/**
 * 
 */
var registro_selecionado=0;

function filtro(){
	if (($("#conteudo").val()=="")&&($("#data_inicio").val()=="")&&($("#data_fim").val()=="")&&($("#setor").val()=="")){
		alert("Por favor entre com um ou mais dados para efetuar a pesquisa!");
		$("#conteudo").focus();
	}else{
		$.ajax({
			type:"POST",
			url:"PHP/registro_visitante.php",
			data:{op:"filtro_registro",conteudo:$("#conteudo").val(),datainicio:$("#data_inicio").val(),datafim:$("#data_fim").val(),destino:$("#setor").val()},
			success: function(data){
				$(".tabela_registro").html(data);
			}		
		});
	}
}
function carregar(){
	$.ajax({
		type:"POST",
		url:"PHP/registro_visitante.php",
		data:{op:"registro"},
		success: function(data){
			$(".tabela_registro").html(data);
		}		
	});	
}	

$(document).ready(function(){
	carregar();
	
	$('.calendario').datepicker({
			monthNames: [ "Janeiro", "Feveiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro" ],
			dayNamesMin:[ "Do", "Se", "Te", "Qu", "Qu", "Se", "Sa" ],
			dateFormat: "dd/mm/yy"
		});
	$("tbody").on('click', 'tr', function () {
		if ($(this).hasClass("selecionado")){
			/*	$("tr").removeClass("selecionado");
			selecionadovisitante=0;
			Teste para o registro total pagina nova */
			/*alert(selecionadovisitante);*/
			$.ajax({
				type:"POST",
				url:"PHP/retorno_registro.php",
				data:{op:"criar_selecionado",id:selecionadovisitante},
				success:function(data){
					if (data=="criado"){
						location.href="form_visitante.php";
					}
				}
			});
		
		}else{
			$("tr").removeClass("selecionado");
			$(this).toggleClass("selecionado");
			selecionadovisitante=$(this).attr("id");
		}		
	});;
	
	$("#btn_filtro").click(function(){
		filtro();
	});
	
	$("#btn_cancelar").click(function(){
		$("#conteudo").val("");
		$("#data_inicio").val("");
		$("#data_fim").val("");
		carregar();
	});

});