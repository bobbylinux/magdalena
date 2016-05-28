/**
 * Created by roberto on 22/05/16.
 */
$(document).ready( function() {
    var $sociLista = "";
    var $urlLista = window.location.protocol + "//" + window.location.host + "/soci/lista";
    // process the form
    $.ajax({
        type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url: $urlLista, // the url where we want to POST
        dataType: 'json', // what type of data do we expect back from the server
        async: false,
        encode: true
    })
        // using the done promise callback
        .done(function (data) {
            $sociLista = data;
        })
        .error(function (data) {
        });

    $("#ricerca-candidato").autocomplete({
        source: $sociLista,
        select: function (event, ui) {
            var names = ui.item.id;
            $("#ricerca-candidato").data("id", "" + names); // save selected id to hidden input
        }
    });

    $( "#data-inizio" ).datepicker($.datepicker.regional[ "it" ] );
    $( "#data-fine" ).datepicker($.datepicker.regional[ "it" ] );

    $(document).on("click",".btn-cancella",function(event){
        event.preventDefault();
        var $id = $(this).data("id");
        var $anagrafica = $(this).data("anagrafica");
        $("#btn-conferma-cancella").data("id",$id);
        $("#btn-conferma-cancella").data("anagrafica",$anagrafica);
        $("#msg-conferma-cancella").modal("show");
    });

    $(document).on("click","#btn-conferma-cancella",function(event){
        event.preventDefault();
        $("#msg-conferma-cancella").modal("hide");
        $("#wait-msg").modal("show");
        var $id = $(this).data("id");
        var $anagrafica = $(this).data("anagrafica");
        var $url = window.location.protocol + "//" + window.location.host + "/" + $anagrafica+"/"+$id;
        var $token = $(this).data("token");
        // process the form
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: $url, // the url where we want to POST
            dataType: 'json', // what type of data do we expect back from the server
            data: {
                _method: "DELETE",
                id: $id,
                _token: $token
            },
            encode: true
        })
            // using the done promise callback
            .done(function (data) {
                $("#wait-msg").modal("hide");
                if (data.errore == true) {
                    $(".errore-testo").html("<p>"+data.messaggio+"</p>");
                    $("#errore-messaggio").modal("show");
                } else {
                    location.reload();
                }
            })
            .error(function (data) {
                $("#wait-msg").modal("hide");
                $(".errore-testo").html("<p>Errore durante la cancellazione. Controllare i vincoli referenziali sul database</p>");
                $("#errore-messaggio").modal("show");
            });
    });

    $(document).on("change","#select-votazioni-attive",function(event) {
        var $id = $(this).val();
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: 'candidati/tabella', // the url where we want to POST
            dataType: 'json', // what type of data do we expect back from the server
            data: {
                c_rif: $id
            },
            encode: true
        })
            // using the done promise callback
            .done(function (data) {
                if (data.errore == true) {
                    $(".errore-testo").html("<p>"+data.messaggio+"</p>");
                    $("#errore-messaggio").modal("show");
                } else {
                    $("#lista-candidati-container").html(data);
                }
            })
            .error(function (data) {
                $(".errore-testo").html("<p>Errore durante il caricamento dei candidati</p>");
                $("#errore-messaggio").modal("show");
            });

        $(".div-candidato-ricerca").css("display","initial");
    });

    $(document).on("click",".btn-cancella-candidato",function(event){
        event.preventDefault();
        var $id = $(this).data("id");
        var $token = $(this).data("token");
        var $url = "/candidati/"+$id;

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: $url, // the url where we want to POST
            dataType: 'json', // what type of data do we expect back from the server
            data: {
                _method: "DELETE",
                id: $id,
                _token: $token
            },
            encode: true,
            context: this,
        })
            // using the done promise callback
            .done(function (data) {
                if (data.errore == true) {
                    $(".errore-testo").html("<p>"+data.messaggio+"</p>");
                    $("#errore-messaggio").modal("show");
                } else {
                    $(this).closest("tr").remove();
                }
            })
            .error(function (data) {
                $(".errore-testo").html("<p>Impossibile cancellare il candidato poichè presente un vincolo referenziale nel database voti.</p>");
                $("#errore-messaggio").modal("show");
            });
    });

    $(document).on("click","#aggiungi-candidato",function(event){
        event.preventDefault();
        var $token = $(this).data("token");
        var $url = "/candidati";
        var $c_soc = $("#ricerca-candidato").data("id");
        var $c_rif = $("#select-votazioni-attive").val();
        $("#ricerca-candidato").val("");
        $("#ricerca-candidato").data("id", "");
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: $url, // the url where we want to POST
            dataType: 'json', // what type of data do we expect back from the server
            data: {
                c_soc: $c_soc,
                _token: $token,
                c_rif: $c_rif
            },
            encode: true,
            context: this,
        })
            // using the done promise callback
            .done(function (data) {
                if (data.errore == true) {
                    $(".errore-testo").html("<p>"+data.messaggio+"</p>");
                    $("#errore-messaggio").modal("show");
                } else {
                    $("#lista-candidati-container").html(data);
                }
            })
            .error(function (data) {
                $(".errore-testo").html("<p>Errore nella creazione del record candidato.</p>");
                $("#errore-messaggio").modal("show");
            });
    });

});
