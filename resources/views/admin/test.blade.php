<!DOCTYPE html>
<html lang="">
  <head>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script> 
    <script src="odometer.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-notification-bell@0.8.14/dist/NotificationBell.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>


    <style>
  
    </style>
  </head>
  <body>
  <h1>再クリックでポップアップ表示を解除</h1>
<div class="gallery"><img src="/img/chihiro042.jpg" width="300"></div>
<div id="largeImg" style="display: none;"><img width="800" src="/img/chihiro042.jpg"></div>
<script type="text/javascript">
$('.gallery img').click(function(e) {
    $('#back-curtain')
        .css({
            'width' : $(window).width(),    // ウィンドウ幅
            'height': $(window).height()    // 同 高さ
        })
        .show();
    $('#largeImg')
        .css({
            'display': 'block',
            'position': 'absolute',
            'left'    : Math.floor(($(window).width() - 800) / 2) + 'px',
            'top'     : $(window).scrollTop() + 30 + 'px'
        })
        .fadeIn();
});

$('#back-curtain, #largeImg').click(function() {
    $('#largeImg').fadeOut('slow', function() {$('#back-curtain').hide();});
});
</script>
  </body>
</html>