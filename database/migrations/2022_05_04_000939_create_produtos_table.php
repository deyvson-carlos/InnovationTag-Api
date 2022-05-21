<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('produtos', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('vendedor_id');
        $table->string('placa', 10)->unique();
        $table->boolean('disponivel');
        $table->integer('km');
        $table->timestamps();

        //foreign key (constraints)
        $table->foreign('vendedor_id')->references('id')->on('vendedor');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
