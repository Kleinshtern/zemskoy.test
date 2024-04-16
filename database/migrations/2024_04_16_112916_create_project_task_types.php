<?php

use App\Models\Directories\TaskTypes;
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
        Schema::create('task_types', function (Blueprint $table) {
            $table->id();
            $table->string('system_name');
            $table->string('display_name');
            $table->string('hex_color');
            $table->timestamps();
            $table->softDeletes();
        });

        $typeHotFix = TaskTypes::create([
            'system_name' => 'hotFix',
            'display_name' => 'HotFix',
            'hex_color' => '#ff0000',
        ]);
        $typeDesign = TaskTypes::create([
            'system_name' => 'designSystem',
            'display_name' => 'Design System',
            'hex_color' => '#ffecc8',
        ]);
        $typeDesktop = TaskTypes::create([
            'system_name' => 'desktop',
            'display_name' => 'Desktop',
            'hex_color' => '#d2dff7',
        ]);
        $typeBranding = TaskTypes::create([
            'system_name' => 'branding',
            'display_name' => 'Branding',
            'hex_color' => '#bbebfe',
        ]);
        $typeUxResearch = TaskTypes::create([
            'system_name' => 'ux_research',
            'display_name' => 'UX & Research',
            'hex_color' => '#fee5ff',
        ]);
        $typeNoType = TaskTypes::create([
            'system_name' => 'no_type',
            'display_name' => 'Не назначеный',
            'hex_color' => '#eeeef0'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_task_types');
    }
};
