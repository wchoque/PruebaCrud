/* Configuración */
window.addEventListener('load', function () {
  $( "#fechanacimiento" ).datepicker({
    dateFormat: "yy-mm-dd"
  });
  Vue.http.options.root = "/public";

  var app = new Vue({
    el: "#tiendas",
    ready: function() {
      this.load();

    },
    data: function() {
      return {

        paises: {},
        provincias: {},
        departamentos: {},
        distritos: {},
        tienda:{pais:null,departamento:null,provincia:null,distrito:null,
          estado:0,direccion:'',nombre:'',id_tienda:0,ubigeo_id_ubigeo:0,almace_id_almace:0,emp:[]},
        tiendas: {},
        empleados: {},
        almacenes: {},
        con: 0,
        ubi:1,
        nuevo:0
      };
    },
    methods: {
      load: function() {
        this.allPaises();
        this.allEmpleados();
        this.obtenerAlmacenes();
        this.todosTiendas();
      },
      obtenerAlmacenes: function() {

        params = {};
        this.$http
            .post(root + "/obtener-almacenes", params)
            .then(function(_response) {
              this.almacenes = _response.data.data;
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
      allEmpleados:function(){
        this.$http.get(root + "/obtener-empleados").then(function(_response) {
          this.empleados = _response.data.data;
        });
      },
      nuevaTienda:function(){
        this.tienda= {pais:null,departamento:null,provincia:null,distrito:null,
          estado:0,direccion:'',nombre:'',id_tienda:0,ubigeo_id_ubigeo:0,almace_id_almace:0,emp:[]},
        this.nuevo=1;
      },
      selectPais: function(){
        var pais=$("#pais").val();

        params = { ubigeo_id_ubigeo: pais };
        this.$http
            .post(root + "/departamento", params)
            .then(function(_response) {
              this.departamentos = _response.data.data;
              if(this.tienda.departamento!='' && !this.extranjero){

                setTimeout(function(){
                  $("#departamento").val( app.tienda.departamento).trigger('change');
                }, 500);

              }


              console.log(_response);
            });
      },
      selectDepartamento: function(){
        var departamento=$("#departamento").val();

        params = { ubigeo_id_ubigeo: departamento };
        this.$http
            .post(root + "/provincia", params)
            .then(function(_response) {
              this.provincias = _response.data.data;
              if(this.tienda.provincia!='' && !this.extranjero){
                setTimeout(function(){
                  $("#provincia").val( app.tienda.provincia).trigger('change');
                }, 500);

              }

              console.log(_response);
            });
      },
      selectProvincia: function(){
        var provincia=$("#provincia").val();

        params = { ubigeo_id_ubigeo: provincia };
        this.$http
            .post(root + "/distrito", params)
            .then(function(_response) {
              this.distritos = _response.data.data;
              if(this.tienda.distrito!='' && !this.extranjero){
                setTimeout(function(){
                  $("#distrito").val( app.tienda.distrito).trigger('change');
                }, 500);

              }

              console.log(_response);
            });
      },
      todosTiendas: function() {
        params = {};
        this.$http.get(root + "/obtener-tiendas").then(function(_response) {
          this.tiendas = _response.data.data;
        });
      },
      guardarTienda: function(_evt) {
        var distrito=$("#distrito").val();
        this.tienda.ubigeo_id_ubigeo=distrito;
        this.$http
            .post(root + "/guardar-tienda", this.tienda)
            .then(function(_response) {
              console.log(_response);
              if(_response.data.status.code=='PROCESS_COMPLETE'){

                this.nuevo=0;
                this.tienda={pais:null,departamento:null,provincia:null,distrito:null,
                  estado:0,direccion:'',nombre:'',id_tienda:0,ubigeo_id_ubigeo:0,almace_id_almace:0,emp:[]},
                this.todosTiendas();
                toastr.success("Registro Correcto", "Guardar");
              }else{
                toastr.error("Registro Incorrecto", "Guardar");
              }


            });
        _evt.preventDefault();
      },
      obtenerTienda: function(_perfil, _evt) {
        this.almacen = _perfil;
        this.tienda.estado=_perfil.estado;
        this.tienda.direccion=_perfil.direccion;
        this.tienda.nombre=_perfil.nombre;
        this.tienda.emp=_perfil.emp;
        this.tienda.id_tienda=_perfil.id_tienda;
        this.tienda.pais=_perfil.pais;
        this.tienda.provincia=_perfil.provincia;
        this.tienda.departamento=_perfil.departamento;
        this.tienda.distrito=_perfil.distrito;
        this.tienda.almace_id_almace=_perfil.almace_id_almace;
        this.tienda.ubigeo_id_ubigeo=_perfil.ubigeo_id_ubigeo;
        $("#pais").val( this.tienda.pais).trigger('change');
        this.nuevo=1;
        console.log(_response);

      },



      eliminarTienda: function(_id) {
        params = { id_tienda: _id};
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
              .post(root + "/eliminar-tienda", params)
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
  $("#pais").change(app.selectPais);
  $("#departamento").change(app.selectDepartamento);
  $("#provincia").change(app.selectProvincia);

});

