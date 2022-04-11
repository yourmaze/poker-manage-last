<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashRake extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_rake', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('cash_game')->onDelete('cascade');
            $table->foreignId('dealer_id')->constrained();
            $table->integer('rake')->unsigned()->default(0);
            $table->integer('salary')->unsigned()->default(0);
            $table->integer('tips')->unsigned()->default(0);
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
        Schema::dropIfExists('cash_rake');
    }
}
