$(".tpy-template").each(function () {
    var $template = $(this);

    $(".panel", this).hide();
    $(".close, .text-center .btn-default", this).click(function () {
        $(".panel", $template).hide();
    });
    $(".text-center .btn-primary", this).click(function () {
        alert('TODO: db saving not implemented yet');
        $(".panel", $template).hide();
    });

    $(".output", this).click(function () {
        $($(this).data('target')).toggle();
    }).mouseenter(function () {
        $template.addClass('enter');
    }).mouseleave(function () {
        $template.removeClass('enter');
    });

    $('.form-control', this).keyup(function () {
        $input = $(this);
        var id = $input.attr('id');
        $('*', $template).filter(function () {
            return $(this).attr('tpy:content') == 'model/' + id;
        }).each(function () {
            // matched a div with tpy:content
            $(this).html($input.val());
        });
        // TODO: implement attributes
    });

})




