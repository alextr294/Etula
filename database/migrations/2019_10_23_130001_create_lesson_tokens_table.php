<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_tokens', function (Blueprint $table) {
            $table->unsignedInteger('lesson_id');
            $table->primary('lesson_id');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');

            $table->string('token', 13)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lesson_tokens', function (Blueprint $table) {
            $table->dropForeign('lesson_tokens_lesson_id_foreign');
            $table->dropPrimary('lesson_tokens_lesson_id_primary');
            $table->dropColumn('lesson_id');
        });
        Schema::dropIfExists('lesson_tokens');
    }
}
