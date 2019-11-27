<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('station_no', 500);
            $table->string('station_name', 500);
            $table->integer('floor_id')->unsigned();
            $table->foreign('floor_id')->references('id')->on('floors')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('equipment_type_id')->unsigned()->nullable();
            $table->foreign('equipment_type_id')->references('id')->on('equipment_types')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('equipment_sub_type_id')->unsigned()->nullable();
            $table->foreign('equipment_sub_type_id')->references('id')->on('equipment_sub_types')->onUpdate('cascade')->onDelete('cascade');
            $table->string('cd_noncd_flag', 500)->nullable();
            $table->string('equipment_descriptions', 500)->nullable();
            $table->string('location', 250)->nullable();
            $table->integer('location_id')->unsigned()->nullable();
            $table->foreign('location_id')->references('id')->on('locations')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onUpdate('cascade')->onDelete('cascade');
            $table->string('model', 500)->nullable();
            $table->string('series', 500)->nullable();
            $table->integer('motor_brand_id')->unsigned()->nullable();
            $table->foreign('motor_brand_id')->references('id')->on('motor_brands')->onUpdate('cascade')->onDelete('cascade');
            $table->string('motor_model', 500)->nullable();
            $table->string('motor_serial', 150)->nullable();
            $table->string('motor_kw', 30)->nullable();
            $table->string('belt_size', 30)->nullable();
            $table->integer('grease_type_id')->unsigned()->nullable();
            $table->foreign('grease_type_id')->references('id')->on('grease_types')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('panel_type_id')->unsigned()->nullable();
            $table->foreign('panel_type_id')->references('id')->on('panel_types')->onUpdate('cascade')->onDelete('cascade');
            $table->string('ecs_control_room_location', 500)->nullable();
            $table->string('remarks', 500)->nullable();
            $table->string('status', 30)->nullable();
            $table->boolean('activated')->default(1);
            $table->integer('created_by')->unsigned()->default(1);
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('stations');
    }
}
