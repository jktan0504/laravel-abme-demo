<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroupHasAccessRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_group_has_access_rights', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->integer('user_group_id')->unsigned();
            $table->foreign('user_group_id')->references('id')->on('user_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('user_access_rights')->nullable();
            $table->longText('remarks')->nullable();
            // $table->integer('user_access_right_id')->unsigned();
            // $table->foreign('user_access_right_id')->references('id')->on('user_access_rights')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('activated')->default(0);
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
        Schema::dropIfExists('user_group_has_access_rights');
    }
}
