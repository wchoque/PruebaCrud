/* Configuración */
window.addEventListener('load', function () {

  Vue.http.options.root = "/public";
  var root = "/hifi/public";
  var app = new Vue({
    el: "#proveedores",
    ready: function() {
      this.load();

    },
    data: function() {
      return {
        image:'',
        src:{},
        tipo_documentos: {},
        paises: {},
        provincias: {},
        departamentos: {},
        distritos: {},
        correntista:{pais:null,departamento:null,provincia:null,distrito:null,
          telefono:'',email:null,codigo:'',movil:'',num_doc:'',razon_social:'',estado:0,direccion:'',nombres:'',
          apellidos:'',nombre_comercial:'',notas:'',extranjero:0,id_corren:0,ubigeo_id_ubigeo:0,tipdoc_id_tipdoc:0,transportista:null},
        correntistas: {},
        contactos: {},
        contacto: {},
        cuentas: {},
        cuenta: {},
        bancos: {},
        con: 0,
        ubi:1,
        nuevo:0
      };
    },
    methods: {
      load: function() {
        var params = {};
        this.$http.get(root + "/select-data").then(
            function(_response) {
              this.paises = _response.data.data.ubigeos;
              this.tipo_documentos = _response.data.data.tipo_documentos;
              this.todosProveedores();
              this.todosBancos();
            },
            function(response) {
              console.log(response);
            }
        );
      },
      nuevoProveedor:function(){
        this.correntista= {pais:null,departamento:null,provincia:null,distrito:null,
          telefono:'',email:null,codigo:'',movil:'',num_doc:'',razon_social:'',estado:0,direccion:'',nombres:'',
          apellidos:'',nombre_comercial:'',notas:'',extranjero:0,id_corren:0,ubigeo_id_ubigeo:0,tipdoc_id_tipdoc:0,transportista:null};
        this.con= 0;
        this.nuevo=1;
      },
      selectPais: function(){
        var pais=$("#pais").val();

        params = { ubigeo_id_ubigeo: pais };
        this.$http
            .post(root + "/departamento", params)
            .then(function(_response) {
              this.departamentos = _response.data.data;
              if(this.correntista.departamento!='' && !this.extranjero){

                setTimeout(function(){
                  $("#departamento").val( app.correntista.departamento).trigger('change');
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
              if(this.correntista.provincia!='' && !this.extranjero){
                setTimeout(function(){
                  $("#provincia").val( app.correntista.provincia).trigger('change');
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
              if(this.correntista.distrito!='' && !this.extranjero){
                setTimeout(function(){
                  $("#distrito").val( app.correntista.distrito).trigger('change');
                }, 500);

              }

              console.log(_response);
            });
      },
      todosProveedores: function() {
        params = {};
        this.$http.get(root + "/obtener-proveedores").then(function(_response) {
          this.correntistas = _response.data.data;
        });
      },
      guardarProveedor: function(_evt) {
        var distrito=$("#distrito").val();
        this.correntista.ubigeo_id_ubigeo=distrito;
        this.correntista.fecha_nacimiento= $('#fechanacimiento').datepicker("getDate");
        var formData = new FormData();
        this.correntista.foto=this.src;
        for ( var key in this.correntista ) {
          formData.append(key, this.correntista[key]);
        }




        this.$http
            .post(root + "/guardar-proveedor", formData)
            .then(function(_response) {
              console.log(_response);
              if(_response.data.status.code=='PROCESS_COMPLETE'){
                this.nuevo=0;
                this.con=0;
                this.src={};
                this.image='';
                this.correntista={pais:null,departamento:null,provincia:null,distrito:null,
                  telefono:'',email:null,codigo:'',movil:'',num_doc:'',razon_social:'',estado:0,direccion:'',nombres:'',
                  apellidos:'',nombre_comercial:'',notas:'',extranjero:0,id_corren:0,ubigeo_id_ubigeo:0,tipdoc_id_tipdoc:0,
                  transportista:null};
                this.todosProveedores();
                toastr.success("Registro Correcto", "Guardar");
              }else{
                toastr.error("Registro Incorrecto", "Guardar");
              }


            });
        _evt.preventDefault();
      },
      obtenerProveedor: function(_correntista, _evt) {
        params = {id_corren:_correntista};
        this.$http
            .post(root + "/obtener-proveedor", params)
            .then(function(_response) {
              if(_response.data.status.code=='PROCESS_COMPLETE'){

                this.correntista.telefono=_response.data.data.contacto_principal[0].telefono;
                this.correntista.email=_response.data.data.contacto_principal[0].email;
                this.correntista.codigo=_response.data.data.proveedor[0].codigo;
                this.correntista.movil=_response.data.data.contacto_principal[0].movil;

                this.correntista.num_doc=_response.data.data.num_doc;
                this.correntista.razon_social=_response.data.data.razon_social;
                this.correntista.estado=_response.data.data.estado;
                this.correntista.direccion=_response.data.data.direccion;
                this.correntista.nombres=_response.data.data.nombres;
                this.correntista.apellidos=_response.data.data.apellidos;
                this.correntista.nombre_comercial=_response.data.data.nombre_comercial;
                this.correntista.notas=_response.data.data.notas;
                this.correntista.extranjero=_response.data.data.extranjero;
                this.correntista.id_corren=params.id_corren;
                this.image= _response.data.data.foto;

                this.correntista.pais=_response.data.data.pais;
                this.correntista.provincia=_response.data.data.provincia;
                this.correntista.departamento=_response.data.data.departamento;
                this.correntista.distrito=_response.data.data.distrito;
                this.correntista.ubigeo_id_ubigeo=_response.data.data.ubigeo_id_ubigeo;
                this.correntista.tipdoc_id_tipdoc=_response.data.data.tipdoc_id_tipdoc;
                this.correntista.transportista=_response.data.data.transportista;
                $("#pais").val( this.correntista.pais).trigger('change');
                this.nuevo=1;
                this.con=1;
                console.log(_response);
              }

            });
      },

      obtenerContactos: function() {

        params = { id_corren: this.correntista.id_corren };
        this.$http
            .post(root + "/obtener-contactos", params)
            .then(function(_response) {
              this.contactos = _response.data.data;
            });
      },
      obtenerContacto: function(_perfil, _evt) {
        this.contacto = _perfil;
        this.contacto.corren_id_corren = this.correntista.id_corren;

        console.log(this.perfil);
        _evt.preventDefault();
      },
      guardarContacto: function(_evt) {
        this.contacto.corren_id_corren = this.correntista.id_corren;
        this.$http
            .post(root + "/guardar-contacto", this.contacto)
            .then(function(_response) {
              this.obtenerContactos();
              this.contacto={};
              console.log(_response);
            });
        _evt.preventDefault();
      },

      obtenerCuentas: function() {

        params = { id_corren: this.correntista.id_corren };
        this.$http
            .post(root + "/obtener-cuentas", params)
            .then(function(_response) {
              this.cuentas = _response.data.data;
            });
      },
      obtenerCuenta: function(_perfil, _evt) {
        this.cuenta = _perfil;
        this.cuenta.corren_id_corren = this.correntista.id_corren;

        console.log(this.perfil);
        _evt.preventDefault();
      },
      guardarCuenta: function(_evt) {
        this.cuenta.corren_id_corren = this.correntista.id_corren;
        this.$http
            .post(root + "/guardar-cuenta", this.cuenta)
            .then(function(_response) {
              this.obtenerCuentas();
              this.cuenta={};
              console.log(_response);
            });
        _evt.preventDefault();
      },
      todosBancos: function() {

        params = {  };
        this.$http
            .post(root + "/obtener-bancos", params)
            .then(function(_response) {
              this.bancos = _response.data.data;
            });
      },
      eliminarCuenta: function(_id) {
        params = { id_corcue: _id};
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
              .post(root + "/eliminar-cuenta", params)
              .then(function(_response) {
                if(_response.data.status.code=='PROCESS_COMPLETE'){
                  toastr.success("Registro Eliminado", "Eliminar");
                  app.obtenerCuentas();
                }else{
                  toastr.error("Registro no se pudo eliminar", "Eliminar");
                }

              });
          swal.close();
        });

      },
      eliminarContacto: function(_id) {
        params = { id_cordat: _id };
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
              .post(root + "/eliminar-contacto", params)
              .then(function(_response) {

                if(_response.data.status.code=='PROCESS_COMPLETE'){
                  toastr.success("Registro Eliminado", "Eliminar");
                  app.obtenerContactos();
                }else{
                  toastr.error("Registro no se pudo eliminar", "Eliminar");
                }

              });
          swal.close();
        });

      },
      eliminarCorrentista: function(_id) {
        params = { id_corren: _id};
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
              .post(root + "/eliminar-correntista", params)
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
   function onFileChange (input) {
    if (input.files && input.files[0])
    {
      var reader = new FileReader();
      reader.onload = function (e)
      {
        app.image=e.target.result;
        app.src=input.files[0];

      };
      var img = reader.readAsDataURL(input.files[0]);
    }
  }
  $("#fotoRead").change(function ()
  {
    onFileChange(this);

  });
  $("#pais").change(app.selectPais);
  $("#departamento").change(app.selectDepartamento);
  $("#provincia").change(app.selectProvincia);
});

