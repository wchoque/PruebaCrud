/* Configuración */
window.addEventListener('load', function () {
  $( "#fechanacimiento" ).datepicker({
    dateFormat: "yy-mm-dd"
  });

  var app = new Vue({
    el: "#productos",
    ready: function() {
      this.load();
    },
    data: function() {
      return {
        productos: {},
        image:'',
        producto: {id_produc:0,nombre:'',estado:0,codigo_hifi:'', codigo_importacion:'',icoterms:'', 
                  descripcion:'',stock_min:0,stock_max:0,precio:0,costo:0,igv:0,modelo:'',caracteristicas:'',
                  pagina_web:'', portada:''},
        marcas:{},
        marca:{},
        familias:{},
        familia:{},
        presentaciones:{},
        presentacion:{},
        unidades_medida:{},
        unidad_medida:{},
        divisas:{},
        proveedores:{},

        foto:{foto_nombre:'', foto_descripcion:'',foto_imagen:'',foto_tamaño:0,foto_producto_id:0},
        // multimediable_id:0,multimediable_type:0
        fotos:{},


        marcas_productos:{},
        marca_producto:{id_marpro:0,marcas_id_marcas:0,produc_id_produc:0},

        familias_productos:{},
        familia_producto:{id_fampro:0,famili_id_famili:0,produc_id_produc:0},

        productos_presentaciones:{},
        producto_presentacion:{id_propre:0,presen_id_presen:0,produc_id_produc:0},

        productos_unidades_medida:{},
        producto_unidad_medida:{id_prunme:0,unimed_id_unimed:0,produc_id_produc:0}, 
        src:{},
        nuevo:0
      };
    },
    methods: {
      load: function() {
        this.obtenerProductos();
        var params = {};
        this.$http.get(root + "/select-data-productos").then(
            function(_response) {
              this.marcas = _response.data.data.marcas;
              this.familias = _response.data.data.familias;
              this.presentaciones = _response.data.data.presentaciones;
              this.unidades_medida = _response.data.data.unidades_medida;
              this.divisas = _response.data.data.divisas;
              this.proveedores = _response.data.data.proveedores;
            },
            function(response) {
              console.log(response);
            }
        );
      },
      nuevoProducto:function(){
        this.producto = {};
        this.marca={};
        // this.marcas={};
        this.familia={};
        // this.familias={};
        this.presentacion={};
        // this.presentaciones={};
        this.unidad_medida={};
        // this.unidades_medida={};
        this.foto={};
        this.nuevo=1;
      },


      obtenerMarcasProductos: function() {
        params = { id_produc: this.producto.id_produc};
        this.$http
            .post(root + "/obtener-marcas-productos", params)
            .then(function(_response) {
              this.marcas_productos = _response.data.data;
            });
      },
      guardarMarcaProducto: function(_evt) {
        this.marca_producto.marcas_id_marcas = this.marca.id_marcas;
        this.marca_producto.produc_id_produc = this.producto.id_produc;
        this.$http
            .post(root + "/guardar-marca-producto", this.marca_producto)
            .then(function(_response) {
              alert("hay rpta");
              this.obtenerProductos();
              this.obtenerMarcasProductos();
              //this.producto={};
              console.log(_response);
            });
        _evt.preventDefault();
      },
      eliminarMarcaProducto: function(_id) {
        params = { id_marpro: _id};
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
              .post(root + "/eliminar-marca-producto", params)
              .then(function(_response) {
                if(_response.data.status.code=='PROCESS_COMPLETE'){
                  toastr.success("Registro Eliminado", "Eliminar");
                  app.obtenerMarcasProductos();
                  //app.obtenerProductos();
                }else{
                  toastr.error("Registro no se pudo eliminar", "Eliminar");
                }
              });
          swal.close();
        });
      },


     obtenerFamiliasProductos: function() {
        params = { id_produc: this.producto.id_produc};
        this.$http
            .post(root + "/obtener-familias-productos", params)
            .then(function(_response) {
              this.familias_productos = _response.data.data;
            });
      },
      guardarFamiliaProducto: function(_evt) {
        this.familia_producto.famili_id_famili = this.familia.id_famili;
        this.familia_producto.produc_id_produc = this.producto.id_produc;
        this.$http
            .post(root + "/guardar-familia-producto", this.familia_producto)
            .then(function(_response) {
              alert("hay rpta");
              this.obtenerProductos();
              this.obtenerFamiliasProductos();
              //this.producto={};
              console.log(_response);
            });
        _evt.preventDefault();
      },
      eliminarFamiliaProducto: function(_id) {
        params = { id_fampro: _id};
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
              .post(root + "/eliminar-familia-producto", params)
              .then(function(_response) {
                if(_response.data.status.code=='PROCESS_COMPLETE'){
                  toastr.success("Registro Eliminado", "Eliminar");
                  app.obtenerFamiliasProductos();
                  //app.obtenerProductos();
                }else{
                  toastr.error("Registro no se pudo eliminar", "Eliminar");
                }
              });
          swal.close();
        });
      },


      obtenerProductosPresentaciones: function() {
        params = { id_produc: this.producto.id_produc};
        this.$http
            .post(root + "/obtener-productos-presentaciones", params)
            .then(function(_response) {
              this.productos_presentaciones = _response.data.data;
            });
      },
      guardarProductoPresentacion: function(_evt) {
        this.producto_presentacion.presen_id_presen = this.presentacion.id_presen;
        this.producto_presentacion.produc_id_produc = this.producto.id_produc;
        this.$http
            .post(root + "/guardar-producto-presentacion", this.producto_presentacion)
            .then(function(_response) {
              alert("hay rpta");
              this.obtenerProductos();
              this.obtenerProductosPresentaciones();
              //this.producto={};
              console.log(_response);
            });
        _evt.preventDefault();
      },
      eliminarProductoPresentacion: function(_id) {
        params = { id_propre: _id};
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
              .post(root + "/eliminar-producto-presentacion", params)
              .then(function(_response) {
                if(_response.data.status.code=='PROCESS_COMPLETE'){
                  toastr.success("Registro Eliminado", "Eliminar");
                  app.obtenerProductosPresentaciones();
                  //app.obtenerProductos();
                }else{
                  toastr.error("Registro no se pudo eliminar", "Eliminar");
                }
              });
          swal.close();
        });
      },


      obtenerProductosUnidadesMedida: function() {
        params = { id_produc: this.producto.id_produc};
        this.$http
            .post(root + "/obtener-productos-unidades-medida", params)
            .then(function(_response) {
              this.productos_unidades_medida = _response.data.data;
            });
      },
      guardarProductoUnidadMedida: function(_evt) {
        this.producto_unidad_medida.unimed_id_unimed = this.unidad_medida.id_unimed;
        this.producto_unidad_medida.produc_id_produc = this.producto.id_produc;
        this.$http
            .post(root + "/guardar-producto-unidad-medida", this.producto_unidad_medida)
            .then(function(_response) {
              alert("hay rpta");
              this.obtenerProductos();
              this.obtenerProductosUnidadesMedida();
              //this.producto={};
              console.log(_response);
            });
        _evt.preventDefault();
      },
      eliminarProductoUnidadMedida: function(_id) {
        params = { id_prunme: _id};
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
              .post(root + "/eliminar-producto-unidad-medida", params)
              .then(function(_response) {
                if(_response.data.status.code=='PROCESS_COMPLETE'){
                  toastr.success("Registro Eliminado", "Eliminar");
                  app.obtenerProductosUnidadesMedida();
                  //app.obtenerProductos();
                }else{
                  toastr.error("Registro no se pudo eliminar", "Eliminar");
                }
              });
          swal.close();
        });
      },

         
      obtenerProductos: function() {
        params = {};
        this.$http
            .post(root + "/obtener-productos", params)
            .then(function(_response) {
              this.productos = _response.data.data;
            });
      },
      obtenerProducto: function(_perfil, _evt) {
        this.image= '/storage/'+_perfil.foto;
        this.producto= _perfil;
        this.nuevo=1;
        this.obtenerMarcasProductos();
        this.obtenerFamiliasProductos();
        this.obtenerProductosPresentaciones();
        this.obtenerProductosUnidadesMedida();
        console.log(this._perfil);
        _evt.preventDefault();
      },
      guardarProducto: function(_evt) {

        var formData = new FormData();
        this.producto.foto = this.src;
        for ( var key in this.producto ) {
          formData.append(key, this.producto[key]);
        }
        this.$http
            .post(root + "/guardar-producto", formData)
            .then(function(_response) {
              this.obtenerProductos();
              this.producto={};
              this.marca={};
              this.nuevo=0;
              console.log(_response);
              if(_response.data.status.code=='PROCESS_COMPLETE'){
                  toastr.success("Registro guardado", "Guardar");
                  app.obtenerProductos();
                }else{
                  toastr.error("Registro no guardado", "Guardar");
                }
            });
        _evt.preventDefault();
      },
      ejecutarMultiplicador: function(_evt) {
        alert("Multiplicador");
      },
      eliminarProducto: function(_id) {
        params = { id_produc: _id};
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
              .post(root + "/eliminar-producto", params)
              .then(function(_response) {
                if(_response.data.status.code=='PROCESS_COMPLETE'){
                    toastr.success("Registro Eliminado", "Eliminar");
                    app.obtenerProductos();
                }else{
                  toastr.error("Registro no se pudo eliminar", "Eliminar");
                }
              });
          swal.close();
        });
      },

      // guardarFotoPrincipal: function(_evt) {
      //   this.foto.foto_producto_id = this.producto.id_produc;
      //   this.$http
      //       .post(root + "/guardar-foto-principal", this.foto)
      //       .then(function(_response) {
      //         this.obtenerProductos();
      //         this.producto={};
      //         this.marca={};
      //         this.nuevo=0;
      //         console.log(_response);
      //         if(_response.data.status.code=='PROCESS_COMPLETE'){
      //             toastr.success("Foto principal añadida", "Guardar");
      //             app.obtenerProductos();
      //           }else{
      //             toastr.error("Foto principal no añadida", "Guardar");
      //           }
      //       });
      //   _evt.preventDefault();
      // },

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

