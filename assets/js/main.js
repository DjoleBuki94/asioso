//animation
var $animation_elements = $('.animation-element');
var $window = $(window);

function check_if_in_view() {
  var window_height = $window.height();
  var window_top_position = $window.scrollTop();
  var window_bottom_position = (window_top_position + window_height);
 
  $.each($animation_elements, function() {
    var $element = $(this);
    var element_height = $element.outerHeight();
    var element_top_position = $element.offset().top;
    var element_bottom_position = (element_top_position + element_height);
 
    //check to see if this current container is within viewport
    if ((element_bottom_position >= window_top_position) &&
        (element_top_position <= window_bottom_position)) {
      $element.addClass('in-view');
    } else {
      $element.removeClass('in-view');
    }
  });
}

$window.on('scroll resize', check_if_in_view);
$window.trigger('scroll');

//email validation
$('#btn-submit').click(function() {  
    $(".error").hide();
    var hasError = false;
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    var emailaddressVal = $("#UserEmail").val();
    if(emailaddressVal == '') {
        $("#UserEmail").after('<span class="error">Please enter your email address.</span>');
        hasError = true;
    }

    else if(!emailReg.test(emailaddressVal)) {
        $("#UserEmail").after('<span class="error">Enter a valid email address.</span>');
        hasError = true;
    }

    if(hasError == true) { return false; }

});


//video popup
jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
    return this;
}
  
  
$(document).ready(function() {
  
  $(".video").css({
    "width"  : $("#player").css("width"),
    "height" : $("#player").css("height")
  });
  
  $(".btn-video").click(function() {
    $(".video-wrapper").fadeIn('fast', function() {
      $(".video").fadeIn(); 
      $(".video").center(); 
    });
        
  });
  
  $(".video-wrapper").click(function(e) {
    if($(e.target).is(".video-wrapper")) {
      $(".video").fadeOut(function() {
        $(".video-wrapper").fadeOut(function() {
         $(".video, .video-wrapper").css({'display':'none'}); 
          var src=$("#player").attr("src");
          $("#player").attr("src", "");
          $("#player").attr("src", src);
        });
      });
    }
  });
  
  $(document).keyup(function(e) {
    var isShown=$(".video-wrapper").css("display");
    
    if(isShown !== "none" && e.which==27) {
       $(".video-wrapper").click(); 
    }
    
  });
    
    
    
//navigation active class    
  $(function() {
     var pgurl = window.location.href.substr(window.location.href
    .lastIndexOf("/")+1);
     $(".ms-auto a ").each(function(){
          if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
          $(this).closest("a").addClass("active"); 
     })
});
  
});