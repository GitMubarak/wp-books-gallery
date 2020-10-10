(function($) {

    // USE STRICT
    "use strict";

    var wbgColorPicker = ['#wbg_btn_color'];

    $.each(wbgColorPicker, function(index, value) {
        $(value).wpColorPicker();
    });

    $("#wbg_published_on").datepicker({
        dateFormat: "yy-mm-dd"
    });

    $('.wbg-closebtn').on('click', function() {
        this.parentElement.style.display = 'none';
    });

})(jQuery);