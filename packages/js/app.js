(function ($) {

    var FormApplication = {
        activity: $('<span class="activity-indicator fade fa fa-circle-o-notch fa-spin"><\/span>').appendTo('body'),
        dialog: $('<div class="modal fade"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title"></h4></div><div class="modal-body tile-wrap"><p>One fine body&hellip;</p></div></div><span class="modal-next"><i class="fa fa-chevron-right"></i></span><span class="modal-prev"><i class="fa fa-chevron-left"></i></span></div></div>').modal( {
            show: false
        } ),
        ajaxForm: {
            dataType: 'json',
            delegation: true,
            beforeSubmit: function(a, f) {
                // Call any ajaxValidate events bound to form
                // and interrupt submission if necessary
                var e = $.Event('ajaxValidate');
                f.trigger(e);

                return !e.isDefaultPrevented();
            },
            success: function (data, xhr, status, $form) {
                "use strict";
                if (data.error)
                {
                    new PNotify({
                        title: 'Error',
                        text: '<strong>There were some errors:</strong>\n' + data.message,
                        type: 'error'
                    });
                }
                else
                {
                    var n = new PNotify({
                        title: 'Congrats!',
                        text: data.message,
                        type: 'success'
                    });

                    $form.trigger('contentUpdate', [data]);

                    if ($form.data('close')) {
                        console.log(this);
                        console.log(FormApplication.dialog);
                        FormApplication.dialog.modal('hide');
                    }
                    else if ($form.data('redirect'))
                    {
                        var g = $form.data('redirect');

                        setTimeout(function(){
                            self.location.href = g;
                        }, 300);
                    }
                    else if (data && data.redirect)
                    {
                        var g = data.redirect;

                        setTimeout(function(){
                            self.location.href = g;
                        }, 300);
                    }
                }
                $.rails.enableFormElements($($.rails.formSubmitSelector));
            },
            error: function (x, s, t, f) {
                new PNotify({
                    title: 'Error',
                    text: t,
                    type: 'error'
                });
                $.rails.enableFormElements($($.rails.formSubmitSelector));
            }
        }
    };


    $("body").tooltip({
        container: 'body',
        selector: '[data-toggle="tooltip"]'
    });

    // Any item with data-dialog attrobute shows a modal with content loaded from the href
    $('body').on('click', '[data-dialog]', function(e){
        e.preventDefault();

        // Large dialog
        if ($(this).data('dialog') == 'lg')
        {
            $('.modal-dialog', FormApplication.dialog).addClass('modal-lg');
        }
        else
        {
            $('.modal-dialog', FormApplication.dialog).removeClass('modal-lg');
        }

        var title = $(this).data('title') || $(this).data('original-title') || $(this).attr('data-original-title') || $(this).attr('title')

        $('.modal-title', FormApplication.dialog).text( title );
        $('.modal-body', FormApplication.dialog).empty().load( $(this).data('href'), function(responseText, textStatus, jqXHR){
            switch(jqXHR.status)
            {
                case 200:
                    try
                    {
                        var d = $.parseJSON(responseText);

                        if (d.status != 200)
                        {
                            new PNotify({
                                title: 'Error',
                                text: '<strong>There were some errors:</strong>\n' + d.message,
                                type: 'error'
                            });
                            $('.modal-body', FormApplication.dialog).empty();
                            return;
                        }
                    }
                    catch (err)
                    {
                        $('.form-ajax', FormApplication.dialog).bootstrapValidator().ajaxForm(FormApplication.ajaxForm);
                    }

                    break;
                case 404:
                    $('.modal-body', FormApplication.dialog).html('<p class="alert alert-danger">The item you tried to access was not found.</p>');
                    break;
                default:
                    $('.modal-body', FormApplication.dialog).html('<p class="alert alert-danger">There was an error getting information from the server.</p>');
            }
            FormApplication.dialog.modal('show');
        } );
    });

    // Set notice styling
    PNotify.prototype.options.styling = "fontawesome";

    // Show spinner on ajax requests and hide when complete
    $(document).ajaxSend(function () {
        FormApplication.activity.addClass('in');
    }).ajaxComplete(function () {
        FormApplication.activity.removeClass('in');
    }).ajaxError(function () {
        FormApplication.activity.removeClass('in');
    });


    $('.form-validate')
        .on('status.field.bv', function(e, data) {
            if (data.bv.getSubmitButton()) {
                data.bv.disableSubmitButtons(false);
            }
        }).bootstrapValidator();
    $('.form-ajax').ajaxForm(FormApplication.ajaxForm);

    // All the evil form code
    var $form = $('#form_entry');
    if ($form.length) {
        $form.on('checkSettings', function () {
            $('.btn-prev').toggleClass('disabled', $('.nav-tabs > .active').prev('li').length == 0);
            $('.btn-next').toggleClass('disabled', $('.nav-tabs > .active').next('li').length == 0);
        });

        // Focus hidden invalid items
        $('input', $form).bind('invalid', function(event) {
            var $pane = $(this).closest('.tab-pane'),
                $id  = $pane.attr('id'),
                $tab = $('.nav-tabs').find('a[href="#'+$id+'"]'),
                $msg = event.target.validationMessage || 'Invalid value.';
            if (!$pane.hasClass('active'))
            {
                event.stopImmediatePropagation();
                $tab.tab('show');
                event.target.focus();
                new PNotify({
                    title: 'Error',
                    text: $msg,
                    type: 'error'
                });
            }
        });

        $('.form-action .btn-primary').click(function(){
            $('#confirmField').prop('disabled', true);
        })

        $('.btn-success').click(function() {
            $('#confirmField').prop('disabled', false);
            $('.form-ajax').trigger('submit');
        });

        $('.btn-prev').click(function () {
            if (!$(this).hasClass('disabled')) {
                $('a', $('.nav-tabs > .active').prev('li')).trigger('click');
            }
        });

        $('.btn-next').click(function () {
            if (!$(this).hasClass('disabled')) {
                $('a', $('.nav-tabs > .active').next('li')).trigger('click');
            }
        });

        $('.nav-tabs a').on('shown.bs.tab', function () {
            //$('body,html').animate({scrollTop: 0}, 300);
            $form.trigger('checkSettings');
            $('.tab-pane.active :input').first().focus();
        });

        // Allow tabbing to next or previous tab
        $('.tab-pane').on('keydown', ':input:first', function(e) {
            if (!(e.which == 9 && e.shiftKey)) return;
            e.preventDefault();
            $('.btn-prev').trigger('click');
        });
        $('.tab-pane').on('keydown', ':input:last', function(e) {
            if (e.which != 9 || e.shiftKey) return;
            e.preventDefault();
            $('.btn-next').trigger('click');
        });

        $('.uploader').each(function(index, element){

            var $zone    = $('.uploads', element),
                $delete  = $(element).data('delete-url'),
                $element = $(element),
                $dropzone;
            var $options = {
                url: $element.data('upload-url'),
                acceptedFiles: $element.data('upload-filters'),
                maxFiles: 1,
                addRemoveLinks: true,
                init: function() {
                    $dropzone = this;
                    var $existing = $element.data('existing');
                    if ($existing.length >= 1) {
                        for (var i=0; i < $existing.length; i++) {
                            $dropzone.emit('addedfile', $existing[i]);
                        }
                        $zone.addClass('dz-max-files-reached');
                    }
                    $dropzone.on("maxfilesexceeded", function(file) { this.removeFile(file); });
                },
                error: function(file, message) {
                    var node, _i, _len, _ref, _results;
                    if (file.previewElement) {
                        file.previewElement.classList.add("dz-error");
                        if (typeof message !== "String" && message.error && typeof message.error.message !== "undefined") {
                            message = message.error.message;
                        }
                        else if (message.error) {
                            message = message.error;
                        }

                        message = message || 'Unknown error';

                        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                        _results = [];
                        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                            node = _ref[_i];
                            _results.push(node.textContent = message);
                        }
                        return _results;
                    }
                },
                removedfile: function(file) {
                    console.log(file);
                    if (!file.accepted || file.status == Dropzone.ERROR) {
                        if ($('.dz-preview', $element).length <= 1) {
                            $zone.removeClass('dz-max-files-reached');
                        }
                        $(file.previewElement).transitionOut();
                    }
                    else {

                        $('.dz-remove', file.previewElement).hide();

                        $.post($delete, {_method: 'delete'}, function() {
                            if ($('.dz-preview', $element).length <= 1) {
                                $zone.removeClass('dz-max-files-reached');
                            }
                            $(file.previewElement).transitionOut();
                        }).fail(function(){
                            $('.dz-remove', file.previewElement).show();
                        });
                    }
                }
            }

            $zone.dropzone($options);


        });
    }
    else
    {
        $('.btn-next').click(function () {
            if (!$(this).hasClass('disabled')) {
                $('a', $('.nav-tabs > .active').next('li')).trigger('click');
            }
        });
    }

    // Date input
    $('input[data-type=date]').each(function(i, e){
        if (!$(e).data('date-format'))
        {
            $(e).attr('data-date-format', 'm/d/yyyy').data('date-format', 'm/d/yyyy');
        }

        var format = $(e).attr('data-date-format');

        if ($(e).val() == '0')
        {
            $(e).val('');
        }
        $(e).wrap($('<div class="input-group date"/>').data('date-format', format)).parent().append('<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>').datepicker({
            pickTime: false,
            autoclose: true
        });
    });

    // Filtering
    $('[data-filter]').each( function(i, e){

        var $filter = $(this).data('filter'),
            $items = $($(this).data('items'));

        $($filter).liveFilter(e, $items);
    });

    // Load
    $('body').on('click', '[data-load]', function(e){
        e.preventDefault();

        var $load = $(this).data('load'),
            $target = $($(this).data('target'));

        $(this).addClass('active').siblings('.active').removeClass('active');

        $target.load( $load, function(responseText, textStatus, jqXHR){
            switch(jqXHR.status)
            {
                case 200:
                    $('body').animate({scrollTop: 0}, 300);
                    //$('body').animate({scrollTop: $target.offset().top}, 200);
                    break;
                case 404:
                    $target.html('<p class="alert alert-danger">The item you tried to access was not found.</p>');
                    break;
                default:
                    $target.html('<p class="alert alert-danger">There was an error getting information from the server.</p>');
            }
        } );
    });



    /**
     * Fade out and remove
     * @param options
     * @returns {*}
     */

    $.fn.transitionOut = function(options) {

        var settings = $.extend({
            effects: {
                height: 0,
                opacity: 0
            },
            speed: 750,
            callback: function() {}
        }, options);

        return this.each(function(i, e) {
            var el = e;
            $(e).animate(settings.effects, settings.speed, function() { $(el).remove(); settings.callback(); });
        });
    };

    //Add more button functionality
    $(document).ready(function(){
        $('.addmore').on("click",function(){
                $counter = parseInt($(this).attr("counter")) + 1;
                $total = parseInt($(this).attr("total"));
                $semester = $(this).attr("semester");
                $div = $(this).attr("div");
                $typef = $(this).attr("typef");
                $type = $(this).attr("typef").toLowerCase();
                $('.'+$div).append('<div class="form-group"><div class="row"><div class="col-sm-8"><input class="form-control input-sm" id="entry_'+ $type + $counter + $semester + '" name="'+$semester +'_'+ $type + $counter + '" type="text" value=""></div></div></div>')
                $(this).attr("counter",$counter);
                if($counter >= $total){
                    $(this).css('display','None');
                }
            })

        $('.addmorebasic').on("click",function(){
                $counter = parseInt($(this).attr("counter")) + 1;
                $total = parseInt($(this).attr("total"));
                $name = $(this).attr("name");
                $label = $(this).attr("label");
                $div = $(this).attr("div");
                $typef = $(this).attr("typef");
                $type = $(this).attr("typef").toLowerCase();
                $('.'+$div).append('<div class="form-group"><div class="row"><div class="col-sm-8"><input class="form-control input-sm" id="entry_'+ $name + $counter  + '" name="'+ $name + $counter + '" type="text" value=""></div></div></div>')
                $(this).attr("counter",$counter);
                if($counter >= $total){
                    $(this).css('display','None');
                }
            })
    })

})(jQuery);


