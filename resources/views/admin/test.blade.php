<!DOCTYPE html>
<html lang="">
    <head>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script> 
    <script src="odometer.js"></script>

    <style>
        .odometer {
          font-size: 40px;
        }
    </style>
    </head>
  <body>
    <div class="container">
      <h3>jqueryのdatepickerテスト画面</h3>
      <input type="text" id="date">
    </div>
  
  <h3>数字スロットマシーン</h3>
  <button type="button" id="spin">SPIN!!</button>

<div class='wrap'>

<table>
    <tbody>
      <tr>
        <td><span class="odometer slot1">9</span></td>
        <td><span class="odometer slot2">9</span></td>
        <td><span class="odometer slot3">9</span></td>
      </tr>
      <tr>
        <td><button type="button" id="stop1">STOP</button></td>
        <td><button type="button" id="stop2">STOP</button></td>
        <td><button type="button" id="stop3">STOP</button></td>
      </tr>
    </tbody>
  </table>

</div>
    <script>
    $(function(){
        $("#date").datepicker({
          dateFormat: 'yy年mm月dd日',
        });
    });
    var slotID1 = 0;
var slotID2 = 0;
var slotID3 = 0;

function loop_slot1() {
     $('.slot1').html(0);
     $('.slot1').text(9);
     slotID1 = setTimeout(loop_slot1, 1950);
 }

 function loop_slot2() {
     $('.slot2').html(0);
     $('.slot2').text(9);
     slotID2 = setTimeout(loop_slot2, 1950);
 }

 function loop_slot3() {
     $('.slot3').html(0);
     $('.slot3').text(9);
     slotID3 = setTimeout(loop_slot3, 1950);
 }

$('#spin').on('click', function() {
  loop_slot1();
  loop_slot2();
  loop_slot3();
});

$('#stop1').on('click', function() {
  clearTimeout(slotID1);
  var random = Math.floor(Math.random() * 10);
  $('.slot1').text(random);
  $('.slot1').html(random);
});

$('#stop2').on('click', function() {
  clearTimeout(slotID2);
  var random = Math.floor(Math.random() * 10);
  $('.slot2').text(random);
  $('.slot2').html(random);
});

$('#stop3').on('click', function() {
  clearTimeout(slotID3);
  var random = Math.floor(Math.random() * 10);
  $('.slot3').text(random);
  $('.slot3').html(random);
});
  </script>
  </body>
</html>