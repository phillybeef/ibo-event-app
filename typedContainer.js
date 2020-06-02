$('document').ready(function(){

  var typed = new Typed('#typed', {
      stringsElement: '#typed-strings', 
      backSpeed: 60, 
      typeSpeed: 70,
      onComplete: function () {
          $(".typed-cursor").hide();
      }
  });

  $(".typed-cursor").css("font-size","xx-large"); 
  $(".typed-cursor").css("color","#375460"); 
  
}); 

// document.addEventListener("DOMContentLoaded", function() {
  // code…
// });