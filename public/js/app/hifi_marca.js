/* Configuración */
window.addEventListener('load', function () {
  $( "#fechanacimiento" ).datepicker({
    dateFormat: "yy-mm-dd"
  });


  var app = new Vue({
    el: "#marcas",
    ready: function() {
      this.load();

    },
    data: function() {
      return {
        marcas: {},
        marca: {},
        nuevo:0
      };
    },
    methods: {
      load: function() {
        this.obtenerMarcas();
      },
      nuevaMarca:function(){
        this.nuevo=1;
      },

      obtenerMarcas: function() {

        params = {};
        this.$http
            .post(root + "/obtener-marcas", params)
            .then(function(_response) {
              this.marcas = _response.data.data;
            });
      },
      obtenerMarca: function(_perfil, _evt) {
        this.marca = _perfil;
        this.nuevo=1;
        console.log(this.perfil);
        _evt.preventDefault();
      },
      guardarMarca: function(_evt) {
        this.$http
            .post(root + "/guardar-marca", this.marca)
            .then(function(_response) {
              this.obtenerMarcas();
              this.marca={};
              this.nuevo=0;
              console.log(_response);
            });
        _evt.preventDefault();
      },
      eliminarMarca: function(_id) {
        params = { id_marcas: _id};
        swal({
          title: "¿Estas seguro?",
          text: "",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        }, function () {

          app.$http
              .post(root + "/eliminar-marca", params)
              .then(function(_response) {

                if(_response.data.status.code=='PROCESS_COMPLETE'){
                  toastr.success("Registro Eliminado", "Eliminar");
                  app.todosClientes();
                }else{
                  toastr.error("Registro no se pudo eliminar", "Eliminar");
                }

              });
          swal.close();
        });

      }

    }

  });

});

