<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @namespace App\Models
 * @class TaskTracker
 *
 * @property-read integer $id
 * @property integer $task_id
 * @property integer $tracker_id
 * @property integer $time
 *
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon $deleted_at
 *
 * @property-read ProjectTasks $task
 * @property-read User $tracker
 */
class TaskTracker extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'task_tracker';
    protected $guarded = ['id'];
    protected $fillable = [
        'task_id',
        'tracker_id',
        'time'
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d.m.Y H:i:s');
    }

    public function task(): HasOne
    {
        return $this->hasOne(ProjectTasks::class, 'id', 'task_id');
    }

    public function tracker() : HasOne
    {
        return $this->hasOne(User::class, 'id', 'tracker_id');
    }
}
