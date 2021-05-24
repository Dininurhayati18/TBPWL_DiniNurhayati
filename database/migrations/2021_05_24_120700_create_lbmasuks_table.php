<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLbmasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lbmasuks', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->date('tanggal');
            $table->string('jumlah');
            $table->timestamps();

            
            $table->foreign('name')
            ->references('name')
            ->on('products')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lbmasuks');
    }
}
