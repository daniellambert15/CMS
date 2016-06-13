$( "body" ).click(function( event ) {

    var id = { "tracking": [
        { "id": event.target.id }
    ]};

    $.ajax({
        type: "POST",
        url: "/trackingClick",
        data: id,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function(data){alert(data);},
        failure: function(errMsg) {
            alert(errMsg);
        }
  });

});

