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
        Schema::table('student_answers', function (Blueprint $table) {
            $table->foreignId('lecture_id')
            ->nullable()
            ->after('student_id')
            ->constrained('lectures')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_answers', function (Blueprint $table) {
            $table->dropForeign(['lecture_id']);
            $table->dropColumn('lecture_id');
        });
    }
};
