/**
 * 
 */
$(document).ready(function(){
	var veiculo;
    var data_saida;
    $.ajax({
		type:"POST",
		url:"PHP/retorno_registro.php",
		data:{op:"retornar_registro"},/*
        dataType: 'json',*/
		success:function(data){
            $(".cpf").html("&nbsp;&nbsp;&nbsp;&nbsp;"+data.cpf);/*$(".cpf").html()+"&nbsp;&nbsp;"+*/
			$(".nome").html("&nbsp;&nbsp;&nbsp;&nbsp;"+data.nome);/*$(".nome").html()+"  "+*/
			$(".empresa").html("&nbsp;&nbsp;&nbsp;&nbsp;"+data.empresa);/*$(".empresa").html()+"  "+*/
			$(".setor").html("&nbsp;&nbsp;&nbsp;&nbsp;"+data.setor);
			$(".contato").html("&nbsp;&nbsp;&nbsp;&nbsp;"+data.contato);
			if (data.veiculo==null){
                veiculo="Não houve veiculo cadastrado";
            }else{
                veiculo=data.veiculo;
            }
            if (data.saida==null){
                data_saida="Não registrada a saida deste visitante";
            }else{
                data_saida=data.saida;
            }
            $(".veiculo").html("&nbsp;&nbsp;&nbsp;&nbsp;"+veiculo);
			$(".entrada").html("&nbsp;&nbsp;&nbsp;&nbsp;"+data.entrada);
			$(".saida").html("&nbsp;&nbsp;&nbsp;&nbsp;"+data_saida);
			$(".foto").html("<img class=foto_visitante src='"+(data.foto)+"'>");			
		}
	});
    $("#btn-voltar").click(function(){
       location.href="entrada_visitante.php"; 
    });
    
});