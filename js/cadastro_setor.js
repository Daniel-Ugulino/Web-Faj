/**
 * 
 */
var verificar_setor;

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	$("#form-cad-setor").submit(function(){
		$.ajax({
			type:"POST",
			url:"PHP/cad_setor.php",
			data:{op:"verificar",descricao:$("#descricao").val()},
			success:function(data){
				if (data=="Existe"){
					verificar_setor=false;
					$("#descricao").focus();
					alert("Setor ja cadastrado");
				}else{
					verificar_setor=true;
				}
			}
		});
		
		
		if (verificar_setor){
			$.ajax({
				type:"POST",
				url:"PHP/cad_setor.php",
				data: {op: "cadastro",descricao:$("#descricao").val()},
				success: function(data){
					alert(data);
				}
			});
			
		}
		verificar_setor=false;
		return false;
		
	});
});