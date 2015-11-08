$(function(){
  $.material.init();

  $('#place-modal').on('shown.bs.modal', function () {
    google.maps.event.trigger(document.getElementById('map'), "resize");
  });
  
});
