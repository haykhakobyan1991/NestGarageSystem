function get_child_function($th) {
    return function () {
        var id = $th.attr('id'),
            url = $th.data('url'),
            result = $th.data('result'),
            response = $th.data('response'),
            response_type = $th.data('res_type'),
            lang = $th.data('lang'),
            val = $(this).val();
        $('#' + result).removeClass('d-none');
        start_load(result);
        $.post(url, {name: id, value: val, response: response, response_type: response_type, lang: lang}).done(function (data) {
            $('#' + result).html(data);


            if(data == '') {
                $(".lastChild select").remove();
            }
        }, function () {

            $(".getChild").each(function () {

                $(this).get_child();

            });




        });


    };
}




function start_load($this) {
    $('#' + $this).html('<i class="fas fa-spinner fa-spin"></i>');
}



$.fn.get_child = function () {

    $th = $(this);
    $e = $th.find("select[name],input[name],textarea[name]");

    if ($e.length > 0) {
        $e.change(get_child_function($th));
    }
}

$(window).on('load', function () {

    $(".getChild").each(function () {

        $(this).get_child();

    });
});


