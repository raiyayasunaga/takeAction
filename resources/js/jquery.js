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
