$(function () {
  $('.hamburgar').click(function () {
    $(this).toggleClass('active');

    if ($(this).hasClass('active')) {
        $('.navMenu').addClass('active');
        $('.navMenu').fadeIn(500);
    } else {
        $('.navMenu').removeClass('active');
        $('.navMenu').fadeOut(500);
    }
  });

  $('.navmenu-a').click(function () {
    $('.navMenu').removeClass('active');
    $('.navMenu').fadeOut(1000);
    $('.hamburgar').removeClass('active');
  });
  
});

$('.display_normal img').click(function(e) {
  $('#back-curtain')
      .css({
          'width' : $(window).width(),    // ウィンドウ幅
          'height': $(window).height()    // 同 高さ
      })
      .show();
  $('#display_show')
      .css({
          'display': 'block',
          'position': 'absolute',
          'left'    : Math.floor(($(window).width() - 400) / 2) + 'px',
          'top'     : $(window).scrollTop() + 100 + 'px'
      })
      .fadeIn();
});

$('#back-curtain, #display_show').click(function() {
  $('#display_show').fadeOut('slow', function() {$('#back-curtain').hide();});
});

