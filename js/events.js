/**
 * @author Christian ZIRBES
 */
function selectBloc(bloc) {
    console.log(bloc);
    console.log(jour);
    $.ajax({
        "url": "inc/placesdispoOrg.php?bloc=" + bloc + "&jour=" + jour,
        "type": "POST",
        "dataType": "json",
        "success": function (data) {
            $("#helpZone").text("");
            placeDispo = data.nb;
            if (placeDispo <= 0) {
                $("#pZone").html(data.zone);
                $("#pBloc").html("<button class='btn btn-" + data.color + "' type='button'>" + data.bloc + " <span class='badge'>complet</span></button>");
                $("#pPrice").html("");
                $("#inputPlaces").val(0);
                $("#inputTotal").val(0);
                placeBloc = data.bloc;
                placeZone = data.zone;
                priceUnit = 0;
                priceTot = priceUnit;
                $('#btnReserver').hide();
            } else {
                $("#pZone").html(data.zone);
                $("#pBloc").html("<button class='btn btn-" + data.color + "' type='button'>" + data.bloc + " <span class='badge'>" + data.nb + "</span></button>");
                if (abn) {
                    $("#pPrice").html("Adulte: " + data.price_abn + ".00 € --- Enfant: " + data.price_abn_half + ".00 €");
                    priceUnit = data.price_abn;
                    priceUnitHalf = data.price_abn_half;
                } else {
                    $("#pPrice").html("Adulte: " + data.price + ".00 € --- Enfant: " + data.price_half + ".00 €");
                    priceUnit = data.price;
                    priceUnitHalf = data.price_half;
                }
                $("#inputPlaces").val(1);
                $("#inputPlacesHalf").val(0);
                $("#inputTotal").val(priceUnit);

                priceTot = priceUnit;
                placeBloc = data.bloc;
                placeFullNb = 1;
                placeHalfNb = 0;
                $('#btnReserver').show();
                $('#salleHelp').html("");
            }

        }
    });
}



$(document).ready(function(){

    $('#btnReserverVen').click(function () {
        $.ajax({
            "url": "inc/doReservOrg.php",
            "type": "POST",
            "dataType": "json",
            "data": {
                "inputPlaces": $('#inputPlaces').val(),
                "inputPlacesHalf":$('#inputPlacesHalf').val(),
                "inputBeneficiaire":$('#inputBeneficiaire').val(),
                "inputMontant": $('#inputMontant').val(),
                "inputType": $('#inputType').val(),
                "day": "VEN04",
                "bloc": "VEN04",
            },
            "success": function (data) {
                console.log(data.msg);
                document.location.href = "confirmation.php";
            }
        });

    });

});
