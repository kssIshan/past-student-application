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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('index_no');
            $table->string('type');
            $table->integer('exam_year');
            $table->integer('attempt')->default(1);
            $table->integer('island_rank')->nullable();
            $table->integer('district_rank')->nullable();
            $table->double('z_score')->nullable();
            $table->integer('cut_of_marks')->nullable();
            $table->string('subject_stream')->nullable();
            $table->boolean('is_pass')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('exams');
    }
};
