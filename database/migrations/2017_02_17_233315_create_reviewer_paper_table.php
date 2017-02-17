<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewerPaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviewer_paper', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('paper_id')->unsigned();
            $table->text('comment_str')->nullable();
            $table->text('comment_weak')->nullable();
            $table->text('comment_reviewer')->nullable();
            $table->text('score');
            $table->boolean('bpp_recommend');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('paper_id')->references('id')->on('papers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviewer_paper');
    }
}
