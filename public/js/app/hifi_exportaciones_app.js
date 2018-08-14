/* Configuración */
window.addEventListener('load', function () {
  $( "#fechanacimiento" ).datepicker({
    dateFormat: "yy-mm-dd"
  });
  Vue.http.options.root = "/public";

  var app = new Vue({
    el: "#exportaciones",
    ready: function() {
      this.load();

    },
    data: function() {
      return {

        paises: {},
        // productos:[{modelo_oculto:'',modelo:'',descripcion:'',pais:'',checked:false,unidad:0,marca:'',qty:0,preciou:0.5,preciot:0},{modelo_oculto:'',modelo:'',descripcion:'',pais:'',checked:false,unidad:0,marca:'',qty:0,preciou:0.5,preciot:0}],
        productos:{modelo_oculto:'',modelo:'',descripcion:'',pais:'',checked:false,unidad:0,marca:'',qty:1,preciou:0.5,preciot:0,image:''},
        tiendas: {},
        empleados: {},
        almacenes: {},
        con: 0,
        ubi:1,
        nuevo:0,
        descarga:''
      };
    },
    methods: {
      load: function() {
        this.allPaises();
        this.obtenerProductos();
      },
      obtenerProductos: function() {

        params = {};
        this.$http
            .post(root + "/obtener-productos", params)
            .then(function(_response) {
              this.productos = _response.data.data;
              // this.productos.image = _response.data.data.foto;
            });
      },
      allPaises:function(){
        this.$http.post(root + "/paises").then(
            function(_response) {
              this.paises = _response.data.data;
            },
            function(response) {
              console.log(response);
            }
        );
      },


      descargarExcel: function(_evt) {
        var param = JSON.stringify(this.productos);
        this.$http
            .post(root + "/descargar-excel", param)
            .then(function(_response) {

              this.descarga=root+_response.data;
            });
        // _evt.preventDefault();
      }



    },
    watch: {
      ptotal: function (p) {
        this.productos.total = p.qty * p.total
      }
    }

  });


});

