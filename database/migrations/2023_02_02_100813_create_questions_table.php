<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('survey_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedInteger('position');
            $table->text('title');
            $table->timestamps();
            $table->foreign('survey_id')->references('id')->on('surveys')->cascadeOnUpdate()
            ->cascadeOnDelete();
            $table->foreign('type_id')->references('id')->on('question_types')->cascadeOnUpdate()
            ->restrictOnDelete();
            $table->unique(['survey_id', 'position']);
            $table->unique(['survey_id', 'title']);
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
