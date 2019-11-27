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
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('username', 250)->unique();
            $table->string('full_name', 250);
            $table->string('company_name', 500);
            $table->string('email')->unique();
            $table->string('contact', 50)->unique();
            $table->string('salt_value', 50)->nullable();
            $table->string('password');
            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('teams')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('user_group_id')->unsigned();
            $table->foreign('user_group_id')->references('id')->on('user_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->string('profile_image', 1000)->default('DEFAULT');
            $table->longText('sbst_sign')->nullable();
            $table->text('remarks')->nullable();
            $table->enum('account_status', ['Active', 'Inactive', 'Resign', 'HomeLeave'])->default('Active');
            $table->boolean('password_changed')->default(0);
            $table->boolean('sbst_changed')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('firebase_id', 800)->nullable();
            $table->boolean('blocked')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
