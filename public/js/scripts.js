$(document).ready(function() {
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
            alert("error");
        });

    $("#ricerca-socio").autocomplete({
        source: $candidati
    });

    $(document).on("click","#aggiungi-socio",function(){
        alert("clicked");
    });
});