/* Configuración */
window.addEventListener('load', function () {
  $( "#fechanacimiento" ).datepicker({
    dateFormat: "yy-mm-dd"
  });
  Vue.http.options.root = "/public";

  var app = new Vue({
    el: "#importaciones",
    ready: function() {


    },
    data: function() {
      return {
        src:''
      };
    },
    methods: {



      subirExcel: function(_evt) {
        var param =JSON.stringify(this.productos);
        var formData = new FormData();
        formData.append('excel', this.src);
        this.$http
            .post(root + "/subir-excel", formData)
            .then(function(_response) {


            });
        _evt.preventDefault();
      }






    }

  });

  function onFileChange (input) {
    if (input.files && input.files[0])
    {
      app.src=input.files[0];
      var reader = new FileReader();
      reader.onload = function (e)
      {
        //app.image=e.target.result;


      };
      //var img = reader.readAsDataURL(input.files[0]);
    }
  }
  $("#excelRead").change(function ()
  {
    onFileChange(this);

  });
});

