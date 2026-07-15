<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('draft');
            $table->boolean('is_public')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status', 'is_public']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
