<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->string('academic_position')->after('title');
            $table->string('family_name')->after('name');
            $table->string('affiliation')->after('email');
            $table->string('country')->after('affiliation');
            $table->string('mobile')->after('country');
            $table->string('fax')->nullable()->after('mobile');
            $table->tinyInteger('role')->default(0)->after('remember_token');
            $table->integer('conference_id')->unsigned();

            $table->foreign('conference_id')->references('id')->on('conferences')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('academic_position');
            $table->dropColumn('family_name');
            $table->dropColumn('affiliation');
            $table->dropColumn('country');
            $table->dropColumn('mobile');
            $table->dropColumn('fax');
            $table->dropColumn('role');
            $table->dropColumn('conferences_id');
            $table->dropForeign(['conferences_id']);

        });
    }
}
