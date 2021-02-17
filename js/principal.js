/**
 * 
 */
var selecionadovisitante=0;
var selecionadoviatura=0;
var veiculo_visitante=0;


$(".modal_footer_viatura").hide();

$(document).ready(function(){
	function listarvisitante(){
		$.ajax({
			type :"POST",
			url:"PHP/inicio.php",
			data:{op:"listarvisitante"},
			datatype:"html",
			success: function(data){
				$(".mov_visitante").html(data);
			}
		});	
	}
	function listarmotorista(){
		$.ajax({
			type:"POST",
			url:"PHP/inicio.php",
			data:{op:"listarviaturas"},
			datatype:"html",
			success: function(data){
				$(".mov_viatura").html(data);
			}
		});
	}
	listarvisitante();
	listarmotorista();
	$("#hora_retorno_viatura").mask('00:00',{reverse:true});
	
	$(".mov_visitante").on('click', 'tr', function () {
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
	});

	/*Bloco Novo */
	$(".mov_viatura").on('click', 'tr', function () {
		if ($(this).hasClass("selecionado")){
			/*	$("tr").removeClass("selecionado");
			selecionadovisitante=0;
			Teste para o registro total pagina nova */
			/*alert(selecionadovisitante);*/
			/*$.ajax({
				type:"POST",
				url:"PHP/retorno_registro.php",
				data:{op:"criar_selecionado",id:selecionadovisitante},
				success:function(data){
					if (data=="criado"){
						location.href="form_visitante.php";
					}
				}
			});*/
		
		}else{
			$("tr").removeClass("selecionado");
			$(this).toggleClass("selecionado");
			selecionadoviatura=$(this).attr("id");
		}		
	});	
	
	$("#btn_retorno_viatura").click(function(){
		if (selecionadoviatura==0){
			$("#modal_aviso").modal({backdrop:"static"});
		}else{
			$("#modal_registro_viatura").modal({backdrop: "static"});	
		}
		return false;
	});
    $("#btn_saida_viatura").click(function(){
        location.href="saida_viatura.php";
        return false;
	});
	$("#form-registro-viatura").submit(function(){
	    $.ajax({
			type:"POST",
			url:"PHP/retorno_registro.php",
			data:{
				op:"registrar_retorno",
				id:selecionadoviatura,
				hora:$("#hora_retorno_viatura").val(),
				km:$("#km_retorno_viatura").val()
			},
			success:function(data){
                if (data=='ok'){
                    $("#hora_retorno_viatura").val('');
                    $("#km_retorno_viatura").val('');
                    $(".modal_footer_viatura").hide();
                    $("#modal_registro_viatura").modal("hide");
		            listarmotorista();
                }else{
                   alert("Kilometragem de retorno menor ou igual a saida, por favor verifique e tente novamente"); 
                }
                /*	if (data=="registrado"){
                        $("#modal_confirmacao").modal("hide");
                    }*/
			}
		});
		//$("#modal_confirmacao").modal("hide");
		listarmotorista();
		return false;
	});
	
	$("#btn-viatura-sim").click(function(){
		$(".modal_footer_viatura").slideDown("slow");
	});
	$("#btn-viatura-nao").click(function(){
		$(".modal_footer_viatura").hide();
		$("#hora_retorno_viatura").val('');
	});
	$("#btn_nao_retorno").click(function(){
		$(".modal_footer_viatura").hide();
		$("#hora_retorno_viatura").val('');
	});
	
	/*$('[data-toggle="tooltip"]').tooltip();*/
	
	/*----------------------------------------*/
	$("#btn-saida-visitante").click(function(){
		if (selecionadovisitante!=0){
			$.ajax({
				type:"POST",
				url:"PHP/inicio.php",
				data:{op:"registrar-saida",id:selecionadovisitante},
				datatype:"html",
				success: function(data){
					$(".mov_visitante").html(data);
				}
			});
		}else{
			$("#modal_aviso").modal({backdrop:"static"});
		}
	});
});