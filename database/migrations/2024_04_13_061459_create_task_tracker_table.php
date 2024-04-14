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
        Schema::create('task_tracker', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')
                ->constrained('project_tasks')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('tracker_id')
                ->constrained('users');
            $table->integer('time');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_tracker');
    }
};
