$(document).ready(function(){

//this function is used to position elements on the homepage
function sniffer() {
var windowHeight=$(window).height();
var introHeight=$(window).height()/5;
var sliderHeight=$(window).height();
var windowWidth=$(window).width()/2-140;
var windowWidth2=$(window).width();

var home=$("#home");
home.css("height",windowHeight+"px");

var intro=$("#intro");
intro.css("margin-top",introHeight+"px");

var logo=$("#logo");
logo.css("margin-left",windowWidth+"px");

var slide1=$("#slide1");
slide1.css("height",sliderHeight+"px");

var slide2=$("#slide2");
slide2.css("height",sliderHeight+"px");

var slide1=$("#slide1");
slide1.css("max-width",windowWidth2+"px");

var slide2=$("#slide2");
slide2.css("max-width",windowWidth2+"px");

}
sniffer();







//flexslider on the homepage
$('#intro-slider').flexslider({
  directionNav: false,
  controlNav: false,
  keyboardNav: false,
});  


//flexsliders for the works section - here you need to add/remove slider id when adding/removing portfolio position
$('#work1-slider, #work2-slider, #work3-slider, #work4-slider ').flexslider({
  directionNav: false,
  controlNav: true,
  keyboardNav: false,
  slideshow: false,
});

//scrollspy function used to navigate on the page with easing
$(function() {
  $('ul.nav a, .more a, #brand' ).bind('click',function(event){
  var $anchor = $(this);

  $('[data-spy="scroll"]').each(function () {
    var $spy = $(this).scrollspy('refresh')
  });



  $('html, body').stop().animate({
    scrollTop: $($anchor.attr('href')).offset().top
  }, 1000,'easeInOutExpo');

  event.preventDefault();
});

});



//fancybox settings
$("a.fancybox").fancybox({
  overlayColor:'#7ca5b7',
  overlayOpacity: 0.2,
});

//contact form
var options = {target: "#alert"};
$("#contact-form").ajaxForm(options);

//on window resize event
$(window).resize(function(){

  sniffer();

});

});