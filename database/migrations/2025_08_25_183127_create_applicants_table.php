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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // registered user
            $table->string('advt_no')->nullable();
            $table->boolean('already_applied')->default(false);
            $table->string('post')->nullable();
            $table->string('subject')->nullable();
            $table->boolean('bed_required')->default(true);
            $table->enum('gender', ['Male','Female','Others']);
            $table->boolean('physically_handicapped')->default(false);
            $table->string('handicap_details')->nullable();
            $table->enum('category', ['General','ST','SC','OBC'])->default('General');
            $table->string('category_certificate_no')->nullable();
            $table->date('dob')->nullable();
            $table->string('full_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('photo_id_type')->nullable(); // Aadhaar/PAN
            $table->string('photo_id_no')->nullable();
            $table->string('photo_id_image')->nullable();
            $table->text('address')->nullable();
            $table->boolean('submitted')->default(false);
            $table->timestamp('submitted_at')->nullable();
            $table->unsignedTinyInteger('current_step')->default(1);
            $table->enum('status', ['pending','approved','rejected'])->default('pending');
            $table->string('registration_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
