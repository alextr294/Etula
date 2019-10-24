<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('type', ['student', 'teacher', 'admin']);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('teachers', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::create('students', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::create('admins', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropForeign('admins_user_id_foreign');
            $table->dropPrimary('admins_user_id_primary');
            $table->dropColumn('user_id');
        });
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign('students_user_id_foreign');
            $table->dropPrimary('students_user_id_primary');
            $table->dropColumn('user_id');
        });
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropForeign('teachers_user_id_foreign');
            $table->dropPrimary('teachers_user_id_primary');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('admins');
        Schema::dropIfExists('students');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('users');
    }
}
