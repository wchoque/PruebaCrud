/* Configuración */
window.addEventListener('load', function () {
  $( "#fechanacimiento" ).datepicker({
    dateFormat: "yy-mm-dd"
  });
  Vue.http.options.root = "/public";

  var app = new Vue({
    el: "#ventas",
    ready: function() {
      this.load();

    },
    data: function() {
      return {

        descarga:''
      };
    },
    methods: {
      load: function() {
        this.allPaises();
        this.obtenerProductos();
      },
      obtenerProductos: function() {

        /*  params = {};
         this.$http
         .post(root + "/obtener-almacenes", params)
         .then(function(_response) {
         this.almacenes = _response.data.data;
         });*/
      },
      allPaises:function(){
        // this.$http.post(root + "/paises").then(
            // function(_response) {
              // this.paises = _response.data.data;
            // },
            // function(response) {
              // console.log(response);
            // }
        // );
      },


      descargarExcel: function(_evt) {
       
        this.$http
            .post(root + "/process-documentos")
            .then(function(_response) {

              this.descarga=_response.data;
            });
        
      }






    },
    watch: {
      ptotal: function (p) {
        this.productos.total = p.qty * p.total
      }
    }

  });


});


