AOS.init();

$(document).ready(function(){
    $('a.nav-link').click(function(){
      $('a.nav-link').removeClass("active");
      $(this).addClass("active"); 
      var sectionId = $(this).attr("href");
      $("html, body").animate({ scrollTop: $(sectionId).offset().top }, 500);
    });
});