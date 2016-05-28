$(document).ready(function () {
    var $candidati = "";
    // process the form
    $.ajax({
        type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url: 'soci/candidati', // the url where we want to POST
        dataType: 'json', // what type of data do we expect back from the server
        async: false,
        encode: true
    })
        // using the done promise callback
        .done(function (data) {
            $candidati = data;
        })
        .error(function (data) {
        });

    $("#ricerca-socio").autocomplete({
        source: $candidati,
        select: function (event, ui) {
            var names = ui.item.id;
            $("#ricerca-socio").data("id", "" + names); // save selected id to hidden input
        }
    });

    $(document).on("click", "#aggiungi-socio", function () {

        if (trim($("#ricerca-socio").val()) == "" || $("#ricerca-socio").val() == null) {
            return;
        }

        $("#wait-msg").modal("show");
        // process the form
        var $voti = new Array();
        $(".id-votato").each(function () {
            $voti.push($(this).val());
        });

        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: 'soci/voto/valida', // the url where we want to POST
            dataType: 'json', // what type of data do we expect back from the server
            async: false,
            data: {
                voti: $voti,
            },
            encode: true
        })
            // using the done promise callback
            .done(function (data) {

                $("#wait-msg").modal("hide");
                if (data.errore == true) {
                    $(".errore-testo").html("<p>"+data.messaggio+"</p>");
                    $("#errore-messaggio").modal("show");
                    $("#ricerca-socio").val("");
                    $("#ricerca-socio").data("id", "");
                } else {
                    var nome = $("#ricerca-socio").val();
                    var id = $("#ricerca-socio").data("id");
                    var html = "";
                    $("#ricerca-socio").val("");
                    $("#ricerca-socio").data("id", "");
                    if (id !== "") {
                        html = '<div class="col-xs-8 col-xs-offset-2 text-center">';
                        html += '<div class="panel panel-default">';
                        html += '<div class="panel-body">';
                        html += '<button type="button" class="close delete" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        html += '<input type="hidden" class="id-votato" value="' + id + '"/>';
                        html += '<span class="label-votato" >'+nome+'</span>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        $("#voti-container").append(html);
                        $("#conferma-container").show("slow");
                        deleteCandidatoFromList(id);
                    }
                }

            })
            .error(function (data) {
                $("#wait-msg").modal("hide");
            });

    });

    $(document).on("click", "#conferma-voto", function (event) {
        if ($(".panel").length) {
            $("#conferma-messaggio").modal("show");
        } else {
            $("#errore-messaggio>.modal-body").append("<p>Selezionare almeno un candidato</p>");
            $("#errore-messaggio").modal("show");
        }
    });

    $(document).on("click", "#conferma-voto-definitivo", function (event) {
        event.preventDefault();
        var $voti = new Array();
        var $token = $(this).data("token");
        $(".id-votato").each(function () {
            $voti.push($(this).val());
        });
        $("#conferma-messaggio").modal("hide");
        $("#wait-msg").modal("show");

        // process the form
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: 'soci/voto', // the url where we want to POST
            dataType: 'json', // what type of data do we expect back from the server
            data: {
                _method: "POST",
                voti: $voti,
                _token: $token
            },
            encode: true
        })
            // using the done promise callback
            .done(function (data) {

                $("#wait-msg").modal("hide");
                var $url = window.location.protocol + "//" + window.location.host + "/esito"
                $(location).attr('href', $url);
            })
            .error(function (data) {
                $("#wait-msg").modal("hide");
            });
    });

    $(document).on("click", ".delete", function (event) {
        event.preventDefault();
        var $candidato = {
                label : $(this).closest(".panel").find(".label-votato").html(),
                value : $(this).closest(".panel").find(".label-votato").html(),
                id    : $(this).closest(".panel").find(".id-votato").val()
            };

        $candidati.splice(1,0, $candidato);

        $(this).closest(".panel").remove();
        if (!$(".panel").length) {
            $("#conferma-container").hide("slow");
        }
    });

    function deleteCandidatoFromList($id) {
        var $length = $candidati.length;
        var $tmp = [];
        for (var $i = $length; $i > 0; $i--) {
            try {
                if ($id == $candidati[$i]["id"]) {
                    $candidati.splice($i, 1);
                }
            } catch(e) {
                null;
            }
        }
        return;
    }

});