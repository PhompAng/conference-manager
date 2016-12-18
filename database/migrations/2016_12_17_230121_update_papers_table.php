<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('papers', function (Blueprint $table) {
            $table->string('abstract')->after('title');
            $table->tinyInteger('presentation')->after('file')->nullable();
            $table->string('author')->after('presentation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('papers', function (Blueprint $table) {
            $table->dropColumn('abstract');
            $table->dropColumn('presentation');
            $table->dropColumn('author');
        });
    }
}
