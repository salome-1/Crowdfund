<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('price');
            $table->integer('project_id')->unsigned();
            $table->string('project_name');
            $table->string('project_slug', 120);
            $table->smallInteger('status')->default(0); // 0. belum dibeli, 1. dibeli , 2. belum_diambil, 3. diambil
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('user_name')->nullable();
            $table->timestamps();
            
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slots');
    }
}
