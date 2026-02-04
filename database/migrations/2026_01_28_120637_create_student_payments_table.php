<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->nullOnDelete();
            $table->foreignId('student_contract_id')->constrained()->nullOnDelete();
            $table->string('image')->nullable();
            $table->dateTime('date')->nullable();
            $table->bigInteger('amount')->default(0);
            $table->string('type')->default('plus');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_payments');
    }
};
