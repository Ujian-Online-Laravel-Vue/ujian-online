<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->references('id')->on('exams')->cascadeOnDelete();
            $table->mediumText('question');
            $table->mediumText('option_1')->nullable();
            $table->mediumText('option_2')->nullable();
            $table->mediumText('option_3')->nullable();
            $table->mediumText('option_4')->nullable();
            $table->mediumText('option_5')->nullable();
            $table->integer('answer');
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
        Schema::dropIfExists('questions');
    }
};
