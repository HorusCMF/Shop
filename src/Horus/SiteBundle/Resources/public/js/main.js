$(function () {

    //suggestion search in ajax
    if ($("#search_input").length > 0) {
        $("#search_input").autocomplete({
            minLength: 2,
            scrollHeight: 220,
            source: function (req, add) {
                return $.ajax({
                    url: $("#search_input").attr('data-url'),
                    type: "get",
                    dataType: "json",
                    data: "query=" + req.term,
                    cache: true,
                    success: function (data) {
                        return add($.map(data, function (item) {
                            return {
                                nom: item.nom,
                                url: item.url
                            };
                        }));
                    }
                });
            },
            focus: function (event, ui) {
                $(this).val(ui.item.nom);
                return false;
            },
            select: function (event, ui) {
                window.location.href = ui.item.url;
                return false;
            }
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li></li>").data("ui-autocomplete-item", item).append("<a href=\"" + item.url + "\">" + item.nom + "</span></a>").appendTo(ul.addClass("list-row"));
        };
    }


    // Get Fancyboxes
    $(".fancybox").fancybox();
    $poped = $('#notifications');
    $poped.popover({
        content: $("#notifications-content").html(),
        html: true
    }).click(function (evt) {
            evt.stopPropagation();
            return $(this).popover("show");
    });

    // Get Tooltips
    $('.popov').popover({
        placement: "bottom",
        trigger: 'focus',
        content: $(this).attr('data-content'),
        html: true
    });
    $('.popov').attr('data-original-title', "<i class='glyphicon glyphicon-question-sign'></i> Aide");


    $("#btn-tchat").click(function (evt) {
        $('#messagerie').css('visibility', 'visible');
        return $('#messagerie').show();
    });
    $("#messagerie").draggable();
    $(".closemessagerie").click(function () {
        $('#messagerie').css('visibility', 'hidden');
        return $('#messagerie').hide();
    });
    $("html").click(function () {
        return $poped.popover("hide");
    });
    $(window).scroll(function () {
        if ($(document).scrollTop() >= 100) {
            return $('body .navbar-default').stop(true, true).animate({
                opacity: 0.8
            });
        } else {
            return $('body .navbar-default').stop(true, true).animate({
                opacity: 1
            });
        }
    });
    $("body .navbar-default").hover((function () {
        return $(this).stop(true, true).animate({
            opacity: 1
        });
    }), function () {
        if ($(document).scrollTop() >= 100) {
            return $('body .navbar-default').stop(true, true).animate({
                opacity: 0.8
            });
        }
    });


    $('.ishome').click(function (evt) {
        $obj = $(this);
        $.ajax({
            url: $(this).attr('data-url'),
            type: "get",
            dataType: "json",
            success: function (data) {
                if($obj.hasClass('athome')){
                    $obj.find('i').attr('class','pull-left glyphicon glyphicon-heart-empty');
                }else{
                    $obj.find('i').attr('class','pull-left glyphicon glyphicon-heart');
                }
            }
        });
    });

    $('.multiselect').multiselect({
        buttonText: function (options, select) {
            var selected;
            if (options.length === 0) {
                return "Aucune";
            } else {
                selected = "";
                options.each(function () {
                    return selected += $(this).text() + ", ";
                });
                return selected.substr(0, selected.length - 2) + " <b class=\"caret\"></b>";
            }
        },
        maxHeight: 200,
        maxWidth: 200,
        buttonWidth: 200,
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true
    });
    $(".date").datepicker();
    $('.alert-success').delay(5000).slideUp('fast');
    $('#moresearch').click(function () {
        return $('#advancedsearch').toggleClass('hide', '');
    });
    $('form').on("submit", function (event) {
        $(this).find('button[type=submit]').attr('disabled', 'disabled');
        $(this).find('button[type=submit]').text('Envoi en cours...');
        return $('#overlay').removeClass('hide');
    });
    $("input[required]").on("blur", function (event) {
        if ($(this).val().length == 0 && $(this).val() == "") {
            return $(this).addClass('parsley-error');
        }
    });
    $("input[required]").on("keydown", function (event) {
        return $(this).removeClass('parsley-error');
    });
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            return $(".scrollup").fadeIn();
        } else {
            return $(".scrollup").fadeOut();
        }
    });
    return $(".scrollup").click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
});
