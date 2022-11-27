function watchForButtonClick($) {
    $("#ajaxexamplebutton").click(function() {
        console.log("Clicked!");
        $.ajax({
            type: "post",
            url: ajaxexample_object.ajaxexample_url,
            data: {
                'action': 'getLatestPost'
            },
            success: function (response) {
                if (response !== '') {
                    $("#ajaxexampleresponse").text(response);
                } else {
                    console.log("AJAX Error...");
                }
            }
        });
    });
}

jQuery(document).ready(function($) {
    if ($("#ajaxexamplebutton").length) {
        watchForButtonClick($);
    }
});
