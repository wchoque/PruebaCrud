/* Configuración */
window.addEventListener('load', function () {
  $( "#fechanacimiento" ).datepicker({
    dateFormat: "yy-mm-dd"
  });


  var app = new Vue({
    el: "#roles",
    ready: function() {
      this.load();

    },
    data: function() {
      return {
        roles: {},
        rol: {},
        nuevo:0
      };
    },
    methods: {
      load: function() {
        this.obtenerRoles();
      },
      nuevoRol:function(){
        this.nuevo=1;
      },

     obtenerRoles: function() {

        params = {};
        this.$http
            .post(root + "/obtener-roles", params)
            .then(function(_response) {
              this.roles = _response.data.data;
            });
      },
      obtenerRol: function(_perfil, _evt) {
        this.rol = _perfil;
        this.nuevo=1;
        console.log(this.perfil);
        _evt.preventDefault();
      },
       guardarRol: function(_evt) {
        this.$http
            .post(root + "/guardar-rol", this.rol)
            .then(function(_response) {
              this.obtenerRoles();
              this.rol={};
              this.nuevo=0;
              console.log(_response);
            });
        _evt.preventDefault();
      },
      eliminarRol: function(_id) {
        params = { id: _id};
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
              .post(root + "/eliminar-rol", params)
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

