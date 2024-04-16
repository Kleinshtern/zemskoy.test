<?php

namespace App\Models\Directories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @namespace App\Models\Directories
 * @class TaskTypes
 *
 * @property-read integer $id
 * @property string $system_name
 * @property string $display_name
 * @property string $hex_color
 */
class TaskTypes extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'task_types';
    protected $fillable = [
        'system_name',
        'display_name',
        'hex_color'
    ];
}
