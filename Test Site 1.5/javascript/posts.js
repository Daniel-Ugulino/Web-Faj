var url = window.location.pathname;
var filename = url.substring(url.lastIndexOf('/') + 1);
var apear = document.getElementsByClassName("hide");
console.log(url);

$("#cadastrar").submit(function(e) {
    var newsData = new FormData(document.getElementById("cadastrar"));
    newsData.append('op', 'news-create');

    if (sessionStorage.getItem('id') == "") {
        newsData.append('post_data', '1');
        newsData.append('id', '1');

    } else {
        newsData.append('post_data', '2');
        newsData.append('id', sessionStorage.getItem('id'));
    }

    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: newsData,
        processData: false,
        cache: false,
        contentType: false,
        success: function(data) {
            if (sessionStorage.getItem('id') == "") {
                alert("Noticia criada com sucesso");
                $("#cadastrar")[0].reset()
            } else {
                alert("Noticia alterada com sucesso");
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert("ERROR:" + xhr.responseText + " - " + thrownError);
        }
    });
});

$("#login").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: {
            op: "logar",
            usuario: $("#username").val(),
            senha: $("#key").val(),
        },
        datatype: "html",
        success: function(data) {
            if (data == 1) {
                window.location.href = "news_control.php";
            } else if (data == 2) {
                $(document).ready(function() {
                    $('#update_modal').modal('show');
                    update_key();
                });
            } else {
                alert('Usuario ou senha erradas');
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert("ERROR:" + xhr.responseText + " - " + thrownError);
        }
    });
});

function getdata() {
    var elements = document.getElementsByClassName("news");

    for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener('click', function() {
            var attribute = this.getAttribute("id");

            if (filename == "" || filename == "index.php") {
                sessionStorage.setItem('id', attribute);
                window.location.href = "news.php";

            } else if (filename == "news_control.php") {
                sessionStorage.setItem('Edição', true);
                sessionStorage.setItem('id', attribute);
                location.href = "create-news.php";
            };
        })
    }
}

function pagintation() {
    var links = document.getElementsByClassName("page-link");

    for (var i = 0; i < links.length; i++) {
        links[i].addEventListener('click', function() {
            var page = this.getAttribute("id");

            if (filename == "index.php") {
                var option = "news_menu_card";
                var card = "#Card_News";
            } else if (filename == "news_control.php") {
                var option = "card_control";
                var card = "#card_control";

            };
            $.ajax({
                type: "POST",
                url: "php/functions.php",
                data: {
                    op: option,
                    page_index: page,
                },
                datatype: "html",
                success: function(data) {
                    $(card).html(data);
                    getdata();
                }
            });
        })
    };
}

if (filename == "" || filename == "index.php") {
    $(document).ready(function() {
        setInterval(function() {
            listar_noticia();
        }, 90000);

        function listar_noticia() {
            $.ajax({
                type: "POST",
                url: "php/functions.php",
                data: { op: "news_menu_carrousel" },
                datatype: "html",
                success: function(data) {
                    $("#Carrousel_News").html(data);
                    if (data != "") {
                        for (var i = 0; i < apear.length; i++) {
                            apear[i].style.display = "flex";
                        }
                    }
                    getdata();
                }
            });
            $.ajax({
                type: "POST",
                url: "php/functions.php",
                data: {
                    op: "news_menu_card",
                },
                datatype: "html",
                success: function(data) {
                    $("#Card_News").html(data);
                    getdata();
                }
            });
        }
        listar_noticia()
        pagintation();
    });

}

if (filename == "news.php") {
    $(document).ready(function() {
        function mostrar_noticia() {
            $.ajax({
                type: "POST",
                url: "php/functions.php",
                data: {
                    op: "news-select",
                    show_data: 1,
                    id: sessionStorage.getItem('id')
                },
                datatype: "html",
                success: function(data) {
                    $("#News_content").html(data);
                }
            });
        }
        mostrar_noticia();
    })
}

if (filename == "news_control.php") {
    sessionStorage.setItem('id', "");
    sessionStorage.setItem('cargo', "");

    function card_control_show() {
        $.ajax({
            type: "POST",
            url: "php/functions.php",
            data: {
                op: "card_control",
                Inidate: $("#start_date").val(),
                Fimdate: $("#end_date").val(),
                name: $("#name_filter").val()
            },
            datatype: "html",
            success: function(data) {
                $("#card_control").html(data);
                getdata();
            }
        });
    }

    $(document).ready(function() {
        card_control_show();
        pagintation();
    })

    $("#news_filter").keyup(function() {
        card_control_show();
    })

    // $("#end_date").change(function() {
    //     card_control_show();
    // })
    // $("#start_date").change(function() {
    //     card_control_show();
    // })
}

if (filename == "create-news.php") {
    console.log(sessionStorage.getItem('cargo'))
    if (sessionStorage.getItem('id') != "") {

        function updateNews() {
            $.ajax({
                type: "POST",
                url: "php/functions.php",
                data: {
                    op: "news-select",
                    show_data: 2,
                    id: sessionStorage.getItem("id")
                },
                datatype: "html",
                success: function(data) {

                    var hex = data
                    bytes = [];
                    var str;

                    for (var i = 0; i < hex.length - 1; i += 2) {
                        bytes.push(parseInt(hex.substr(i, 2), 16));
                    }

                    str = String.fromCharCode.apply(String, bytes);
                    news_data = JSON.parse(str);
                    console.log(news_data['cargo']);

                    if (sessionStorage.getItem('cargo') == "adm") {
                        if (news_data['situação'] == true) {
                            $(".publicarN").after("<button style='margin-left: 10px;' type='button' class=publicarN id='situação'>Desativar</button>");
                        } else {
                            $(".publicarN").after("<button style='margin-left: 10px;' type='button' class=publicarN id='situação'>Ativar</button>");

                        }
                    }
                    if (sessionStorage.getItem('cargo') == "marketing") {
                        $(".publicarN").remove();
                    }

                    if ($("#situação").html() == "Desativar") {
                        situacao = false;
                    } else if ($("#situação").html() == "Ativar") {
                        situacao = true;
                    }

                    function activateNews() {
                        $.ajax({
                            type: "POST",
                            url: "php/functions.php",
                            data: {
                                op: "news_situation",
                                news_id: news_data['id_news'],
                                situacao: situacao
                            },
                            datatype: "html",
                            success: function(data) {
                                alert("Situação Alterada");
                                document.location.reload(true);
                            }
                        });
                    }

                    $("#titulo").attr("value", news_data['titulo']);
                    $("#Stitulo").attr("value", news_data['subtitulo']);

                    if (news_data['news_file'] != "") {
                        $("#filelabel").empty();
                        $("#filelabel").append("Há Arquivo Anexado");
                    }

                    $("#situação").click(function() {
                        activateNews()
                    });

                    $("#news-image").removeAttr("required");

                    $("#previews").attr("style", "display:initial");
                    $("#Nimg").attr("style", "display:none");

                    $("#previews").attr("src", news_data['news_image']);
                    $("#p1noticia").append(news_data['noticia_p1']);
                    $("#p2noticia").append(news_data['noticia_p2']);
                }
            });
        }
        updateNews();
    }
}

function keyVerify() {
    if ($("#new_key").val() != "" && $("#old_key").val() != "") {
        if ($("#new_key").val() == $("#new_key_confirm").val()) {
            $("#sub_key").prop("disabled", false);
        } else {
            $("#sub_key").prop("disabled", true);
        }
    } else {
        $("#sub_key").prop("disabled", true);
    }
}

function update_key() {
    $("#up_key").submit(function(y) {
        y.preventDefault();
        $.ajax({
            type: "POST",
            url: "php/functions.php",
            data: {
                op: "update_key",
                senha_antiga: $('#old_key').val(),
                senha_nova: $('#new_key').val()
            },
            success: function(data) {
                if (data == 1) {
                    alert("Senha alterada com sucesso");
                    window.location.href = "news_control.php";
                } else if (data == 2) {
                    alert('A senha anterior está errada')
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                $("#Carrousel_News").alert('conta ou senha errada')
            }
        });

    });
}