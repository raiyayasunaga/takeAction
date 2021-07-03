<!DOCTYPE html>
<html lang="">
    <head>
    <script src="{{ asset('js/jquery.js') }}"></script>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script> 
    </head>
  <body>
    <div class="container">
      <h3>jqueryのdatepickerテスト画面</h3>
      <input type="text" id="date">
    </div>
    <script>
    $(function(){
        $("#date").datepicker({
          dateFormat: 'yy年mm月dd日',
        });
    });
  </script>
  </body>
</html>