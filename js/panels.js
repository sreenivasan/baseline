jQuery(document).ready(function($){
  $('.panel')
    .hide()
    .eq(0)
    .show();
  $('.panel-nav a[href^=#]').on('click', function(e){
    var destPanelId = $(this).attr('href');
    var destPanelEl = $(destPanelId);
    if (destPanelEl){
      e.preventDefault();
      $('.panel-nav a[href^=#]').removeClass('active');
      $(this).addClass('active');
      $('.panel').hide();
      $( destPanelEl ).show();
    }


  });
});
