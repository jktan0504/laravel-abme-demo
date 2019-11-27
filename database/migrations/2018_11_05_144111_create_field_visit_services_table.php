<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldVisitServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_visit_services', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->text('submit_date');
            $table->string('submit_to', 500);
            $table->string('report_no', 500); // FV201808081245001 => 2018/08/08 12:45:01
            $table->string('system', 500);
            $table->text('visiting_date');
            $table->text('visiting_time');
            $table->text('location')->nullable();
            $table->string('location_id', 500)->nullable();
            // $table->foreign('location_id')->references('id')->on('locations')->onUpdate('cascade')->onDelete('cascade');
            $table->string('field_visit_category_id', 500)->nullable();
            // $table->foreign('field_visit_category_id')->references('id')->on('field_visit_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->text('field_visit_other_category')->nullable();
            $table->text('details_findings')->nullable();
            $table->text('summary')->nullable();
            $table->text('pic_1')->nullable();
            $table->text('pic_2')->nullable();
            $table->text('pic_3')->nullable();
            $table->text('pic_4')->nullable();
            $table->text('pic_5')->nullable();
            $table->text('remarks')->nullable();
            $table->string('report_by_name_1', 250);
            $table->text('report_by_name_1_date')->nullable();
            $table->text('report_by_name_1_signature')->nullable();
            $table->string('report_by_name_2', 250)->nullable();
            $table->text('report_by_name_2_date')->nullable();
            $table->text('report_by_name_2_signature')->nullable();
            $table->string('report_by_name_3', 250)->nullable();
            $table->text('report_by_name_3_date')->nullable();
            $table->text('report_by_name_3_signature')->nullable();
            $table->string('status', 500)->default('pending');
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
        Schema::dropIfExists('field_visit_services');
    }
}
