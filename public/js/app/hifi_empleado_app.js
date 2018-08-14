/* Configuración */
window.addEventListener('load', function () {

  Vue.http.options.root = "/public";
  var app = new Vue({
    el: "#empleados",
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
          apellidos:'',nombre_comercial:'',notas:'',extranjero:0,id_corren:0,ubigeo_id_ubigeo:0,tipdoc_id_tipdoc:0,cargo:0,fecha_nacimiento:'',estado_civil:'',genero:'',
          doc_curriculum:'',doc_contrato:'',fecha_contratacion:'',fecha_cese:'',numero_hijos:0,nombre_conviviente:'',sueldo:0,fecha_vacaciones_inicio:'',fecha_vacaciones_fin:'',
          contacto_emergencia:'',numero_seguro:''},
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
              this.todosEmpleados();
              this.todosBancos();
            },
            function(response) {
              console.log(response);
            }
        );
      },
      nuevoEmpleado:function(){
        this.correntista= {pais:null,departamento:null,provincia:null,distrito:null,
          telefono:'',email:null,codigo:'',movil:'',num_doc:'',razon_social:'',estado:0,direccion:'',nombres:'',
          apellidos:'',nombre_comercial:'',notas:'',extranjero:0,id_corren:0,ubigeo_id_ubigeo:0,tipdoc_id_tipdoc:0,cargo:0,fecha_nacimiento:'',estado_civil:'',genero:'',
          doc_curriculum:'',doc_contrato:'',fecha_contratacion:'',fecha_cese:'',numero_hijos:0,nombre_conviviente:'',sueldo:0,fecha_vacaciones_inicio:'',fecha_vacaciones_fin:'',
          contacto_emergencia:'',numero_seguro:''};
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
      todosEmpleados: function() {
        params = {};
        this.$http.get(root + "/obtener-empleados").then(function(_response) {
          this.correntistas = _response.data.data;
        });
      },
      guardarEmpleado: function(_evt) {
        var distrito=$("#distrito").val();
        this.correntista.ubigeo_id_ubigeo=distrito;
        this.correntista.fecha_nacimiento= $('#fechanacimiento').datepicker("getDate");
        this.correntista.fecha_contratacion= $('#fechacontratacion').datepicker("getDate");
        this.correntista.fecha_cese= $('#fechacese').datepicker("getDate");
        this.correntista.fecha_vacaciones_inicio= $('#fechavacinicio').datepicker("getDate");
        this.correntista.fecha_vacaciones_fin= $('#fechavacfin').datepicker("getDate");

        var formData = new FormData();
        this.correntista.foto=this.src;
        this.correntista.doc_curriculum=this.srccv;
        this.correntista.doc_contrato=this.srccon;
        for ( var key in this.correntista ) {
          formData.append(key, this.correntista[key]);
        }




        this.$http
            .post(root + "/guardar-empleado", formData)
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
                  cargo:0,fecha_nacimiento:'',estado_civil:'',genero:'',
                    doc_curriculum:'',doc_contrato:'',fecha_contratacion:'',fecha_cese:'',numero_hijos:0,nombre_conviviente:'',sueldo:0,fecha_vacaciones_inicio:'',fecha_vacaciones_fin:'',
                    contacto_emergencia:'',numero_seguro:''};
                this.todosEmpleados();
                toastr.success("Registro Correcto", "Guardar");
              }else{
                toastr.error("Registro Incorrecto", "Guardar");
              }

            });
        _evt.preventDefault();
      },
      obtenerEmpleado: function(_correntista, _evt) {
        params = {id_corren:_correntista};
        this.$http
            .post(root + "/obtener-empleado", params)
            .then(function(_response) {
              if(_response.data.status.code=='PROCESS_COMPLETE'){

                this.correntista.telefono=_response.data.data.contacto_principal[0].telefono;
                this.correntista.email=_response.data.data.contacto_principal[0].email;
                this.correntista.codigo=_response.data.data.empleado[0].codigo;
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
                this.correntista.cargo=_response.data.data.cargo;
                this.correntista.fecha_nacimiento=_response.data.data.fecha_nacimiento;
                this.correntista.genero=_response.data.data.genero;
                this.correntista.estado_civil=_response.data.data.estado_civil;
                this.correntista.sueldo=_response.data.data.sueldo;
                this.correntista.numero_seguro=_response.data.data.numero_seguro;
                this.correntista.contacto_emergencia=_response.data.data.contacto_emergencia;
                this.correntista.nombre_conviviente=_response.data.data.nombre_conviviente;
                this.correntista.numero_hijos=_response.data.data.numero_hijos;
                $('#fechanacimiento').datepicker('setDate',_response.data.data.fecha_nacimiento);
                $('#fechacontratacion').datepicker('setDate',_response.data.data.fecha_contratacion);
                $('#fechacese').datepicker('setDate',_response.data.data.fecha_cese);
                $('#fechavacinicio').datepicker('setDate',_response.data.data.fecha_vacaciones_inicio);
                $('#fechavacfin').datepicker('setDate',_response.data.data.fecha_vacaciones_fin);
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
   function onFotoChange (input) {
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
  function onCvChange (input) {
    if (input.files && input.files[0])
    {
      var reader = new FileReader();
      reader.onload = function (e)
      {

        app.srccv=input.files[0];

      };
      var img = reader.readAsDataURL(input.files[0]);
    }
  }
  function onConChange (input) {
    if (input.files && input.files[0])
    {
      var reader = new FileReader();
      reader.onload = function (e)
      {
        app.srccon=input.files[0];

      };
      var img = reader.readAsDataURL(input.files[0]);
    }
  }
  $("#fotoRead").change(function ()
  {
    onFotoChange(this);

  });
  $("#cvRead").change(function ()
  {
    onCvChange(this);

  });
  $("#conRead").change(function ()
  {
    onConChange(this);

  });
  $("#pais").change(app.selectPais);
  $("#departamento").change(app.selectDepartamento);
  $("#provincia").change(app.selectProvincia);
});

