$("#progress").hide();


var options = {
    beforeSend: function () {
        $("#progress").show();
        //clear everything
        $("#bar").width('0%');
        $("#message").html("");
        $("#percent").html("0%");
    },
    uploadProgress: function (event, position, total, percentComplete) {
        $("#bar").width(percentComplete + '%');
        $("#percent").html(percentComplete + '%');
    },
    success: function () {
        $("#bar").width('100%');
        $("#percent").html('100%');
    },
    complete: function (response) {
        $("#message").html("<p style='color:green'>" + response.responseText + "</p>");
    },
    error: function () {
        $("#message").html("<p style='color:red'> err</p>");
    }
};
$("#myForm").ajaxForm(options);
