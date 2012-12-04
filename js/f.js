$(document).ready(function(){
    var $window = $(window),
        pageInfoHeight = $("#page-info").outerHeight(),
        $chBoxList = null,
        $mainMenuBox = $("#mainMenuBox"), 
        offsetHeight = 0;
    
    if( $("input.checkbox").length )
    {
        $chBoxList = $("input.checkbox");
        $chBoxList.niceCheckbox();
    }
    
    /*-----Login-----*/ 
    if( $('#login').length && $('#password').length )
    {
        var $login = $('#login'),
            $password = $('#password');
        
        $login.focus();
        if( $login.val() != '' )
        {
            $login.parent().find(".pseudo-label." + $login.attr("id")).hide();
        }
        if( $password.val() != '' )
        {
            $password.parent().find(".pseudo-label." + $password.attr("id")).hide();
        }
        $("#login, #password").on('keydown mousedown', function(){
            $(this).parent().find(".pseudo-label." + $(this).attr("id")).hide();
        }).blur(function(){
            if($(this).val() == "")
            {
                $(this).parent().find(".pseudo-label." + $(this).attr("id")).show();
            }
        });   
    }
    /*
    if($("#sm-box").length)
    {
        $("#sm-box").jScrollPane({
            height: 305,
            scrollbarWidth: 7, 
            width: 856
        });
    }
    */
    
    
    // side bar
    $('.left-sidenav').affix({
        offset: {
            top: function(){
                return pageInfoHeight - 42;
            },
            bottom: 100
        }
    });
    
    $('#controls-btn').affix({
        offset: {
            top: function(){
                return pageInfoHeight - 30;
            }
        }
    });


    $(".toggle-all").click(function(){
        var $this = $(this),
            selector = $this.attr("data-target"),
            $objList = $(selector);
        
        
        if( ! $this.hasClass("toggle-on") )
        {
            $this.attr("data-check-title", $this.text());
            if( $objList.length )
            {
                $objList.niceCheckbox('checkAll');
                
                if( $this.attr("data-target") == ".imgs-list" )
                {
                    $("#removeAllPhotoBtn").attr("disabled", false);
                }
            }
            $this.addClass("toggle-on")
                 .text($this.attr("data-uncheck-title"));
        }
        else
        {
            if( $objList.length )
            {
                $objList.niceCheckbox('uncheckAll');
                
                if( $this.attr("data-target") == ".imgs-list" )
                {
                    $("#removeAllPhotoBtn").attr("disabled", true);
                }
            }
            $this.removeClass("toggle-on")
                 .text($this.attr("data-check-title"));
        }
            
        return false;
    });
    
    $(".imgs-list input[type=checkbox].checkbox, .imgs-list .niceCheck").click(function(e){
        var $this = $(this),
            $commonParent = $this.parents(".imgs-list").eq(0);
        
        if( $commonParent.find("input[type=checkbox].checkbox:checked").length )
        {
            $("#removeAllPhotoBtn").attr("disabled", false);
        }
        else
        {
            $("#removeAllPhotoBtn").attr("disabled", true);
        }
    });
    
    //Scroll on item page
    $window.on('scroll', function() {
        var $this = $(this),
            height = ($mainMenuBox.length)? $mainMenuBox.outerHeight(): 0;
        
        if( $("#controls-btn").length )
        {
            height += $("#controls-btn").outerHeight() + 12;
        }
        
        offsetHeight = height;
        
        if( $this.scrollTop() <= 5)
        {
            $("#local-nav li").removeClass("active");
        }
        else if( $(document).outerHeight() == $this.outerHeight() + $this.scrollTop() )
        {
            $("#local-nav li").removeClass("active");;
            $("#local-nav li:last").addClass("active");;
        }
        else
        {
            $("#local-nav a").each(function(){
                var id = $(this).attr("href"),
                    $selectedBlock = $(id),
                    $parentLi = null;

                if($selectedBlock && $selectedBlock.length)
                {
                    if( $this.scrollTop() >= $selectedBlock.offset().top - offsetHeight && $this.scrollTop() < $selectedBlock.offset().top - offsetHeight + $selectedBlock.outerHeight() )
                    {
                        $parentLi = $(this).parents("li").eq(0);
                        if(! $parentLi.hasClass("active") )
                        {    
                            $(this).parents("ul").find("li").removeClass("active");
                            $parentLi.addClass("active");
                        }
                    }
                }
            });
        }
    
    });
    
    $("#local-nav a").click(function(e){
        var $clickedLink = $(this),
            id = $clickedLink.attr("href"), 
            $selectedBlock = null;
        
        $selectedBlock = $(id);
        if($selectedBlock && $selectedBlock.length)
        {
            $window.scrollTop($selectedBlock.offset().top - offsetHeight);
        }
        
        
        $clickedLink.parents("ul").find("li").removeClass("active");
        $clickedLink.parents("li").eq(0).addClass("active");
        
        return false;
    });
    
});