/**
 * Created by roberto on 22/05/16.
 */
$(document).ready( function() {
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
            });
    });
});
