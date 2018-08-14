/* Configuración */
window.addEventListener('load', function () {
  $( "#fechanacimiento" ).datepicker({
    dateFormat: "yy-mm-dd"
  });


  var app = new Vue({
    el: "#familias",
    ready: function() {
      this.load();

    },
    data: function() {
      return {
        familias: {},
        familiasPadre: {},
        familia: {},
        nuevo:0,
        image:'',
        src:{}
      };
    },
    methods: {
      load: function() {
        this.obtenerFamilias();
        this.obtenerFamiliasPadre();
      },
      nuevaFamilia:function(){
        this.nuevo=1;
        this.familia={};
      },

      obtenerFamilias: function() {

        params = {};
        this.$http
            .post(root + "/obtener-familias", params)
            .then(function(_response) {
              this.familias = _response.data.data;
            });
      },
      obtenerFamiliasPadre: function() {

        params = {};
        this.$http
            .post(root + "/obtener-familias-padre", params)
            .then(function(_response) {
              this.familiasPadre = _response.data.data;
            });
      },
      obtenerFamilia: function(_perfil, _evt) {
        this.familia = _perfil;
        this.image= _perfil.foto;
        this.nuevo=1;
        console.log(this.perfil);

      },
      guardarFamilia: function(_evt) {
        var formData = new FormData();
        this.familia.foto=this.src;
        for ( var key in this.familia ) {
          formData.append(key, this.familia[key]);
        }
        this.$http
            .post(root + "/guardar-familia", formData)
            .then(function(_response) {
              this.obtenerFamilias();
              this.familia={};
              this.nuevo=0;
              console.log(_response);
            });
        _evt.preventDefault();
      },

      eliminarFamilia: function(_id) {
        params = { id_famili: _id};
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
              .post(root + "/eliminar-familia", params)
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
});

