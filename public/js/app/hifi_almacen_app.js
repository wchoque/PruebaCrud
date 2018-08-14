/* Configuración */
window.addEventListener('load', function () {
  $( "#fechanacimiento" ).datepicker({
    dateFormat: "yy-mm-dd"
  });


  var app = new Vue({
    el: "#almacenes",
    ready: function() {
      this.load();

    },
    data: function() {
      return {
        almacenes: {},
        dalmacenes: {},
        oalmacenes: {},
        almacenesPadre: {},
        almacen: {},
        nuevo:0,
        con:0,
        estantes:{},
        oestantes:{},
        destantes:{},
        estante:{},
        dcasilleros:{},
        ocasilleros:{},
        dalmacen_id:0,
        destante_id:0,
        oestante_id:0,
        ocasillero_id:0,
        dcasillero_id:0

      };
    },
    methods: {
      load: function() {
        this.obtenerAlmacenes();
        this.obtenerAlmacenesPadre();
      },
      nuevoAlmacen:function(){
        this.nuevo=1;
        this.familia={};
      },

      obtenerAlmacenes: function() {

        params = {};
        this.$http
            .post(root + "/obtener-almacenes", params)
            .then(function(_response) {
              this.almacenes = _response.data.data;
              this.oalmacenes = _response.data.data;
              this.dalmacenes = _response.data.data;
            });
      },
      obtenerAlmacenesPadre: function() {

        params = {};
        this.$http
            .post(root + "/obtener-almacenes-padre", params)
            .then(function(_response) {
              this.almacenesPadre = _response.data.data;
            });
      },
      obtenerAlmacen: function(_perfil, _evt) {
        this.almacen = _perfil;
        this.almacen.numero_estantes=0;
        this.nuevo=1;
        console.log(this.perfil);

      },
      guardarAlmacen: function(_evt) {
        var formData = new FormData();
        for ( var key in this.almacen ) {
          formData.append(key, this.almacen[key]);
        }
        this.$http
            .post(root + "/guardar-almacen", formData)
            .then(function(_response) {
              if(_response.data.status.code=='PROCESS_COMPLETE'){
                this.obtenerAlmacenes();
                this.almacen={};
                this.nuevo=0;
                console.log(_response);
                toastr.success("Registro guardado", "Guardar");

              }else{
                toastr.error("Registro no se pudo guardar", "Guardar");
              }

            });
        _evt.preventDefault();
      },

      eliminarAlmacen: function(_id) {
        params = { id_almace: _id};
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
              .post(root + "/eliminar-almacen", params)
              .then(function(_response) {

                if(_response.data.status.code=='PROCESS_COMPLETE'){
                  toastr.success("Registro Eliminado", "Eliminar");
                  app.obtenerAlmacenes();
                }else{
                  toastr.error("Registro no se pudo eliminar", "Eliminar");
                }

              });
          swal.close();
        });

      },
      obtenerEstantes: function() {

        params = {id_almace:this.almacen.id_almace};
        this.$http
            .post(root + "/obtener-estantes", params)
            .then(function(_response) {
              this.estantes = _response.data.data;
            });
      },
      obtenerEstante: function(_perfil, _evt) {
        this.estante = _perfil;
        console.log(this.perfil);
      },
      guardarEstante: function(_evt) {

        this.$http
            .post(root + "/guardar-estante", this.estante )
            .then(function(_response) {
              if(_response.data.status.code=='PROCESS_COMPLETE'){
                this.obtenerEstantes();
                this.estante={};
                console.log(_response);
                toastr.success("Registro guardado", "Guardar");

              }else{
                toastr.error("Registro no se pudo guardar", "Guardar");
              }

            });
        _evt.preventDefault();
      },
      eliminarEstante: function(_id) {
        params = { id_estant: _id};
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
              .post(root + "/eliminar-estante", params)
              .then(function(_response) {

                if(_response.data.status.code=='PROCESS_COMPLETE'){
                  toastr.success("Registro Eliminado", "Eliminar");
                  app.obtenerEstantes();
                }else{
                  toastr.error("Registro no se pudo eliminar", "Eliminar");
                }

              });
          swal.close();
        });

      },
      obtenerTodosEstantes: function(_evt) {

        this.$http
            .get(root + "/obtener-todo-estantes")
            .then(function(_response) {
              this.destantes = _response.data.data;
              this.oestantes = _response.data.data;
            });
      },
      obtenerCasilleros: function( _evt) {

        this.$http
            .get(root + "/obtener-casilleros")
            .then(function(_response) {
              this.dcasilleros = _response.data.data;
              this.ocasilleros = _response.data.data;
            });
      },
      obtenerFiltros: function() {
        this.obtenerCasilleros();
        this.obtenerTodosEstantes();
      },
      filtrarProductos:function(){
        var params = { id_casillero: this.ocasillero_id};
        this.$http
            .post(root + "/filtrar-productos", params )//pendiente sin crear
            .then(function(_response) {
              if(_response.data.status.code=='PROCESS_COMPLETE'){
                toastr.success("Registro guardado", "Guardar");

              }else{
                toastr.error("Registro no se pudo guardar", "Guardar");
              }

            });
        _evt.preventDefault();
      },
      trasladarStock:function(){
        var params = { id_casillero: this.ocasillero_id};
        this.$http
            .post(root + "/trasladar-productos", params )//pendiente sin crear
            .then(function(_response) {
              if(_response.data.status.code=='PROCESS_COMPLETE'){
                toastr.success("Registro guardado", "Guardar");

              }else{
                toastr.error("Registro no se pudo guardar", "Guardar");
              }

            });
        _evt.preventDefault();
      }
    }


  });
});

