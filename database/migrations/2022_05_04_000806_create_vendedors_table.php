<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('vendedor', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('teste_id');
        $table->string('nome', 30);
        $table->string('imagem', 100);
        $table->integer('numero_portas');
        $table->integer('lugares');
        $table->boolean('air_bag');
        $table->boolean('abs');
        $table->timestamps();

        //foreign key (constraints)
        $table->foreign('teste_id')->references('id')->on('teste');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendedors');
    }
}
