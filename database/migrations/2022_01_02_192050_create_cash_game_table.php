<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_game', function (Blueprint $table) {
            $table->id();
            $table->integer('rake')->default(0);
            $table->integer('players_amount')->default(0);
            $table->foreignId('company_id')->constrained('company')->onDelete('cascade');
            $table->timestamps();
            $table->dateTime('stop_time')->nullable()->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_game');
    }
}
