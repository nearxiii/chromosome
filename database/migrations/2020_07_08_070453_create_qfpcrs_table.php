<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQfpcrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qfpcrs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('lab_no');
            $table->string('pt_name');
            $table->string('pt_add');
            $table->string('sample_quelity')->nullable();
            $table->string('sample_con')->nullable();
            $table->string('sample_clot')->nullable();
            $table->string('dna_conc')->nullable();
            $table->date('dna_date')->nullable();
            $table->time('dna_time')->nullable();
            $table->string('dna_staff')->nullable();
            $table->string('dna_remark')->nullable();
            $table->string('pcr_conc')->nullable();
            $table->date('pcr_date')->nullable();
            $table->time('pcr_time')->nullable();
            $table->string('pcr_staff')->nullable();
            $table->string('pcr_remark')->nullable();
            $table->string('frag_conc')->nullable();
            $table->date('frag_date')->nullable();
            $table->time('frag_time')->nullable();
            $table->string('frag_staff')->nullable();
            $table->string('frag_remark')->nullable();
            $table->string('dilute_fac')->nullable();
            $table->string('analyz_staff')->nullable();
            $table->date('analyz_date')->nullable();
            $table->string('virified_staff')->nullable();
            $table->date('virified_date')->nullable();
            $table->string('email_staff')->nullable();
            $table->date('email_date')->nullable();
            $table->string('remark')->nullable();
            $table->string('pcr_result')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qfpcrs');
    }
}
