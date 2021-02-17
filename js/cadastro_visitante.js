/**
 * 
 */
var veiculo=null;
var imagem=null;
var cpf_valido=null;
var rg_valido=true;
var placa_valido=true;

$("#foto_cad_visitante").hide();
$("#row-veiculo").hide();
/*
$("#aviso-cpf-vazio").hide();
$("#aviso-cpf-existente").hide();*/








$(document).ready(function(){
//--------------------------- COMANDOS PARA PEGAR IMAGEM DA WEBCAM -----------------------------------------------------------
		navigator.getMedia = (navigator.getUserMedia ||	navigator.webkitGetUserMedia ||	navigator.mozGetUserMedia || navigator.msGetUserMedia);
		navigator.getMedia (/* permissoes*/	{video: true},/*callbackSucesso*/
				function(localMediaStream) {
					var video = document.querySelector('video');
					video.src = window.URL.createObjectURL(localMediaStream);
					video.onloadedmetadata = function(e) {
						// Faz algo com o vídeo aqui.
					};
				},
				// callbackErro
				function(err) {
					console.log("O seguinte erro ocorreu: " + err);
				}
		);
		//VARIAVEL VIDEO RECEBE A TAG VIDEO ONDE A IMAGEM DA WEBCAM ESTA SENDO EXECUTADA
		var video = document.querySelector('video');
		//VARIAVEL CANVAS RECEBE O VALOR DA TAG CANVAS ONDE A IMAGEM ESTA"
		var canvas = document.querySelector('canvas');
		//FUNÇÃO PARA CAPTURAR A IMAGEM DA WEBCAM
		function capturar_imagem() {
			//VARIAVEL ONDE SERA ARMAZENADA A ALTURA DO VIDEO DA WEBCAM 
			  var altura = $("#video_camera").outerHeight(); //outerHeight() retorna o valor completo do Height inlcuindo o BORDER e o outerHeight(true) retorna com a MARGIN do objeto também
			 //VARIAVEL ONDE SERA ARMAZENADA A LARGURA DO VIDEO
			  var largura = $("#video_camera").outerWidth(); //outerWidth() é o mesmo principio que o outerHeight() só que para a largura do objeto
			  //ATRIBUI O MESMO TAMANHO DO VIDEO AO OBJETO CANVAS PREPARANDO A AREA PARA RECEBER O SNAPSHOT
			  $("#foto_cad_visitante").css('width',largura);
			  $("#foto_cad_visitante").css('height',altura);
			  //"DESENHANDO" A IMAGEM DA WEBCAM NO CANVAS
			  canvas.getContext('2d').drawImage(video,0,0,canvas.width,canvas.height);
			  //TORNANDO O VIDEO DA WEBCAM INVISIVEL E O CANVAS VISIVEL
			  $("#foto_cad_visitante").show();
			  $("#video_camera").hide();
			//VARIAVEL COM A IMAGEM JA CODIFICADA PARA ENVIAR PRO BANCO DE DADOS  
			imagem= canvas.toDataURL("image/jpeg");
		}
//--------------------------- FIM DO BLOCO DE PEGAR IMAGEM DA WEBCAM -----------------------------------------------------------
	
	//BOTÃO ONDE A FUNÇÃO PARA TIRAR FOTO É EXECUTADO
	$("#btn_camera").click(function(){
		capturar_imagem();
		return false;
	});
	//REVERTE A VISIBILIDADE DOS OBJETOS CANVAS E VIDEO 
	$("#btn_cancelar_foto").click(function(){
		$("#foto_cad_visitante").hide();
		$("#video_camera").show();
		return false;
	});
	//MASCARA PARA O CAMPO CPF
	$("#cpf").mask("000.000.000-00",{reverse:true});
	//MASCARA PARA O CAMPO RG
	$("#rg").mask("00.000.000-0",{reverse:true});
	//MASCARA PARA O CAMPO PLACA
	$("#placa").mask('AAA-0000');
	//AJAX PARA RETORNO DO NOME DOS SETORES
	$.ajax({
		type:"POST",
		url:"PHP/cadastro_visitante.php",
		data:{op:"listarsetor"},
		success: function(data){
			$("#setor").html(data);
		}
	});
	//AJAX PARA RETORNO DOS NUMEROS DOS CRACHAS
	$.ajax({
		type:"POST",
		url:"PHP/cadastro_visitante.php",
		data:{op:"listarcracha"},
		success: function(data){
			$("#cracha").html(data);
		}
	});	
	//AO ACESSAR O INPUT DO CPF ESCONDE O POPOVER DE ERRO DE CPF INVALIDO
	$("#cpf").focusin(function(){
		$("#aviso-cpf-vazio").popover("hide");		
	});
	$("#cpf").focusout(function(){
		//SE O VALOR DO CAMPO CPF FOR VAZIO 
		if ($(this).val()==""){
			//ADICIONANDO AS CLASSES "has-error" E "glyphicon-remove" PARA ALTERAR A COR DO INPUT PARA VERMELHO
			$(".cpf-caixa").removeClass("has-success");
			$(".cpf-gliphi").removeClass("glyphicon-ok");
			$(".cpf-caixa").addClass("has-error");
			$(".cpf-gliphi").addClass("glyphicon-remove");
			$(this).focus();
			$("#aviso-cpf-vazio").popover("show");
            cpf_valido=false;
		}else{
			var cpf_texto=$(this).val();
			if (cpf_texto.length<14){
				//ADICIONANDO AS CLASSES "has-error" E "glyphicon-remove" PARA ALTERAR A COR DO INPUT PARA VERMELHO
				//alert("Por favor inclua um Numero de CPF valido");
				$(".cpf-caixa").removeClass("has-success");
				$(".cpf-gliphi").removeClass("glyphicon-ok");
				$(".cpf-caixa").addClass("has-error");
				$(".cpf-gliphi").addClass("glyphicon-remove");
                cpf_valido=false;
				$("#aviso-cpf-vazio").popover("show");
			}else{
				//AJAX PARA VERIFICAR A EXISTENCIA DE OUTRO NUMERO CPF IGUAL 
				$.ajax({
					type:"POST",
					url:"PHP/cadastro_visitante.php",
					data:{op:"verificarCPF",cpf:$(this).val()},
					success: function(data){
						if (data=="Existe"){
							//ADICIONANDO AS CLASSES "has-error" E "glyphicon-remove" PARA ALTERAR A COR DO INPUT PARA VERMELHO
							$(".cpf-caixa").addClass("has-error");
							$(".cpf-gliphi").addClass("glyphicon-remove");
							$(".cpf-caixa").removeClass("has-success");
							$(".cpf-gliphi").removeClass("glyphicon-ok");
							$("#aviso-cpf-vazio").popover("show");
                            cpf_valido=false;
						}else{
							//ADICIONANDO AS CLASSES "has-success" E "glyphicon-ok" PARA ALTERAR A COR DO INPUT PARA VERDE
							$(".cpf-caixa").removeClass("has-error");
							$(".cpf-gliphi").removeClass("glyphicon-remove");
							$(".cpf-caixa").addClass("has-success");
							$(".cpf-gliphi").addClass("glyphicon-ok");
                            cpf_valido=true;
						}
					}
				});
				
			}
			
		}
	});
	$("#rg").focusout(function(){
		//AJAX PARA VERIFICAR A EXISTENCIA DE OUTRO NUMERO RG IGUAL
        if ($(this).val()==""){
            rg_valido=true;
        }else{
            var rg_texto=$(this).val();
            if (rg_texto.length<12){
                $(".rg-caixa").addClass("has-error");
                $(".rg-gliphi").addClass("glyphicon-remove");
				$(".rg-caixa").removeClass("has-success");
				$(".rg-gliphi").removeClass("glyphicon-ok");
				rg_valido=false;     
            }else{
                 $.ajax({
                    type:"POST",
                    url:"PHP/cadastro_visitante.php",
                    data:{op:"verificarRG",rg:$(this).val()},
                    success: function(data){
                        if (data=="Existe"){
                            //ADICIONANDO AS CLASSES "has-error" E "glyphicon-remove" PARA ALTERAR A COR DO INPUT PARA VERMELHO
                            $(".rg-caixa").addClass("has-error");
                            $(".rg-gliphi").addClass("glyphicon-remove");
                            $(".rg-caixa").removeClass("has-success");
                            $(".rg-gliphi").removeClass("glyphicon-ok");
                            $(this).focus();
                            rg_valido=false;
                        }else{
                            //ADICIONANDO AS CLASSES "has-success" E "glyphicon-ok" PARA ALTERAR A COR DO INPUT PARA VERDE
                            $(".rg-caixa").removeClass("has-error");
                            $(".rg-gliphi").removeClass("glyphicon-remove");
                            $(".rg-caixa").addClass("has-success");
                            $(".rg-gliphi").addClass("glyphicon-ok");
                            rg_valido=true;
                        }
                    }
                    });   
            }
        
        }
        
    });
	$("#placa").focusout(function(){
        veiculo=null;
		if ($(this).val()==""){
			placa_valido=true;
		}else{
            var placa_texto=$(this).val();
            if (placa_texto.length<8){
              placa_valido="texto invalido";  
            }else{
			$.ajax({
				type:"POST",
				url:"PHP/cad_veiculo_visitante.php",
				data:{op:"verificar",placa:$(this).val()},
				success:function(data){
					if (data.resposta=="existe"){
						//$("#placa").attr("disabled");
						$("#descricao_veiculo").val(data.descricao);
						//$("#descricao_veiculo").attr("disabled");
						veiculo="positivo";
                        placa_valido=true;
					}else{
                        placa_valido=false;
					}
				}
			});
            };
		}
	});
	
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
	//Botão para incluir um veiculo ao cadastro o visitante
	$("#adicionar-veiculo").click(function(){
		
		$("#row-veiculo").slideToggle();
		return false;
	});
	
	
    $("#form_cad_visitante").submit(function(){
        if ( cpf_valido && rg_valido || placa_valido){
            //cadastro de visitante
            $.ajax({
                type:"POST",
                url:"PHP/cadastro_visitante.php",
                data:{
                    op:"cadastro",
                    cpf:$("#cpf").val(),
                    rg:$("#rg").val(),
                    nome:$("#nome").val(),
                    empresa:$("#empresa").val(),
                    foto:imagem
                 },
                success:function(data){

                }
            });
            if (placa_valido==false){
                if($("#descricao_veiculo").val()!=""){
                    $.ajax({
                        type:"POST",
                        url:"PHP/cad_veiculo_visitante.php",
                        data:{
                            op:"cadastrar",
                            descricao:$("#descricao_veiculo").val(),
                            placa:$("#placa").val(),
                            cpf:$("#cpf").val()
                        },
                        success:function(){
                            veiculo="positivo";
                            placa_valido=true;
                        }
                    });
                }else{
                    alert("Dados incorretos por favor verifique e tente novamente!");
                    $("#descricao_veiculo").focus();
                }                
            }else if(placa_valido!=true && placa_valido !=false){
                alert("Dados incorretos por favor verifique e tente novamente!");
                $("#placa").focus(); 
            };
            if (placa_valido && veiculo!=null){
                $.ajax({
                    type:"POST",
					url:"PHP/registro_visitante.php",
					cache:"false",
					data:{
						op:"cadastro",
						visitante:$("#cpf").val(),
						setor:$("#setor").val(),
						cracha:$("#cracha").val(),
						contato:$("#contato").val(),
						obs:$("#obs").val(),
                        veiculo:$("#placa").val()
					},
					success:function(data){
					   $("#modal_confirmacao").modal({backdrop: "static"});
					}
				});
            }else{
                $.ajax({
                    type:"POST",
					url:"PHP/registro_visitante.php",
					cache:"false",
					data:{
						op:"cadastro",
						visitante:$("#cpf").val(),
						setor:$("#setor").val(),
						cracha:$("#cracha").val(),
						contato:$("#contato").val(),
						obs:$("#obs").val()
					},
					success:function(data){
					   $("#modal_confirmacao").modal({backdrop: "static"});
					}
				});
            };
        }else{
            alert("Dados incorretos por favor verifique e tente novamente!");
            $("#cpf").focus();  
        };		
		veiculo=null;
        return false;
	});
	$('[data-toggle="tooltip"]').tooltip();
});