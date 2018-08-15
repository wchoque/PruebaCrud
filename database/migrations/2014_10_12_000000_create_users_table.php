<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_correntistas', function (Blueprint $table) {
            $table->increments('id_tipcor');
            $table->string('descripcion',50);
            $table->string('creado_por',35)->nullable();
            $table->string('modificado_por',35)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('tipo_documentos', function (Blueprint $table) {
            $table->increments('id_tipdoc');
            $table->string('codigo_tipdoc',5);
            $table->string('descripcion',50);
            $table->string('creado_por',35)->nullable();
            $table->string('modificado_por',35)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('ubigeos', function (Blueprint $table) {
            $table->increments('id_ubigeo');
            $table->integer('ubigeo_id_ubigeo');
            $table->string('nombre',200);
            $table->string('nombre_corto',20);
            $table->string('descripcion',200);
            $table->tinyInteger('tipo');
            $table->string('creado_por',35)->nullable();
            $table->string('modificado_por',35)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('correntistas', function (Blueprint $table) {
            $table->increments('id_corren');
            $table->integer('ubigeo_id_ubigeo')->unsigned()->nullable();
            $table->foreign('ubigeo_id_ubigeo')->references('id_ubigeo')->on('ubigeos')->onDelete('cascade');
            $table->integer('tipdoc_id_tipdoc')->unsigned()->nullable();
            $table->foreign('tipdoc_id_tipdoc')->references('id_tipdoc')->on('tipo_documentos')->onDelete('cascade');
            $table->string('num_doc',13);
            $table->string('apellidos',150)->nullable();
            $table->string('nombres',150)->nullable();
            $table->string('razon_social',150);
            $table->string('nombre_comercial',150)->nullable();
            //$table->string('correntista_cargo',150)->nullable();
            $table->string('codigo_qr',150)->nullable();
            $table->boolean('estado');
            $table->boolean('distribuidor')->nullable();
            $table->boolean('transportista')->nullable();
            $table->string('direccion',150)->nullable();
            $table->boolean('extranjero');
            $table->string('nombre_conviviente',150)->nullable();
            $table->char('genero',1)->nullable();
            $table->char('estado_civil',2)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->tinyInteger('numero_hijos')->nullable();
            $table->string('foto')->nullable();
            $table->string('notas',150)->nullable();
            //empleados
            $table->string('cargo',70)->nullable();
            $table->date('fecha_contratacion')->nullable();
            $table->date('fecha_cese')->nullable();
            $table->integer('nivel_organizacion')->nullable();
            $table->date('fecha_vacaciones_inicio')->nullable();
            $table->date('fecha_vacaciones_fin')->nullable();
            $table->decimal('sueldo',8,2)->nullable();
            $table->string('contacto_emergencia',50)->nullable();
            $table->string('numero_seguro',13)->nullable();
            $table->string('doc_curriculum')->nullable();
            $table->string('doc_contrato')->nullable();
            $table->string('creado_por',35)->nullable();
            $table->string('modificado_por',35)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::create('maestro_correntista', function (Blueprint $table) {
            $table->increments('id_maecor');
            $table->string('codigo',100);
            $table->integer('padre_correntista')->unsigned()->nullable();
            $table->integer('corren_id_corren')->unsigned()->nullable();
            $table->foreign('corren_id_corren')->references('id_corren')->on('correntistas')->onDelete('cascade');
            $table->integer('tipcor_id_tipcor')->unsigned()->nullable();
            $table->foreign('tipcor_id_tipcor')->references('id_tipcor')->on('tipos_correntistas')->onDelete('cascade');
            $table->string('creado_por',35)->nullable();
            $table->string('modificado_por',35)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('corren_id_corren')->unsigned()->nullable();
            $table->foreign('corren_id_corren')->references('id_corren')->on('correntistas')->onDelete('cascade');
            $table->string('name');
            $table->string('creado_por',35)->nullable();
            $table->string('modificado_por',35)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
