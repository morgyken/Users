<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users_user_profiles', function(Blueprint $column) {
            $column->integer('user_id')->unsigned()->primary();
            $column->smallInteger('title')->default(1);
            $column->string('first_name');
            $column->string('middle_name')->nullable();
            $column->string('last_name');
            $column->string('job_description')->nullable();
            $column->string('phone')->nullable();
            $column->string('mpdb')->nullable();
            $column->string('pin')->nullable();
            $column->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
        DB::statement("ALTER TABLE users_user_profiles ADD photo LONGBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users_user_profiles');
    }

}