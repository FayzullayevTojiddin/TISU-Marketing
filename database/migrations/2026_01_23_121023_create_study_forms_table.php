<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('study_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_level_id')->constrained()->nullOnDelete();
            $table->string('title');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('study_forms');
    }
};
