<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYeartermSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yearterm_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('year_term_id');
            $table->unsignedInteger('subject_id');
            $table->foreign('year_term_id')
            ->references('id')
            ->on('year_term');
            $table->foreign('subject_id')
            ->references('id')
            ->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yearterm_subject');
    }
}
