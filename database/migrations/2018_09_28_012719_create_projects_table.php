<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug', 120);
            $table->date('opened_at'); // update dari datetimez jadi date
            $table->date('closed_at'); // (yyyy-mm-dd)
            $table->text('description');
            $table->integer('project_price');
            $table->integer('slot');
            $table->integer('slot_price');
            $table->string('project_image');
            $table->Integer('progress')->default(0);

            $table->integer('user_id')->unsigned();
            // $table->softDeletes();
            $table->timestamps();

            //foreign key
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
        Schema::dropIfExists('projects');
    }
}
