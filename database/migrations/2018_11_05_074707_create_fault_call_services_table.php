<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaultCallServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fault_call_services', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->string('report_no', 500); // FR201808081245001 => 2018/08/08 12:45:01
            $table->string('station_id', 500)->nullable();
            // $table->foreign('station_id')->references('id')->on('stations')->onUpdate('cascade')->onDelete('cascade');
            $table->text('user_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->text('contact_person')->nullable();
            $table->text('contact_person_no')->nullable();
            $table->text('fault_call_receive_date')->nullable();
            $table->text('fault_call_receive_time')->nullable();
            $table->text('arrival_date')->nullable();
            $table->text('arrival_time')->nullable();
            $table->string('fault_alarm_inspection_desc', 500)->nullable();
            $table->string('fault_alarm_inspection_desc2', 500)->nullable();
            $table->string('fault_alarm_inspection_desc3', 500)->nullable();
            $table->string('fault_alarm_inspection_desc4', 500)->nullable();
            $table->string('fault_alarm_inspection_desc5', 500)->nullable();
            $table->string('fault_alarm_inspection_reason', 500)->nullable();
            $table->string('fi_action_taken_outcome_desc', 500)->nullable();
            $table->string('fault_alarm_desc', 500)->nullable();
            $table->string('fault_alarm_reason', 500)->nullable();
            $table->string('fr_action_taken_outcome_desc', 500)->nullable();
            $table->text('fault_alarm_inspection_completion_date')->nullable();
            $table->text('fault_alarm_inspection_completion_time')->nullable();
            $table->text('remarks')->nullable();
            $table->text('pic_1')->nullable();
            $table->text('pic_2')->nullable();
            $table->text('pic_3')->nullable();
            $table->text('pic_4')->nullable();
            $table->text('pic_5')->nullable();
            $table->text('inspection_conducted_by_name')->nullable();
            $table->text('inspection_conducted_by_signature')->nullable();
            $table->text('witness_by_abme_name')->nullable();
            $table->text('witness_by_abme_signature')->nullable();
            $table->text('witness_by_sbst_name')->nullable();
            $table->text('witness_by_sbst_signature')->nullable();
            $table->integer('witness_by_sbst_user_id')->nullable();
            $table->string('status', 500)->default('eyJpdiI6IlhjcXY4ZEhpSVgrTXJodEt6RzlTb1E9PSIsInZhbHVlIjoiRkdxRVlkQlB1ZHVkeGFmUkxVaWFIdz09IiwibWFjIjoiM2NjMzAxOGY0YjRiZTQ5NTczNzQ3OGZjMDFlZmUzZTQ0Y2Y0MmQyYzlkNTBkYTQ4ODk3MGFlNGFkNWJkNzRlZiJ9');

            // $table->enum('status', ['arrived', 'pending', 'solved', 'unsolved'])->default('pending');
            $table->string('arrived_station', 500)->default('0');
            $table->longText('receiver_list')->nullable();
            // $table->boolean('arrived_station')->default(0);
            $table->integer('acknowledge_by')->unsigned()->nullable(1);
            $table->foreign('acknowledge_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('fault_call_services');
    }
}
