<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('level')->default(1);
            $table->integer('blind_time');
            $table->integer('total_players')->default(0);
            $table->integer('rebuys')->default(0);
            $table->integer('addons')->default(0);
            $table->integer('total_price')->default(0);
            $table->text('blinds_structure')->nullable();
            $table->text('payments')->nullable();
            $table->integer('bonus_stack')->default(0);
            $table->integer('usual_stack')->default(0);
            $table->integer('addon_stack')->default(0);

            $table->foreignId('company_id')->on('company')->onDelete('cascade');
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
        Schema::dropIfExists('tournaments');
    }
}
