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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sport_id')->nullable()->constrained('sports')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('students')->onUpdate('cascade')->onDelete('cascade');
            $table->string('achievement_name');
            $table->date('achievement_date')->nullable();
            $table->string('achievement_type')->nullable();
            $table->string('achievement_level')->nullable();
            $table->string('achievement_status')->nullable();
            $table->string('age_gap');
            $table->string('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
