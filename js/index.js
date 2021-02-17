/**
 * 
 */

$(document).ready(function(){
	$("#login").focusin(function(){
		$("#login").popover("destroy");
	});
	$("#senha").focusin(function(){
		$("#senha").popover("destroy");
	});
	$("#login").focusout(function(){
		$("#login").popover("destroy");
	});
	$("#senha").focusout(function(){
		$("#senha").popover("destroy");
	});
	$("#form-acesso").submit(function(){
		$.ajax({
			type:"POST",
			url:"PHP/login.php",
			data:{
				op:"login",				
				login: $("#login").val(),
				senha: $("#senha").val()
			},
			success: function(data){
				if (data=="login"){
					$(".form-group").removeClass("has-success has-error");
					$("span").removeClass("glyphicon-ok glyphicon-remove");
					$("#form-group-login").addClass("has-error");
					$("#span-login").addClass("glyphicon-remove");
					$('#login').popover("show");
					$('#senha').popover("hide");
				}else if(data=="senha"){
					$(".form-group").removeClass("has-success has-error");
					$("span").removeClass("glyphicon-ok glyphicon-remove");
					$("#form-group-login").addClass("has-success");
					$("#span-login").addClass("glyphicon-ok");
					$("#form-group-senha").addClass("has-error");
					$("#span-senha").addClass("glyphicon-remove");
					$('#login').popover("hide");
					$('#senha').popover("show");
				}else {
					location.href="principal.php";
				}
				/*if (data=='logado'){
					location.href="principal.php";
				}else{
					$("#usuario").focus();
					alert("Login ou senha incorreto por favor verifique e tente novamente!");
				}*/
			}
		});
		return false;
	});
});