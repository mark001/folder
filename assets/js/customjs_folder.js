jQuery(document).ready(function($) {
  $(".clickable-row").click(function() {
      window.document.location = $(this).data("href");
  });
});

setTimeout(function(){
  $('#alert').fadeOut();
}, 2000);