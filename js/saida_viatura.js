/**
 * 
 */
$(document).ready(function(){
	//ajax para listar a descricao das viaturas
	function listar_viaturas(){
		$.ajax({
			type:"POST",
			url:"PHP/registro_viatura.php",
			data:{op:"listar_viaturas"},
			success: function(data){
				$('#lista_viaturas').html(data);
			}
		});
		
	};
	//ajax para listar o nome de motoristas
	function listar_motoristas(){
		$.ajax({
			type:"POST",
			url:"PHP/registro_viatura.php",
			data:{op:"listar_motorista"},
			success: function(data){
				$("#lista_motoristas").html(data);
			}
		});
	};
	listar_viaturas();
	listar_motoristas();
	$("#modal_sim").click(function(){
		$("#btn_reset").click();
		$("#btn-reset-form").click();
		listar_viaturas();
		listar_motoristas();
		$("#modal_confirmacao").modal("hide");
	});
	$("#modal_nao").click(function(){
		location.href="principal.php";
	});
	$("#form_saida_viatura").submit(function(){
		/*var d
		//Verificando se a viatura se encontra fora ou ja retornou
		$.ajax({
			type:"POST",
			url:"PHP/registro_viatura.php",
			data:{op:"disponibilidade",placa:$("#lista_viaturas").val()},
			success:function(data){
				if (data=="disponivel"){
					d=true;
				}else{
					d=false;
				}
			}
		});*/
		/*if (d){*/
			$.ajax({
				type:"POST",
				url:"PHP/registro_viatura.php",
				data:{op:"cadastrar",motorista:$("#lista_motoristas").val(),viaturas:$("#lista_viaturas").val(),material:$("#material").val(),km:$("#km_saida").val(),destino:$("#destino").val()},
				success:function(data){
					$("#modal_confirmacao").modal({backdrop: "static"});
				}
			});
		/*}else{
			alert("Viatura ja se encontra em viajem, por favor entre com outra viatura");
			$("#lista_viaturas").focus();
		}*/
		return false;
	});
});