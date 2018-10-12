<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('topup_id')->unsigned()->nullable();
            $table->integer('slot_id')->unsigned()->nullable();
            $table->integer('project_id')->unsigned()->nullable();
            $table->string('project_name')->nullable();
            // $table->integer('withdraw_id')->unsigned()->nullable();
            $table->integer('nominal')->unsigned();
            $table->string('transaction_image')->nullable();
            // 1: topup, 2:beli slot, 3:profit, 4: withdraw
            $table->smallInteger('transaction_type')->nullable();
            $table->integer('deposit')->default(0);
            $table->integer('credit')->default(0);
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('topup_id')->references('id')->on('topups')->onDelete('cascade');
            $table->foreign('slot_id')->references('id')->on('slots')->onDelete('cascade');
            // $table->foreign('withdraw_id')->references('id')->on('withdraws')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
