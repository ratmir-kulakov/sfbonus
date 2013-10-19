$(document).ready(function(){
    /*-----Common-----*/
    if( $('#searchFld').length )
    {
        $('#searchFld').attr('placeholder', '').val($('#searchFld').attr('title'));
        
        $('#searchFld').focus(function(){
            if($(this).val() == $(this).attr('title')) 
            { 
                $(this).val(''); 
                $(this).addClass('filled');
            }
        }).blur(function(){
            if($(this).val() == '') 
            { 
                $(this).val($(this).attr('title')); 
                $(this).removeClass('filled');
            }
        });
    }
    
    
    //Слайдер с одной фотографией на главной странице
    if($("#banner-one-img").length)
    {
        $("#banner-one-img").nivoSlider({
            animSpeed: 400,
            controlNav: true,
            directionNav: false,
            effect: "fold",
            pauseTime: 8000,
            startSlide: 0
        });
        
        $('#banner-one-img').data('nivoslider').stop();
    }/*Конец кода слайдера*/
    
    /*-----Formula-----*/
    if( $('#formula').length )
    {
        var $scrollBar = $('#scroll-bar'),
            $scrollBarLine = $scrollBar.find('.scroll-bar-line'),
            $scrollHandle = $scrollBar.find('.ui-slider-handle'),
            $scrollContent = $('#formula'),
            $scrollContentParent = $('#formula').closest(".formula-limiter"),
            $scrollPane = $scrollContentParent;

        $scrollBar.data('frmlLimiter', parseInt($scrollContentParent.css("max-width")));
        $scrollBar.slider({
            create: function( event, ui ) {
                if( $(document).outerWidth() > $scrollBar.data('frmlLimiter') )
                {
                    $scrollBar.data('delta', ($scrollBar.data('frmlLimiter') - $('#h').outerWidth()) / 2 + 17);
                }
                else
                {
                    $scrollBar.data('delta', $('#h').offset().left + 17);
                }
                $scrollContent.css({'left': $scrollBar.data('delta') + 'px'});
            },
            slide: function( event, ui ){
                if ( $scrollContent.width() > $scrollPane.width() - 2 * $scrollBar.data('delta') ) {
                    $scrollContent.css( "margin-left", Math.round(
                        ui.value / 100 * ( $scrollPane.width() - $scrollContent.width() - 2 * $scrollBar.data('delta') )
                    ) + "px" );
                } else {
                    $scrollContent.css( "margin-left", 0 );
                }
            }
        });
        
        //change overflow to hidden now that slider handles the scrolling
        $scrollPane.css( "overflow", "hidden" );

        //change handle position on window resize
        $( window ).resize(function() {
            if( $(document).outerWidth() > $scrollBar.data('frmlLimiter') )
            {
                $scrollBar.data('delta', ($scrollBar.data('frmlLimiter') - $('#h').outerWidth()) / 2 + 17);
            }
            else
            {
                $scrollBar.data('delta', $('#h').offset().left + 17);
            }
            $scrollContent.css({'left': $scrollBar.data('delta') + 'px'});
        });
    }
    
    /*-----Tabs on main page-----*/
    if( $( "#tabs .tab" ).length > 1 )
    {
        $( "#tabs" ).tabs({
            activate: function( event, ui ) {
                if( ui.newPanel.attr('id') == 'rotate-banners-box' )
                {
                    $('#banner-one-img').data('nivoslider').start();
                }
                else
                {
                    $('#banner-one-img').data('nivoslider').stop();
                }
            }
        });
    }
    
    /*-----Tabs on Partners page-----*/
    $( ".tabs" ).tabs();
    
    
    /*-----Feedbacck-----*/
    var $sendMailFrm = $('#send-mail-form'),
        $frm_fio = $('#frm_fio'),
        $frm_email = $('#frm_email'),
        $frm_question = $('#frm_question');
        
    $frm_fio.attr({'autocorrect': 'off'});    
    $frm_email.attr({'autocapitalize': 'off', 'autocorrect': 'off'});    
    
    var sendMail = function(){
        $.ajax({
            url: '/sendmail.php',
            data: $sendMailFrm.serialize(),
            type: 'POST',
            dataType: 'json',
            beforeSend: function(jqXHR){
                $sendMailFrm.hide();
                $('.ui-dialog-buttonpane').hide();
                $.data(document.body, 'smloader').show();
                $.data(document.body, 'sminfo').removeClass('jv-error');
            },
            success: function(data, jqXHR, textStatus){
                $.data(document.body, 'smloader').hide();
                if( data.status == 'success' )
                {
                    $.data(document.body, 'sminfo').text(data.text).show();
                    $('#frm_fio, #frm_email, #frm_question').val('');
                }
                else
                {
                    $.data(document.body, 'sminfo').text(data.text).show();
                    if( data.fields )
                    {
                        $.data(document.body, 'sminfo').addClass('jv-error');
                        
                        $frm_fio.val(data.fields.frm_fio.value);
                        $frm_email.val(data.fields.frm_email.value);
                        $frm_question.val(data.fields.frm_question.value);
                        
                        if( data.fields.frm_fio.message != '' )
                        {
                            $frm_fio.parent().append(
                                $('<label />').addClass('jv-error')
                                    .attr('for', 'frm_fio')
                                    .text(data.fields.frm_fio.message)
                            );
                            $frm_fio.addClass('jv-error');
                        }
                        if( data.fields.frm_email.message != '' )
                        {
                            $frm_email.parent().append(
                                $('<label />').addClass('jv-error')
                                    .attr('for', 'frm_email')
                                    .text(data.fields.frm_email.message)
                            );
                            $frm_email.addClass('jv-error');
                        }
                        if( data.fields.frm_question.message != '' )
                        {
                            $frm_question.parent().append(
                                $('<label />').addClass('jv-error')
                                    .attr('for', 'frm_question')
                                    .text(data.fields.frm_question.message)
                            );
                            $frm_question.addClass('jv-error');
                        }
                        
                        $sendMailFrm.show();
                        $('.ui-dialog-buttonpane').show();
                    }
                    else
                    {
                        $('#frm_fio, #frm_email, #frm_question').val('');
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                $.data(document.body, 'smloader').hide();
                $.data(document.body, 'sminfo').text('Во время отправки письма произошла ошибка. Извините за доставленные неудобства. Попробуйте через некоторое время снова отправить письмо.').show();
                $('#frm_fio, #frm_email, #frm_question').val('');
            }
        });
    };
    
    var validator = $sendMailFrm.validate({
        debug: true,
        errorClass: "jv-error",
        rules: {
            frm_question: "required",
            frm_fio: "required",
            frm_email:{
                required: true,
                email: true
            }
        },
        submitHandler: function(form){
            sendMail();
        }
    });
    
    $( "#feedback-form" ).dialog({
        autoOpen: false,
        closeText: "",
        height: 510,
        width: 460,
        modal: true,
        open: function(){
            if( ! $.data(document.body, 'smloader') ) 
            {
                $smLoader = $('<div />').hide();
                $smLoader.addClass('sm-loader');
                $smInfo = $('<p />').hide();
                $smInfo.addClass('sm-info');
                $(this).append($smLoader);
                $(this).prepend($smInfo);
                $.data(document.body, 'smloader', $smLoader);
                $.data(document.body, 'sminfo', $smInfo);
            }
        },
        beforeClose: function( event, ui ) {
            $sendMailFrm.show();
            $('.ui-dialog-buttonpane').show();
            $.data(document.body, 'smloader').hide();
            $.data(document.body, 'sminfo').removeClass('jv-error').hide();
            $('#frm_fio, #frm_email, #frm_question').removeClass('jv-error');
            validator.resetForm();
        },
        buttons: [
            {
                text: "Отправить",
                click: function(){
                    $sendMailFrm.submit();
                }
            }
        ]
    });
    
    $('#feedback').click(function(){
        $( "#feedback-form" ).dialog('open');
        return false;
    });
    
});