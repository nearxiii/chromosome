<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmnioticfluidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amnioticfluids', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('lab_no');
            $table->string('pt_name');
            $table->string('pt_add');
            $table->string('sample_quelity');
            $table->string('sample_con');
            $table->date('cult_date')->nullable();
            $table->time('cult_time')->nullable();
            $table->string('cult_staff')->nullable();
            $table->string('cult_remark')->nullable();
            $table->date('media_date')->nullable();
            $table->time('media_time')->nullable();
            $table->string('media_staff')->nullable();
            $table->string('media_remark')->nullable();
            $table->date('subcul1_date')->nullable();
            $table->time('subcul1_time')->nullable();
            $table->string('subcul1_staff')->nullable();
            $table->string('subcul1_remark')->nullable();
            $table->date('subcul2_date')->nullable();
            $table->time('subcul2_time')->nullable();
            $table->string('subcul2_staff')->nullable();
            $table->string('subcul2_remark')->nullable();
            $table->date('hvest_t1_date')->nullable();
            $table->time('hvest_t1_time')->nullable();
            $table->string('hvest_t1_staff')->nullable();
            $table->string('hvest_t1_remark')->nullable();
            $table->date('hvest_t2_date')->nullable();
            $table->time('hvest_t2_time')->nullable();
            $table->string('hvest_t2_staff')->nullable();
            $table->string('hvest_t2_remark')->nullable();
            $table->date('slide_t1_date')->nullable();
            $table->time('slide_t1_time')->nullable();
            $table->string('slide_t1_staff')->nullable();
            $table->string('slide_t1_remark')->nullable();
            $table->date('slide_t2_date')->nullable();
            $table->time('slide_t2_time')->nullable();
            $table->string('slide_t2_staff')->nullable();
            $table->string('slide_t2_remark')->nullable();
            $table->date('band_t1_date')->nullable();
            $table->time('band_t1_time')->nullable();
            $table->string('band_t1_staff')->nullable();
            $table->string('band_t1_remark')->nullable();
            $table->date('band_t2_date')->nullable();
            $table->time('band_t2_time')->nullable();
            $table->string('band_t2_staff')->nullable();
            $table->string('band_t2_remark')->nullable();
            $table->date('analyz_1_date')->nullable();
            $table->time('analyz_1_time')->nullable();
            $table->string('analyz_1_staff')->nullable();
            $table->string('analyz_1_remark')->nullable();
            $table->date('analyz_2_date')->nullable();
            $table->time('analyz_2_time')->nullable();
            $table->string('analyz_2_staff')->nullable();
            $table->string('analyz_2_remark')->nullable();
            $table->date('cyto_noti_date')->nullable();
            $table->time('cyto_noti_time')->nullable();
            $table->string('cyto_noti_staff')->nullable();
            $table->string('cyto_noti_remark')->nullable();
            $table->date('report_date')->nullable();
            $table->time('report_time')->nullable();
            $table->string('report_staff')->nullable();
            $table->string('report_remark')->nullable();
            $table->string('virified_staff')->nullable();
            $table->date('virified_date')->nullable();
            $table->string('email_staff')->nullable();
            $table->date('email_date')->nullable();
            $table->string('all_remark')->nullable();
            $table->string('pcr_sent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amnioticfluids');
    }
}
