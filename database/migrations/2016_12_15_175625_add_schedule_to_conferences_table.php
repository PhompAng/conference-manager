<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScheduleToConferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conferences', function (Blueprint $table) {
            $table->dateTime('open')->after('url')->nullable();
            $table->dateTime('close')->after('open')->nullable();
            $table->dateTime('paper_deadline')->after('close')->nullable();
            $table->dateTime('acceptance')->after('paper_deadline')->nullable();
            $table->dateTime('camera_deadline')->after('acceptance')->nullable();
            $table->dateTime('pre_regis')->after('camera_deadline')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conferences', function (Blueprint $table) {
            $table->dropColumn('open');
            $table->dropColumn('close');
            $table->dropColumn('paper_deadline');
            $table->dropColumn('acceptance');
            $table->dropColumn('camera_deadline');
            $table->dropColumn('pre_regis');
        });
    }
}
