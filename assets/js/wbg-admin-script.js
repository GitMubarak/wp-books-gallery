(function($) {

    // USE STRICT
    "use strict";

    var wbgColorPicker = ['#wbg_btn_color', '#wbg_btn_font_color', '#wbg_btn_border_color', '#wbg_download_btn_color', '#wbg_download_btn_font_color', '#wbg_title_color',
        '#wbg_title_hover_color', '#wbg_description_color'
    ];

    $.each(wbgColorPicker, function(index, value) {
        $(value).wpColorPicker();
    });

    $("#wbg_published_on").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
    });

    $('.wbg-closebtn').on('click', function() {
        this.parentElement.style.display = 'none';
    });

})(jQuery);