<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_tournaments', function (Blueprint $table) {
            $table->foreignId('tournament_id')->constrained()->onDelete('cascade');
            $table->dateTime('next_up')->nullable()->default(NULL);
            $table->dateTime('next_break')->nullable()->default(NULL);
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
        Schema::dropIfExists('temp_tournaments');
    }
}
