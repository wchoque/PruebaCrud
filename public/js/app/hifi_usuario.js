/* Configuración */
window.addEventListener('load', function () {
  $( "#fechanacimiento" ).datepicker({
    dateFormat: "yy-mm-dd"
  });


  var app = new Vue({
    el: "#usuarios",
    ready: function() {
      this.load();

    },
    data: function() {
      return {
        usuarios: {},
        usuario: {nombre:'',password:'',rol:0,email:''},
        roles: {},
        nuevo:0
      };
    },
    methods: {
      load: function() {
        this.obtenerUsuarios();
        this.obtenerRoles();
      },
      nuevoUsuario:function(){
		  this.usuario={};
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
      obtenerUsuarios: function() {

        params = {};
        this.$http
            .post(root + "/obtener-usuarios", params)
            .then(function(_response) {
              this.usuarios = _response.data.data;
            });
      },
      obtenerUsuario: function(_perfil, _evt) {
        this.usuario = _perfil;
        this.nuevo=1;
        console.log(this.perfil);
        _evt.preventDefault();
      },
      guardarUsuario: function(_evt) {
        this.$http
            .post(root + "/guardar-usuario", this.usuario)
            .then(function(_response) {              
              console.log(_response);
			  if(_response.data.status.code=='PROCESS_COMPLETE'){

                this.nuevo=0;
                this.usuario={};
                this.obtenerUsuarios();
                toastr.success("Registro Correcto", "Guardar");
              }else{
                toastr.error("Registro Incorrecto", "Guardar");
              }
            });
        _evt.preventDefault();
      },
      eliminarUsuario: function(_id) {
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
              .post(root + "/eliminar-usuario", params)
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

