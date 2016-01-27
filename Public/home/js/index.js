  $(document).ready(function(){ 
    var headHeight=$(".photos").height()+10; 
    var mynav=$("#tablist"); 
    $(window).scroll(function(){ 
      if($(this).scrollTop()>headHeight){ 
        mynav.addClass("navFix"); 
      } 
      else{
        mynav.removeClass("navFix"); 
      } 
    });
  	$(".left_content").click(function() {
  		$(this).parent(".section-inner").siblings().children(".left_content").addClass("h40").removeClass("hAuto");
        //$(".share").hide();
        if (!($(this).hasClass("hAuto"))){
        	$(".qh-1 .left_content").each(function(){
        		$(this).removeClass("h40");
        	});
        	$(this).addClass("hAuto");
          //$(this).parent(".section-inner").children(".am-cf").children(".share").show();
        }
        else{   
         $(this).removeClass("h40"); 
         $(this).removeClass("hAuto"); 
          //$(this).parent(".section-inner").children(".am-cf").children(".share").hide();        
        }    
      });
  }) 


  jQuery(document).ready(function ($) {
  	"use strict";
  	$('.Detailspage').perfectScrollbar({suppressScrollX: true});
  });
  $(function(){
    gdingwidth=$("#gding").width()-1;
    gdingtop=$("#gding").offset().top;                
    footHeight=$(".footer").height();
    $(window).scroll(function(){
      foottop=$(".footer").offset().top;
      scrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();
      footBottom= foottop - $(window).height() - $(window).scrollTop();
      if($(this).scrollTop()>gdingtop && scrollBottom>footHeight){
        $("#gding").removeClass("gdingB");
        $("#gding").addClass("gding").width(gdingwidth);
      }else if(scrollBottom<=footHeight){
        $("#gding").removeClass("gding");
        $("#gding").addClass("gdingB").css("bottom",14-footBottom).width(gdingwidth); 
      }
      else{
        $("#gding").removeClass("gding").removeClass("gdingB").css("bottom","0");
      }
    })
  })
