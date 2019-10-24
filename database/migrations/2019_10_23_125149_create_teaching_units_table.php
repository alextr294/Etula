<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachingUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teaching_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->unsignedInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('teaching_units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropForeign('lessons_unit_id_foreign');
            $table->dropColumn('unit_id');
        });
        Schema::dropIfExists('teaching_units');
    }
}
