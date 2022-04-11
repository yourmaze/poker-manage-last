<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDealerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dealers', function (Blueprint $table) {
            $table->dropColumn('rake_collect');
            $table->dropColumn('salary');
            $table->dropColumn('tips');
            $table->foreignId('company_id')->default(0)->constrained('company')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dealers', function ($table) {
            $table->integer('rake_collect')->default(0);
            $table->integer('salary')->default(0);
            $table->integer('tips')->default(0);
            $table->dropForeign('dealers_user_id_foreign');
            $table->dropForeign('dealers_company_id_foreign');
            $table->dropColumn('company_id');
            $table->dropColumn('user_id');
        });
    }
}
