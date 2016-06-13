$('.click').click(function () {

    var action = $(this).data('action');
    var type = $(this).data('type');
    var name = $(this).data('name');

    $.ajax({
        type: "POST",
        url: "/trackingClick",
        data: {
            action: action,
            type: type,
            name: name,
        },
        dataType: "json",
        success: function(data){alert(data);}
  });

});

$('.hover').hover("inFunction", function () {

    var action = $(this).data('action');
    var type = $(this).data('type');
    var name = $(this).data('name');

    $.ajax({
        type: "POST",
        url: "/trackingClick",
        data: {
            action: action,
            type: type,
            name: name,
        },
        dataType: "json",
        success: function(data){alert(data);}
  });

});


$('.see').each(function() {

    var action = $(this).data('action');
    var type = $(this).data('type');
    var name = $(this).data('name');


    $.ajax({
        type: "POST",
        url: "/trackingClick",
        data: {
            action: action,
            type: type,
            name: name,
        },
        dataType: "json",
        success: function(data){alert(data);}
  });

});

function dissableSubmit() {
    document.getElementById("submit").disabled = true;
}

$('.submit').on('submit', function () {

    $(this).find('input[type=submit]').prop('disabled', true);

    var action = $(this).data('action');
    var type = $(this).data('type');
    var name = $(this).data('name');

    $.ajax({
        type: "POST",
        url: "/trackingClick",
        data: {
            action: action,
            type: type,
            name: name,
        },
        dataType: "json",
        success: function(data){alert(data);}
  });

});