$(".tpy-template").each(function () {
    var $template = $(this),
        $form = $('form', $template);

    $(".panel", this).hide();
    $(".close, .text-center .btn-default", this).click(function () {
        $(".panel", $template).hide();
    });
    $(".text-center .btn-primary", this).click(function () {
        console.log($form);
        console.log($form.serialize());
        $.ajax({
            url: '?r=templay/template/save',
            type: 'post',
            data: $form.serialize(),
            //dataType: data.settings.ajaxDataType,
            success: function (msgs) {
                alert('Yeah, cool! I got it. Aaaand .... '+msgs);
            },
            error: function (msgs) {
                alert('Uh oh, something went wrong?!'+msgs);
            }
        });

        //alert('TODO: db saving not implemented yet');
        $(".panel", $template).hide();
    });

    $(".output", this).click(function () {
        $($(this).data('target')).toggle();
    }).mouseenter(function () {
        $template.addClass('enter');
    }).mouseleave(function () {
        $template.removeClass('enter');
    });

    $('INPUT',$form).keyup(function () {
        $input = $(this);
        var name = $input.attr('name');
        $('*', $template).filter(function () {
            return $(this).attr('tpy:content') == 'model/' + name;
        }).each(function () {
            // matched a div with tpy:content
            $(this).html($input.val());
        });
        // TODO: implement attributes
    });

})




