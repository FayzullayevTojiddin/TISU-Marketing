<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->nullOnDelete();
            $table->string('full_name');
            $table->enum('sex', ['male','female']);
            $table->string('nationality');
            $table->date('birth_date');
            $table->json('from');
            $table->json('lives');
            $table->string('passport_address');
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->string('JSHSHR')->unique();
            $table->string('phone_number')->nullable();
            $table->string('parents_number')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
