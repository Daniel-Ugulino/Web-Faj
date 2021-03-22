var url = window.location.pathname;
var filename = url.substring(url.lastIndexOf('/') + 1);
var apear = document.getElementsByClassName("hide");

$("#cadastrar").submit(function(e) {
    var newsData = new FormData(document.getElementById("cadastrar"));
    newsData.append('op', 'news-create');

    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "php/functions.php",
        data: newsData,
        processData: false,
        cache: false,
        contentType: false,
        success: function(data) {
            alert("Noticia criada com sucesso");
            $("#cadastrar")[0].reset()

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
                    update();
                });
            } else {
                alert('Usuario ou senha erradas')
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert("ERROR:" + xhr.responseText + " - " + thrownError);
        }
    });
});

if (filename == "main.php") {
    function getids() {
        var elements = document.getElementsByClassName("news");

        for (var i = 0; i < elements.length; i++) {
            elements[i].addEventListener('click', function() {
                var attribute = this.getAttribute("id");

                $.ajax({
                    type: "POST",
                    url: "php/functions.php",
                    data: {
                        op: "news-select",
                        id: attribute
                    },
                    datatype: "html",
                    success: function(data) {
                        window.location.href = "news.php";
                    }
                });
            })
        }
    }
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
                    getids();

                }
            });
        }
        listar_noticia()
    });

    function pagintation() {
        var links = document.getElementsByClassName("page-link");

        for (var i = 0; i < links.length; i++) {
            links[i].addEventListener('click', function() {
                var page = this.getAttribute("id");

                $.ajax({
                    type: "POST",
                    url: "php/functions.php",
                    data: {
                        op: "news_menu_card",
                        page_index: page,
                    },
                    datatype: "html",
                    success: function(data) {
                        $("#Card_News").html(data);
                        getids();
                    }
                });
            })
        };
    }
    pagintation();
}

if (filename == "news.php") {
    $(document).ready(function() {
        function mostrar_noticia() {
            $.ajax({
                type: "POST",
                url: "php/functions.php",
                data: {
                    op: "news-select",
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
    $(document).ready(function() {
        function card_control_show() {
            $.ajax({
                type: "POST",
                url: "php/functions.php",
                data: {
                    op: "card_control",
                    date: $("#date_filter").val(),
                    name: $("#name_filter").val()
                },
                datatype: "html",
                success: function(data) {
                    $("#card_control").html(data);

                }
            });
        }
        card_control_show();
    })

    $("#news_filter").keyup(function() {
        function card_control_show() {
            $.ajax({
                type: "POST",
                url: "php/functions.php",
                data: {
                    op: "card_control",
                    date: $("#date_filter").val(),
                    name: $("#name_filter").val()
                },
                datatype: "html",
                success: function(data) {
                    $("#card_control").html(data);

                }
            });
        }
        card_control_show();
    })
}

function upkey() {
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

function update() {
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
            success: function(data_up) {
                if (data_up == 1) {
                    alert("Senha alterada com sucesso");
                    window.location.href = "news_control.php";
                } else if (data_up == 2) {
                    alert('A senha anterior está errada')
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                $("#Carrousel_News").alert('conta ou senha errada')
            }
        });

    });
}

function news_filter() {

}