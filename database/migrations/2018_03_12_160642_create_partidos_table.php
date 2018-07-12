<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidos', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('id_grupo');
			$table->integer('id_equipo1');
			$table->integer('id_equipo2');
			$table->integer('goles1');
			$table->integer('goles2');
			$table->string('resultado');
			$table->string('hora');
			$table->date('fecha');
			$table->string('ciudad');
			$table->string('stadium');
			$table->string('fase');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partidos');
    }
}
