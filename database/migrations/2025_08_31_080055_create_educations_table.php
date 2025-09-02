<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('educations', function (Blueprint $table) {
           $table->foreignId('applicant_id')->constrained()->onDelete('cascade');
            $table->string('level'); // 10th, 12th, Graduate, PG, BEd
            $table->string('board_university')->nullable();
            $table->string('subjects')->nullable();
            $table->year('year_of_passing')->nullable();
            $table->integer('marks_obtained')->nullable();
            $table->integer('marks_total')->nullable(); // for percent calc
            $table->string('division')->nullable(); // computed
            $table->string('certificate_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
