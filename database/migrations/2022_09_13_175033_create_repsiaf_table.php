<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repsiaf', function (Blueprint $table) {
            $table->id();
            $table->integer('cod_programa');
            $table->string('nom_programa',255);
            $table->string('programa',255);
            $table->integer('cod_meta');
            $table->string('nom_meta',255);
            $table->string('meta',255);
            $table->integer('cod_generica');
            $table->string('nom_generica',255);
            $table->string('generica',255);
            $table->string('especifica',255);
            $table->integer('cod_fuente');
            $table->string('nom_fuente',255);
            $table->string('fuente',255);
            $table->decimal('pia',10,2);
            $table->decimal('pim',10,2);
            $table->decimal('modificacion',10,2);
            $table->decimal('certificado',10,2);
            $table->decimal('comp_anual',10,2);
            $table->decimal('comp_mensual',10,2);
            $table->decimal('devengado',10,2);
            $table->decimal('girado',10,2);
            $table->decimal('pagado',10,2);
            $table->integer('meta_anual');
            $table->integer('avance_anual');
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
        Schema::dropIfExists('repsiaf');
    }
};
