$(document).ready(function(){

    var canvas = $('#map-canvas');
    canvas.map({

        lat: "#address_lat",
        lng: "#address_lng"

    });

    $('#zipcode-autofill').zipcode({

        inputs: {

            zipcode: '#address_zip_code',
            country: '#address_country',
            province: '#address_province',
            city: '#address_city',
            lat: '#address_lat',
            lng: '#address_lng'

        },
        callbacks: {

            update: function() {

                canvas.centerMap();

            }

        }


    });



});