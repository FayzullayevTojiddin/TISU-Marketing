<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('study_forms', function (Blueprint $table) {
            $table->foreignId('education_level_id')->nullable()->constrained()->nullOnDelete();
        });

        Schema::table('directions', function (Blueprint $table) {
            $table->foreignId('study_form_id')->nullable()->constrained()->nullOnDelete();
        });

        Schema::table('groups', function (Blueprint $table) {
            $table->foreignId('kafedra_id')->nullable()->constrained()->nullOnDelete();
            $table->dropConstrainedForeignId('education_level_id');
            $table->dropConstrainedForeignId('study_form_id');
        });
    }

    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->foreignId('education_level_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('study_form_id')->nullable()->constrained()->nullOnDelete();
            $table->dropConstrainedForeignId('kafedra_id');
        });

        Schema::table('directions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('study_form_id');
        });

        Schema::table('study_forms', function (Blueprint $table) {
            $table->dropConstrainedForeignId('education_level_id');
        });
    }
};
