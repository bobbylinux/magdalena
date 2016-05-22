/**
 * Created by roberto on 22/05/16.
 */
$(document).ready( function() {
    $( "#data-inizio" ).datepicker($.datepicker.regional[ "it" ] );
    $( "#data-fine" ).datepicker($.datepicker.regional[ "it" ] );

    $(document).on("change","#select-data-rif",function(){
        $("#wait-msg").modal("show");
        $(".div-dettagli").remove();
        var $id = this.value;

        var $url = 'voti/dettagli/'+$id
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $(this).data('token')
            }
        });

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: $url, // the url where we want to POST
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
            // using the done promise callback
            .done(function (data) {
                $("#wait-msg").modal("hide");
                var $classifica = data;
                $(".container-fluid").append($classifica);
            })
            .error(function (data) {
                $("#wait-msg").modal("hide");
            });

    });
});
