<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $value=0;//no se ha probado
           $table->integer('id_grupo');
			$table->string('grupo');
            $table->integer('ganados')->default($value);
			$table->integer('empatados')->default($value);
			$table->integer('perdidos')->default($value);
			$table->integer('puntaje')->default($value);
			$table->integer('golesfavor')->default($value);
			$table->integer('golescontra')->default($value);
			$table->string('content_type');
            $table->string('description');
			$table->integer('image_size');
			$table->string('jugados');
            $table->string('id_equipo');
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
        Schema::dropIfExists('grupos');
    }
}
