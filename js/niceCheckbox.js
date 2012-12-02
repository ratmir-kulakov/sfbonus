(function( $ ){
     var wrapArr = new Array(),
         chckBoxArr = new Array(),
         methods = {
            init : function( options ) {
                var settings = {}

                if ( options ) { 
                    $.extend( settings, options ); 
                }

                this.each(function(){
                    createSpanWrap($(this));
                    chckBoxArr[chckBoxArr.length] = $(this);
                    $(this).hide();
                    $(this).on('change', function(){
                        var $parent = $(this).parents(".niceCheck").eq(0);
                        
                        if( $(this).is(":checked") )
                        {
                            $(this).attr('checked', false);
                            changeCheckStatus($parent, false)
                        }
                        else
                        {
                            $(this).attr('checked', true);
                            changeCheckStatus($parent, true);
                        }
                    });
                });
                
                $(".niceCheck").on("click", function(){
                    var $chckBox = $(this).find('input[type=checkbox]')
                    $chckBox.change();
                });
            },
            checkAll: function(){
                $.each(chckBoxArr, function(){
                    var $parent = this.parents(".niceCheck").eq(0);
                    
                    this.attr('checked', true);
                    if( ! $parent.hasClass('checked') )
                    {
                        $parent.addClass('checked');
                    }
                });
            },
            uncheckAll: function(){
                $.each(chckBoxArr, function(){
                    var $parent = this.parents(".niceCheck").eq(0);
                    
                    this.attr('checked', false);
                    if( $parent.hasClass('checked') )
                    {
                        $parent.removeClass('checked');
                    }
                });
            },
            issetChecked : function(){
                var rslt = false;
                $.each(chckBoxArr, function(){
                    var $parent = this.parents(".niceCheck").eq(0);
                    
                    if( this.attr('checked') && $parent.hasClass('checked') )
                    {
                        rslt = true;
                        return;
                    }
                });
                
                return rslt;
            }
        },
        createSpanWrap = function($obj){
            $obj.wrap(wrapArr[wrapArr.length] = $('<span class="niceCheck" />'));
        },
        changeCheckStatus = function($obj, status){
            if( status )
            {
                $obj.addClass("checked");
            }
            else
            {
                $obj.removeClass("checked");
            }
        }
    
    
    jQuery.fn.niceCheckbox = function( method ) {
        if( $.fn.jquery < '1.4' )
        {
            return false;
        }
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Метод ' +  method + ' в jQuery.niceCheckbox не существует' );
        }  
    };
})( jQuery )