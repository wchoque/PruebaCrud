<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('correntista_datos', function (Blueprint $table) {
            $table->increments('id_cordat');
            $table->string('email',80)->unique();
            $table->string('pref_pais',5)->nullable();
            $table->string('pref_ciudad',5)->nullable();
            $table->string('ubicacion',120)->nullable();
            $table->string('telefono',12);
            $table->string('movil',12);
            $table->string('pagina_web',160)->nullable();
            $table->string('contacto',160)->nullable();
            $table->boolean('principal')->default(false);
            $table->integer('corren_id_corren')->unsigned()->nullable();
            $table->foreign('corren_id_corren')->references('id_corren')->on('correntistas')->onDelete('cascade');
            $table->string('creado_por',35)->nullable();
            $table->string('modificado_por',35)->nullable();
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
        Schema::dropIfExists('correntista_datos');
    }
}
