<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kurator_id')->constrained()->nullOnDelete();
            $table->foreignId('kafedra_id')->constrained()->nullOnDelete();
            $table->foreignId('direction_id')->constrained()->nullOnDelete();
            $table->string('title')->unique();
            $table->integer('enrollment_year')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
