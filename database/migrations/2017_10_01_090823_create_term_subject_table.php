<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTermSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('term_id');
            $table->unsignedInteger('subject_id');
            $table->foreign('term_id')
                ->references('id')
                ->on('terms');
            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects');
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
        Schema::dropIfExists('term_subject');
    }
}
