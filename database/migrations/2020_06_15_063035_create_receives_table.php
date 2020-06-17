<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receives', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('chromo_name');
            $table->string('chromo_doc');
            $table->string('chromo_hos');
            $table->string('sample_type');
            $table->string('chromo_test');
            $table->string('rev_staff');
            $table->string('logis_staff');
            $table->date('report_date');
            $table->date('email_date');
            $table->string('chromo_number');
            $table->string('chromo_remark');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receives');
    }
}
