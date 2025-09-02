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
        Schema::create('documents', function (Blueprint $table) {
          $table->id();
            $table->foreignId('applicant_id')->constrained()->onDelete('cascade');
            $table->string('type'); // photo, signature, dob_proof, caste_certificate, id_proof, 10th,12th,grad,pg,bed,emp1,emp2
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
