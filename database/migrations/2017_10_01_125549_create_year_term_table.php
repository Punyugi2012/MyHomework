<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearTermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('year_term', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('year_id');
            $table->unsignedInteger('term_id');
            $table->foreign('year_id')
                ->references('id')
                ->on('years');
            $table->foreign('term_id')
                ->references('id')
                ->on('terms');
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
        Schema::dropIfExists('year_term');
    }
}
