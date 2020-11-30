$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});


$(document).ready(function(){
  
  /* 1. Visualizing things on Hover - See next part for action on click */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    var msg = "";
    if (ratingValue > 1) {
        msg = "Thanks! You rated this " + ratingValue + " stars.";
        document.getElementById("reat").value = ratingValue;
    }
    else {
        msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
        document.getElementById("reat").value = ratingValue;
    }
    responseMessage(msg);
    
  });
  
  document.getElementById("reat").value = ratingValue;
});


function responseMessage(msg) {
  $('.success-box').fadeIn(200);  
  $('.success-box .text-message').html("<span>" + msg + "</span>");
  $('#reat').val(ratingValue);
}




$('#menu').css("right","-300px");
	$('.menu_icon').on('click',function(){
		if($('.menu_icon').hasClass('open')){
			$(this).removeClass('open');
			$(this).animate({
				"right":"20px",
				"background-position":"0px"
			});
			$('#menu').animate({"right":"-300px"});
			
		}
		else{
			$(this).addClass('open');
			$(this).animate({
				"right":"310px",
				"background-position":"-40px"
			});
			$('#menu').animate({"right":"0px"});
			
			
		
		}
	});


	$(document).ready(function(){
  $(".notf .notfy .count").click(function(){
    $(this).animate({left: '70px'});
  });

  $(".notf .notfy .count").dblclick(function(){
    $(this).animate({left: '0'});
  });
});

$(document).ready(function(){
 


  $('.kind .spec').on('click',function(){
			$(this).addClass('hav');

	});

 });


$(document).ready(function(){


    $('#demo-desktop').mobiscroll().calendar({
        display: 'bubble',
        touchUi: false
    });



});


$(function() {

$('.drop-box').click (function() {
  $('#ul')
    .fadeToggle();
});

$('.drop-box').on('click', function() {
  $(this).toggleClass('marked');
  $('.drop-text').toggleClass('marked1');
});

$(".drop-box").click(function(){
    $('.rotate').toggleClass("down"); 
});






});

