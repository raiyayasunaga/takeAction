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
       body {
          background: #20262E;
          padding: 20px;
          font-family: Helvetica;
        }

        #app {
          background: #fff;
          border-radius: 4px;
          padding: 20px;
          transition: all 0.2s;
        }

        li {
          margin: 8px 0;
        }

        h2 {
          font-weight: bold;
          margin-bottom: 15px;
        }

        del {
          color: rgba(0, 0, 0, 0.3);
        }
    </style>
  </head>
  <body>
    <div id="app">
      <notification-bell
        :size="100"
        :count="list.length"
        upper-limit="50"
        counter-location="upperRight"
        counter-style="roundRectangle"
        counter-background-color="#FF0000"
        counter-text-color="#FFFFFF"
        icon-color="#000000"
        font-size="25px"
        :animated="true"
      ></notification-bell>
      <ul class="list-group">
        <li class="list-group-item" v-for="(item, index) in list" :key="index"> <button class="btn btn-danger" type="button" @click="deleteItem(index)">削除する</button></li>
      </ul>
    </div>

    <script>
      const NotificationBell = window['NotificationBell'].default;
      new Vue({ 
        el: '#app',
        components: {
          'notification-bell':NotificationBell 
        },
        data: {
          list: [
            {no:1},
            {no:2},
            {no:3},
            {no:4},
            {no:5},
          ]
        },
        methods: {
          deleteItem: function(index){
            this.list.splice(index, 1);
          }
        }
      });
      
    </script>
  </body>
</html>