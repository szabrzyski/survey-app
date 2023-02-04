<?php

use Database\Seeders\SurveyStatusSeeder;
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
        Schema::create('survey_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('additional_info')->default(0);
            $table->boolean('default')->default(0);
            $table->boolean('visible')->default(0);
            $table->boolean('api_available')->default(0);
            $table->boolean('questions_required')->default(0);
            $table->timestamps();
        });
        $this->seed();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_statuses');
    }

    /**
     * Seed database.
     */
    private function seed(): void
    {
        $seeder = new SurveyStatusSeeder();
        $seeder->run();
    }
};
