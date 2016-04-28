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

        var nome = $("#ricerca-socio").val();
        var id = $("#ricerca-socio").data("id");
        var html = "";
        $("#ricerca-socio").val("");
        $("#ricerca-socio").data("id","");
        if (id !== "") {
            html = '<div class="col-xs-8 col-xs-offset-2 text-center">';
            html += '<div class="panel panel-default">';
            html += '<div class="panel-body">';
            html += '<button type="button" class="close delete" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            html += '<input type="hidden" class="id-votato" value="' + id + '"/>';
            html += nome;
            html += '</div>';
            html += '</div>';
            html += '</div>';
            $("#voti-container").append(html);
            $("#conferma-container").show("slow");
        }
    });

    $(document).on("click", "#conferma-voto", function (event) {
        if ($(".panel").length) {
            $("#conferma-messaggio").modal("show");
        } else {
            $("#errore-messaggio>.modal-body").append("<p>Selezionare almeno un candidato</p>");
            $("#errore-messaggio").modal("show");
        }
    });

    $(document).on("click","#conferma-voto-definitivo",function(event){
        event.preventDefault();
        var ids = new Array();
        var $token = $(this).data("token");
        $(".id-votato").each(function() {
            ids.push($(this).val());
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
                userdata : ids,
                _token: $token
            },
            encode: true
        })
            // using the done promise callback
            .done(function (data) {

                $("#wait-msg").modal("hide");
                var $url = window.location.protocol + "//" + window.location.host + "/esito"
                $(location).attr('href',$url);
            })
            .error(function (data) {
                $("#wait-msg").modal("hide");
            });
    });

    $(document).on("click",".delete",function(event) {
        event.preventDefault();
        $(this).closest(".panel").remove();
        if (!$(".panel").length) {
            $("#conferma-container").hide("slow");
        }
    })
});