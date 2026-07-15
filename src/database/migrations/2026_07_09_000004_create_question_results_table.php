<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('question_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->cascadeOnDelete();
            $table->foreignId('option_id')->constrained('question_options')->cascadeOnDelete();
            $table->unsignedInteger('answer_count')->default(0);
            $table->decimal('percentage', 5, 2)->default(0);
            $table->timestamps();
            $table->unique(['question_id', 'option_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('question_results');
    }
};
