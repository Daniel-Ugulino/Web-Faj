/**
 * 
 */
var selecionadovisitante=0;
var selecionadoviatura=0;
var veiculo_visitante=0;

$(document).ready(function(){
	$("#placa").mask('AAA-0000');
	$("#placa").focusout(function(){
		$.ajax({
			type:"POST",
			url:"PHP/cad_veiculo_visitante.php",
			data:{op:"verificar",placa:$(this).val()},
			success:function(data){
				if (data.resposta=="existe"){
					$("#placa").attr("disabled");
					$("#descricao_veiculo").val(data.descricao);
					$("#descricao_veiculo").attr("disabled");
					veiculo_visitante=data.id;
				}else{
					veiculo_visitante=0;
				}
			}
		});
	});
	
	$("#btn_cad").click(function(){
		location.href="cadastro_visitante.php";
	});
/*	
    $("#dialog-confirm").dialog({
		dialogClass: "no-close",
		resizable: false,
        height: "auto",
        modal: true,
		show: { effect: "blind", duration: 200 },
		hide: { effect: "blind", duration: 200 },
		classes:{
		    //"ui-dialog": "modal",
		    "ui-dialog-titlebar": "modal-header",
		    "ui-dialog-title": "modal-title",
		    "ui-dialog-titlebar-close": "close",
		    "ui-dialog-content": "modal-body",
		    "ui-dialog-buttonpane": "modal-footer"
		},
		autoOpen: false,
		width: 300,
		buttons: {
	          "Sim": function() {
	            $( this ).dialog( "close" );
	          },
	          "Não": function() {
	            $( this ).dialog( "close" );
	          }
	     },
		open: function(event,ui){
			$('.ui-dialog-buttonset').addClass('btn-group');
			$('.ui-dialog-buttonset button').addClass('btn btn-default btn-sm');
			$('.ui-dialog-titlebar-close').removeClass("ui-dialog-titlebar-close").html('<button type="button" class="close" data-dismiss="modal">&times;</button>');
			$('.ui-dialog-titlebar-close').removeClass("ui-dialog-titlebar-close").html('<button type="button" class="close" data-dismiss="modal">&times;</button>');
		}
	});*/
	$("#btn_reset").click(function(){
		//AO RESETAR O FORMULARIO RETIRAR AS CLASSES DE ALTERAÇÃO DE COR DOS INPUTS CPF, RG E PLACA
		$(".placa-caixa").removeClass("has-error");
		$(".placa-gliphi").removeClass("glyphicon-remove");
		$(".placa-caixa").removeClass("has-success");
		$(".placa-gliphi").removeClass("glyphicon-ok");
		$(".rg-caixa").removeClass("has-success");
		$(".rg-gliphi").removeClass("glyphicon-ok");
		$(".rg-caixa").removeClass("has-error");
		$(".rg-gliphi").removeClass("glyphicon-remove");
		$(".cpf-caixa").removeClass("has-success");
		$(".cpf-gliphi").removeClass("glyphicon glyphicon-ok");
		$(".cpf-caixa").removeClass("has-error");
		$(".cpf-gliphi").removeClass("glyphicon glyphicon-remove");
	});
	
	$("#modal_sim").click(function(){
		$("#btn_reset").click();
		$("#modal_confirmacao").modal("hide");
	});
	$("#modal_nao").click(function(){
		location.href="principal.php";
	});
	
	
	
	$("#form-registro-visitante").submit(function(){
	   $.ajax({
           type:"POST",
           url:"PHP/registro_visitante.php",
           cache:false,
           dataType: "json",
           data:{
               op:"verificar",
               cpf:$("#modal_cpf").val()
           },
           success: function(data){
            if (data=="false"){
             if ($("#placa").val()!=""){
				$.ajax({
					type:"POST",
					url:"PHP/cad_veiculo_visitante.php",
					cache:"false",
					data:{
						op:"cadastrar",
						placa:$("#placa").val(),
						descricao:$("#descricao").val(),
						cpf:$("#modal_cpf").val()
					},
					success: function(data){
						
					}
				});
				
				$.ajax({
					type:"POST",
					url:"PHP/registro_visitante.php",
					cache:"false",
					data:{
						op:"cadastro",
						visitante:$("#modal_cpf").val(),
						setor:$("#setor").val(),
						cracha:$("#cracha").val(),
						contato:$("#contato").val(),
						obs:$("#obs").val(),
						veiculo:$("#placa").val()
					},
					success:function(data){
					
					}
				});				
			}else{
				$.ajax({
					type:"POST",
					url:"PHP/registro_visitante.php",
					cache:"false",
					data:{
						op:"cadastro",
						visitante:$("#modal_cpf").val(),
						setor:$("#setor").val(),
						cracha:$("#cracha").val(),
						contato:$("#contato").val(),
						obs:$("#obs").val()
					},
					success:function(data){
					
					}
				});
                $("#modal_confirmacao").modal({backdrop: "static"});
			}   
            }else{
                alert("Visitante ja se encontra registrado como visita em andamento");
            }
       }
       });
        /*if (veiculo_visitante!=0){
			$.ajax({
				type:"POST",
				url:"PHP/registro_visitante.php",
				cache:"false",
				data:{
					op:"cadastro",
					visitante:$("#modal_cpf").val(),
					setor:$("#setor").val(),
					cracha:$("#cracha").val(),
					contato:$("#contato").val(),
					obs:$("#obs").val(),
					veiculo:veiculo_visitante
				},
				success:function(data){
					
				}
			});
			}else{*/
        //Olha eu aqui
        /*
			if ($("#placa").val()!=""){
				$.ajax({
					type:"POST",
					url:"PHP/cad_veiculo_visitante.php",
					cache:"false",
					data:{
						op:"cadastrar",
						placa:$("#placa").val(),
						descricao:$("#descricao").val(),
						cpf:$("#modal_cpf").val()
					},
					success: function(data){
						
					}
				});
				
				$.ajax({
					type:"POST",
					url:"PHP/registro_visitante.php",
					cache:"false",
					data:{
						op:"cadastro",
						visitante:$("#modal_cpf").val(),
						setor:$("#setor").val(),
						cracha:$("#cracha").val(),
						contato:$("#contato").val(),
						obs:$("#obs").val(),
						veiculo:$("#placa").val()
					},
					success:function(data){
					
					}
				});				
			}else{
				$.ajax({
					type:"POST",
					url:"PHP/registro_visitante.php",
					cache:"false",
					data:{
						op:"cadastro",
						visitante:$("#modal_cpf").val(),
						setor:$("#setor").val(),
						cracha:$("#cracha").val(),
						contato:$("#contato").val(),
						obs:$("#obs").val()
					},
					success:function(data){
					
					}
				});		
			}*/

		//}
		return false;
	});
});