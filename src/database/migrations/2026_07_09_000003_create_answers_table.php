<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->cascadeOnDelete();
            $table->foreignId('question_option_id')->constrained()->cascadeOnDelete();
            $table->string('visitor_token');
            $table->timestamps();
            $table->unique(['question_id', 'visitor_token']);
            $table->index(['question_id', 'question_option_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
