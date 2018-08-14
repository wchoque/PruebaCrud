/* Configuración */
window.addEventListener('load', function () {
  $( "#fechanacimiento" ).datepicker({
    dateFormat: "yy-mm-dd"
  });

  var app = new Vue({
    el: "#precios",
    ready: function() {
      this.load();
    },
    data: function() {
      return {
        update:{costo:0,estado:0,igv:0,icoterms:""},
        producto: {nombre:"",estado:0,costo:0,igv:0,incoterm:"",editar:0},
        productos:{},
        familias:{},
        familia:{},
        nuevo:0
      };
    },
    methods: {
      load: function() {
        this.obtenerProductos();
        this.$http.get(root + "/select-data-productos").then(
            function(_response) {
              this.familias = _response.data.data.familias;
            },
            function(response) {
              console.log(response);
            }
        ); 
      },
     

      obtenerProductos: function() {
        params = {};
        this.$http
            .post(root + "/obtener-productos", params)
            .then(function(_response) {
              this.productos = _response.data.data;
            });
      },

      ActualizarProductosMasivo: function(_evt) {
        params = {productos: this.productos, update:this.update}
        this.$http
            .post(root + "/actualizar-productos-masivo", params)
            .then(function(_response) {
              this.obtenerProductos();
              // this.producto={};
              // this.marca={};
              // this.nuevo=0;
              console.log(_response);
              // if(_response.data.status.code=='PROCESS_COMPLETE'){
              //     toastr.success("Registros actualizados", "Editar");
              //     app.obtenerProductos();
              //   }else{
              //     toastr.error("Registros no actualizados", "Editar");
              //   }
            });
        _evt.preventDefault();
      },


      obtenerProductosFiltradoFamilia: function() {
        params = { id_famili: this.familia.id_famili};
        // alert(this.familia.id_produc);
        this.$http
            .post(root + "/obtener-productos-filtrados-familia", params)
            .then(function(_response){
              this.productos = _response.data.data;
              console.log(_response);
            });
      },
    },

  

  });



});

