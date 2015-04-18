$.fn.zipcode = function(settings) {

  var settings = settings;

  var input = this; 

  var country = $(settings.inputs.country);
  var zipcode = $(settings.inputs.zipcode);
  var lat = $(settings.inputs.lat);
  var lng = $(settings.inputs.lng);
  var city = $(settings.inputs.city);
  var province = $(settings.inputs.province);
  var inputValue = null;

  input.click(function() {


    inputValue = input.html();
    input.html("Locating...");
    
    var c = country.val();
    var z = zipcode.val();
    if(!c || !z) {

      alert("Country and zipcode required.");
      input.html(inputValue);

    }
    else {

      var url = input.data("api-url").replace("country", c).replace("zc", z);
      console.log(url);
      $.get(url)
      .success(function(rsp) {

        input.html(inputValue);
        
        if(rsp.status == "ok") {

          var location = rsp.data;
          
          if(location == null) {

            alert("Unable to detect the zipcode.");

          }
          else {

            province.val(location.province);
            city.val(location.city);
            lat.val(location.lat);
            lng.val(location.lng);

            if(settings.callbacks && settings.callbacks.update) settings.callbacks.update(location);

          }

        }
        else {

          alert(rsp.message);

        }

        return false;

      })
      .error(function() {
        input.html(inputValue);
        alert("Sorry, an error has occured. Please try again later.");

      });

    }

    return false;
  
  });

}

