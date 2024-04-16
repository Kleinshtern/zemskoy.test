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
        Schema::table('project_tasks', function (Blueprint $table): void {
            $table->dropForeign(['responsible_id']);
            $table->dropColumn('responsible_id');
        });

        Schema::table('project_tasks', function (Blueprint $table): void {
            $table->foreignId('responsible_id')
               ->nullable()
               ->constrained('users')
               ->onUpdate('cascade')
               ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_tasks', function (Blueprint $table): void {
            $table->dropForeign(['responsible_id']);
        });
    }
};
